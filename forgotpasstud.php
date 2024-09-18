<?php
session_start();

// Check if all necessary POST data are set
if(isset($_POST["uname"], $_POST["password"], $_POST["idno"])) {
    $uname = $_POST["uname"];
    $password1 = $_POST["password"];
    $idno = $_POST["idno"];

    // Check if idno is valid
    if ($idno != 1234) {
        echo "<h2>Invalid IDNO !!!!!</h2>";
    } else {
        // Database connection
        include 'connection.php';
        

        echo "<script>console.log(" . json_encode($idno) . ");</script>";
        if ($conn->connect_error) {
            die('Connection Failed : ' . $conn->connect_error);
        } else {
            $stmt = $conn->prepare("SELECT * FROM `student_login` WHERE `Roll No` = ?");
            $stmt->bind_param("s", $uname);
            $stmt->execute();
            $stmt_result = $stmt->get_result();

            if ($stmt_result->num_rows > 0) {
                // Fetching data
                $data = $stmt_result->fetch_assoc();
                $id = $data['Roll No'];
                
                echo "<script>console.log(" . json_encode($id) . ");</script>";
                
                echo "<script>console.log(" . json_encode($uname) . ");</script>";

                // Check if provided ID matches with the fetched ID
                if ($id === $uname) {
                    date_default_timezone_set('Asia/Kolkata');
                    $date = date('Y-m-d H:i:s');
                    echo "<script>console.log(" . json_encode($uname) . ");</script>";
                    $password = hash('SHA256', $password1);

                    // Update password
                    $stmt_update = $conn->prepare("UPDATE `student_login` SET PASSWORD=? WHERE `Roll No`=?");
                    $stmt_update->bind_param("ss", $password, $uname);
                    $stmt_update->execute();

                    echo "Password changed successfully.....";

                    $stmt_update->close();
                }
            } else {
                echo "<br><br>ROLLNO. Not Exists !!!!! <br><br>";
                echo "<h4>Ask Admin to add you.......<h4>";
            }

            $stmt->close();
            $conn->close();
        }
    }
} else {
    echo "Not all necessary fields are provided!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Password</title>
</head>
<body>
    <form action="logout.php">
        <br><button class="btnn" >GO to home</button></a>
    </form>
</body>
</html>
