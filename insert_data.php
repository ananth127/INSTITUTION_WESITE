<?php
// Database connection details

// Create connection
 // Database connection
 include 'connection.php';
        
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }

// Retrieve data sent from Android app
$data1 = $_POST['data1']; // Assuming 'data1' is sent from the app
$data2 = $_POST['data2']; // Assuming 'data2' is sent from the app

// Insert data into MySQL database
$sql = "INSERT INTO mobiledata (column1, column2) VALUES ('$data1', '$data2')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
