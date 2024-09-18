<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>STUDENT PROFILE</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }

        .edit {
            border: none;
            background-color: transparent;
            cursor: pointer;
        }

        .edit:focus {
            outline: none;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["uname"]) && !isset($_POST["uname"])) {
        header('Location: firstpage1.html');
        exit;
    }
    $uname = $_SESSION["uname"];
    
 // Database connection
 include 'connection.php';
        
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 $con=$conn;
    ?>

    <div class="bg">
        <div class="fbt">
            <h2><center>My-Performance</center></h2>
        </div>
        <div class="fbb">
            <h2>Welcome To IT Dept.</h2>
            <form action="logout.php" method="post">
                <div>
                    <?php echo $uname; ?>
                    <br><br><br>
                    <div style="display: flex; justify-content: center;">
                        <table style="width: 800px;">
                            <?php
                            $query = "SELECT * FROM `stud_data` WHERE `Roll No`='$uname'";
                            $result_data = mysqli_query($con, $query);
                            $row_data = mysqli_fetch_array($result_data);
                            ?>

                            <tr>
                                <td colspan="2">
                                    <?php
                                    $query_img = "SELECT * FROM `stud_profile_img` WHERE `Roll No`='$uname'";
                                    $result_img = mysqli_query($con, $query_img);
                                    $row_img = mysqli_fetch_array($result_img);
                                    ?>
                                    <embed src="profile/<?=$row_img['Image_url']?>" width="200px" height="200px"></embed>
                                </td>
                            </tr>

                            <tr>
                                <td>ROLL NO.</td>
                                <td contenteditable="true" class="edit" id="roll_no"><?php echo $row_data['Roll No']; ?></td>
                            </tr>
                            <tr>
                                <td>REG NO.</td>
                                <td contenteditable="true" class="edit" id="reg_no"><?php echo $row_data['Register No']; ?></td>
                            </tr>
                            <tr>
                                <td>NAME</td>
                                <td contenteditable="true" class="edit" id="student_name"><?php echo $row_data['Student Name']; ?></td>
                            </tr>
                            <tr>
                                <td>CLASS</td>
                                <td contenteditable="true" class="edit" id="class"><?php echo $row_data['Class']; ?></td>
                            </tr>
                            <tr>
                                <td>DEPARTMENT</td>
                                <td contenteditable="true" class="edit" id="department"><?php echo $row_data['Department']; ?></td>
                            </tr>
                            <tr>
                                <td>DOB</td>
                                <td contenteditable="true" class="edit" id="dob"><?php echo $row_data['Date of Birth']; ?></td>
                            </tr>
                            <tr>
                                <td>CERTIFICATE:</td>
                                <td><a href="studupload.php">Upload</a></td>
                            </tr>
                            <tr>
                                <td>CERTIFICATE:</td>
                                <td><a href="studimgview.php">View</a></td>
                            </tr>
                            <tr>
                                <td>GENDER</td>
                                <td contenteditable="true" class="edit" id="gender"><?php echo $row_data['Gender']; ?></td>
                            </tr>
                            <tr>
                                <td>MOBILE NO.</td>
                                <td contenteditable="true" class="edit" id="mobile_no"><?php echo $row_data['Mobile Number']; ?></td>
                            </tr>
                            <tr>
                                <td>EMAIL ID</td>
                                <td contenteditable="true" class="edit" id="email_id"><?php echo $row_data['Email Id']; ?></td>
                            </tr>
                            <tr>
                                <td>ADDRESS</td>
                                <td contenteditable="true" class="edit" id="address"><?php echo $row_data['Address']; ?></td>
                            </tr>
                            <tr>
                                <td>CGPA</td>
                                <td contenteditable="true" class="edit" id="cgpa"><?php echo $row_data['CGPA']; ?></td>
                            </tr>
                            <tr>
                                <td>LASTLOGIN</td>
                                <td contenteditable="true" class="edit" id="last_login"><?php echo $row_data['LastLogin']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <center><a href="result/index.html">Result</a></br><button type="button" class="btnn" onclick="updateProfile()">Update Profile</button></center>
            </form>
            <br>
        </div>
    </div>

    <script>
        function updateProfile() {
            var roll_no = document.getElementById("roll_no").innerText;
            var reg_no = document.getElementById("reg_no").innerText;
            var student_name = document.getElementById("student_name").innerText;
            var class_val = document.getElementById("class").innerText;
            var department = document.getElementById("department").innerText;
            var dob = document.getElementById("dob").innerText;
            var gender = document.getElementById("gender").innerText;
            var mobile_no = document.getElementById("mobile_no").innerText;
            var email_id = document.getElementById("email_id").innerText;
            var address = document.getElementById("address").innerText;
            var cgpa = document.getElementById("cgpa").innerText;
            var last_login = document.getElementById("last_login").innerText;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                    // You can redirect or show a message upon successful update
                }
            };
            xhr.open("POST", "update_profile.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("roll_no=" + roll_no + "&reg_no=" + reg_no + "&student_name=" + student_name + "&class=" + class_val + "&department=" + department + "&dob=" + dob + "&gender=" + gender + "&mobile_no=" + mobile_no + "&email_id=" + email_id + "&address=" + address + "&cgpa=" + cgpa + "&last_login=" + last_login);
        }
    </script>
</body>

</html>
