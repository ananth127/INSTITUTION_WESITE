<?php
session_start();

// Check if username and password are set in POST data
if(isset($_POST["uname"]) && isset($_POST["password"])) {
    $uname = $_POST["uname"];
    $password = $_POST["password"];

    include 'connection.php';
if($conn->connect_error){
    echo "Connection problem!!!! ";
    exit();
}else {
        // Prepare SQL statement
        $stmt = $conn->prepare("SELECT * FROM student_login WHERE `Roll No` = ?");
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $stmt_result = $stmt->get_result();

        if ($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();

            // Verify the password
            // Check if the password matches (considering hashing)
            if ($data['Date of Birth'] === $password || password_verify($password, $data['PASSWORD'])) {
                $_SESSION["uname"] = $uname; // Store username in session
                header("Location: studata.php"); // Redirect to studata.php
                exit(); // Ensure script execution stops after redirection
            } else {
                echo "Invalid Roll No or password"; // Password does not match
            }
        } else {
            echo "Invalid Roll No or password"; // No user found with the provided Roll No
        }
    }
} else {
    echo "Roll No or password not provided"; // Username or password not provided in POST data
}
?>
