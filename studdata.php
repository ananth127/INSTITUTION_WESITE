<?php
session_start();

// Check if the username is set in session
if (!isset($_SESSION["uname"])) {
    header('Location: firstpage1.html');
    exit(); // Stop further execution
}

$uname = $_SESSION["uname"];


 // Database connection
 include 'connection.php';
        
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 $con=$conn;
?>

<!DOCTYPE html>
<html lang="eng">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>STUDENT PROFILE</title>
    <style>
        table,
        th,
        td {
            border: 1px solid;
        }

        td {
            width: 130px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="bg">
            <div class="fbt">
                <h2>
                    <center>My-Performance</center>
                </h2>
            </div>
            <div class="fbb">
                <h2>Welcome To IT Dept.</h2>
                <form action="logout.php" method="post">
                    <div>
                        <?php echo $uname; ?>
                        <br><br><br>
                        <CENTER>
                            <table>
                                <tr>
                                    <td>ROLLNO</td>
                                    <td>REG No.</td>
                                    <td>NAME</td>
                                    <td>CLASS</td>
                                    <td>DEPARTMENT</td>
                                    <td>DOB</td>
                                    <td>GENDER</td>
                                    <td>MOBILE NO.</td>
                                    <td>EMAIL ID</td>
                                    <td>ADDRESS</td>
                                    <td>CGPA</td>
                                    <td>MESSAGE</td>
                                </tr>

                                <?php
                                $query = "SELECT * FROM `stud_data` WHERE `Roll No` = ?";
                                $stmt = $con->prepare($query);
                                $stmt->bind_param("s", $uname);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['Roll No']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Register No']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Student Name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Class']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Department']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Date of Birth']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Gender']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Mobile Number']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Email Id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Address']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['CGPA']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Message']; ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </CENTER>
                        <br>
                    </div>
                    <center><button class="btnn">LOGOUT</button></center>
                </form>
                <br>
            </div>
        </div>
    </div>
</body>

</html>