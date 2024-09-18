<!DOCTYPE html>
<html lang="en">
<head>
    <title>Password</title>
</head>
<body>
    <form action="" method="post" >
        <label for="staff_message">Enter Message:</label><br>
        <textarea id="staff_message" name="staff_message" rows="4" cols="50"></textarea><br>
        <input type="submit" value="Send Message">
    </form>
    <script>
        function showMessageAlert() {
            alert("Message sent successfully.");
            return true;
        }
    </script>
<?php
session_start();
// Check if all necessary POST data are set
if(isset($_GET["staff_id"], $_POST["staff_message"])) {
    $class = $_GET["staff_id"];
    $staff_message = $_POST["staff_message"];
    include 'connection.php';
if($conn->connect_error){
    echo "Connection problem!!!! ";
    exit();
} else if($class=="HOD" || $class == "ADMIN"){
        // Update message
        $stmt_update = $conn->prepare("UPDATE `stud_data` SET Message=? ");
        $stmt_update->bind_param("s", $staff_message);
        $stmt_update->execute();
        echo '<script>alert("Message sent successfully.");</script>';
        $stmt_update->close();
        $conn->close();
    }
    else {
        // Update message
        $stmt_update = $conn->prepare("UPDATE `stud_data` SET Message=? where `Class`=? ");
        $stmt_update->bind_param("ss", $staff_message,$class);
        $stmt_update->execute();
        echo '<script>alert("Message sent successfully.");</script>';
        $stmt_update->close();
        $conn->close();
    }
} elseif(!isset($_GET["staff_id"])) {
    echo "Staff ID is not provided!";
} else {
    echo "Message is not provided!";
}
?>
</body>
</html>
