<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>STUDENT PROFILE</title>
    <style>
        table,
        th,
        td {
            border: 20px groove #59b4eb;
            border-collapse: collapse;
            padding: 25px;
            font-size: 25px;
        }
        .stud{
            display: flex;
            justify-content: center;
            background-color: #59b4eb;
            font-size: 45px;
        }
        .result_btn, .logout_btn{
            text-decoration: none;
            border: 3px solid;
            font-size: 20px;
            padding: 10px;
            background-color: #59b4eb;
        }
        .logout_btn{
            background-color: red;
        }

        /* Media query for mobile view */
        @media only screen and (max-width: 600px) {
            table, th, td {
                padding: 10px;
                font-size: 16px;
            }
            .stud {
                font-size: 30px;
            }
            .result_btn, .logout_btn {
                font-size: 16px;
                padding: 8px;
            }
            .bg {
                padding: 10px;
            }
            table {
                width: 100%;
            }
            td {
                padding-right: 0;
            }
        }
    </style>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["uname"]) && !isset($_POST["uname"])) {
        header('Location: index.html');
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
            <h2 class="stud"><center>My-Performance</center></h2>
        </div>
        <div class="fbb">
            <h2>Welcome To IT Dept.</h2>
            <form action="logout.php" method="post">
                <div>
                    <?php echo $uname; ?>
                    <br><br><br>
                    <div style="display: flex; justify-content: center;">
                        <table style="width: 100%;">
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
                                <td width="20%">ROLL NO.</td>
                                <td><?php echo $row_data['Roll No']; ?></td>
                            </tr>
                            <tr>
                                <td>REG NO.</td>
                                <td><?php echo $row_data['Register No']; ?></td>
                            </tr>
                            <tr>
                                <td>NAME</td>
                                <td><?php echo $row_data['Student Name']; ?></td>
                            </tr>
                            <tr>
                                <td>CLASS</td>
                                <td><?php echo $row_data['Class']; ?></td>
                            </tr>
                            <tr>
                                <td>DEPARTMENT</td>
                                <td><?php echo $row_data['Department']; ?></td>
                            </tr>
                            <tr>
                                <td>DOB</td>
                                <td><?php echo $row_data['Date of Birth']; ?></td>
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
                                <td><?php echo $row_data['Gender']; ?></td>
                            </tr>
                            <tr>
                                <td>MOBILE NO.</td>
                                <td><?php echo $row_data['Mobile Number']; ?></td>
                            </tr>
                            <tr>
                                <td>EMAIL ID</td>
                                <td><?php echo $row_data['Email Id']; ?></td>
                            </tr>
                            <tr>
                                <td>ADDRESS</td>
                                <td><?php echo $row_data['Address']; ?></td>
                            </tr>
                            <tr>
                                <td>CGPA</td>
                                <td><?php echo $row_data['CGPA']; ?></td>
                            </tr>
                            <tr>
                                <td>Message</td>
                                <td><?php echo $row_data['Message']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <center><br>
                <br><a class="result_btn" href="result/index.html">Result</a></br></br></br><button class="logout_btn">LOGOUT</button></center>
            </form>
            <br>
        </div>
    </div>
</body>

</html>
