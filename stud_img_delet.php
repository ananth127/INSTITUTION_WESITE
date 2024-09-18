<?php
session_start();
$stud_id = $_SESSION["uname"];

// Check if certificate_id is set and not empty
if(isset($_POST['Image_url']) && !empty($_POST['Image_url'])) {
    $certificate_id = $_POST['Image_url'];

    // Establish connection to the database
    include 'connection.php';
if($conn->connect_error){
    echo "Connection problem!!!! ";
    exit();
}

    // Prepare SQL query to delete the certificate
    $sql = "DELETE FROM stud_cert WHERE Image_url = '$certificate_id' AND `Roll No`='$stud_id'";
    
    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the page where certificates are viewed after successful deletion
        header("Location: studimgview.php");
        exit();
    } else {
        // If there's an error in executing the query, display an error message
        echo "Error deleting record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // If certificate_id is not set or empty, redirect back to the page where certificates are viewed
    header("Location: studimgview.php");
    exit();
}
?>
