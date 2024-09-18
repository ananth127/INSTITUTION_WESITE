<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>STUDENT PROFILE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            font-size: 18px;
        }

        th {
            background-color: #59b4eb;
            color: #fff;
            font-weight: bold;
        }

        td {
            border-bottom: 1px solid #ddd;
        }

        .edit-btn {
            background-color: #59b4eb;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }

        .edit-btn:hover {
            background-color: #4a90e2;
        }

        .inpu {
            border: none;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["staff_id"])) {
        header('Location: index.html');
        exit;
    }
    $staff_id = $_SESSION["staff_id"];
    $stud_id = isset($_GET["stud_id"]) ? $_GET["stud_id"] : $_SESSION["stud_id"];
    $_SESSION=$stud_id;
    

 // Database connection
 include 'connection.php';
        
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 $con=$conn;

    $query = "SELECT * FROM `stud_data` WHERE `Roll No`='$stud_id'";
    $result_data = mysqli_query($con, $query);

    if (!$result_data) {
        die("Error fetching data: " . mysqli_error($conn));
    }

    $row_data = mysqli_fetch_array($result_data);
    ?>

    <div class="container">
        <h2 style="text-align: center;">Student Profile</h2>
        <div style="text-align: center; margin-bottom: 20px;">
            Welcome to the IT Department
        </div>
        <div style="display: flex; justify-content: center;">
            <form id="profileForm" action="staff_stud_update.php" method="post">
                <table>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <?php
                            $query_img = "SELECT * FROM `stud_profile_img` WHERE `Roll No`='$stud_id'";
                            $result_img = mysqli_query($con, $query_img);
                            if ($result_img && mysqli_num_rows($result_img) > 0) {
                                $row_img = mysqli_fetch_array($result_img);
                                echo '<img src="profile/' . $row_img['Image_url'] . '" alt="Profile Image" style="width: 200px; height: 200px;">';
                            } else {
                                echo "Profile image not found";
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td width="20%">ROLL NO.</td>
                        <td width="80%"><input class="inpu" type="text" name="rollNo" value="<?php echo $row_data['Roll No']; ?>" readonly></td>
                    </tr>
                    <!-- Add other input fields and textareas similarly -->
                    <tr>
                        <td>REG NO.</td>
                        <td><input class="inpu" name="regno" type="text" value="<?php echo $row_data['Register No']; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>NAME</td>
                        <td><input class="inpu" name="studname" type="text" value="<?php echo $row_data['Student Name']; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>CLASS</td>
                        <td><input class="inpu" name="class" type="text" value="<?php echo $row_data['Class']; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>DEPARTMENT</td>
                        <td><input class="inpu" name="department" type="text" value="<?php echo $row_data['Department']; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>DOB</td>
                        <td><input class="inpu" name="dob" type="text" value="<?php echo $row_data['Date of Birth']; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>GENDER</td>
                        <td><input class="inpu" name="gender" type="text" value="<?php echo $row_data['Gender']; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>MOBILE NO.</td>
                        <td><input class="inpu" name="mobileno" type="text" value="<?php echo $row_data['Mobile Number']; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>EMAIL ID</td>
                        <td><input class="inpu" name="emailid" type="text" value="<?php echo $row_data['Email Id']; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>ADDRESS</td>
                        <td><textarea class="inpu" name="address" readonly rows="4" cols="50"><?php echo $row_data['Address']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td>CERTIFICATE:</td>
                        <td><a class="inpu" href="staffstudimgupload.php?stud_id=<?php echo $row_data['Roll No']; ?>">Upload</a></td>
                    </tr>
                    <tr>
                        <td>CERTIFICATE:</td>
                        <td><a class="inpu" href="stafstudimgview.php?stud_id=<?php echo $row_data['Roll No']; ?>">View</a></td>
                    </tr>
                    <tr>
                        <td>CGPA</td>
                        <td><input class="inpu" name="cgpa" type="text" value="<?php echo $row_data['CGPA']; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>MESSAGE</td>
                        <td><input class="inpu" name="message" type="text" value="<?php echo $row_data['Message']; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <button id="submitButton" class="edit-btn" disabled>Submit</button>
                            <button type="button" class="edit-btn" onclick="toggleEdit()">Edit</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <script>
        function toggleEdit() {
            var inputs = document.querySelectorAll('input');
            var textareas = document.querySelectorAll('textarea');

            inputs.forEach(function(input) {
                input.removeAttribute('readonly');
            });

            textareas.forEach(function(textarea) {
                textarea.removeAttribute('readonly');
            });

            toggleSubmit();
        }

        function toggleSubmit() {
            var submitButton = document.getElementById('submitButton');
            var inputs = document.querySelectorAll('input');
            var textareas = document.querySelectorAll('textarea');
            var isDisabled = true;

            inputs.forEach(function(input) {
                if (!input.hasAttribute('readonly')) {
                    isDisabled = false;
                }
            });

            textareas.forEach(function(textarea) {
                if (!textarea.hasAttribute('readonly')) {
                    isDisabled = false;
                }
            });

            submitButton.disabled = isDisabled;
        }
    </script>
</body>

</html>