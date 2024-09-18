<?php
session_start();
$uname = $_POST["uname"];
$password = $_POST["password"];

// Database connection
 // Database connection
 include 'connection.php';
        
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }else {
    $stmt = $conn->prepare("SELECT * FROM `itdata3` WHERE ROLLNO=?");
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if ($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();
        if (password_verify($password, $data['PASSWORD']) || $data['ROLLNO'] == $uname) {
            $_SESSION["uname"] = $uname; // Storing username in session if needed
            echo "success"; // Sending response to Android app
        } else {
            echo "Invalid Email or password";
        }
    } else {
        echo "Invalid Email or password";
    }
}
?>
