<?php
session_start();
if (!isset($_SESSION["staff_id"])) {
    header('Location: index.html');
    exit;
}


$staff_id = $_SESSION["staff_id"];
$stud_id = isset($_POST["rollNo"]) ? $_POST["rollNo"] : $_SESSION["stud_id"];

 // Database connection
 include 'connection.php';
        
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 $con=$conn;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the edited data from the form fields
    $editedRollNo = $_POST['rollNo'];
    $editedRegNo = $_POST['regno'];
    $editedName = $_POST['studname'];
    $editedClass = $_POST['class'];
    $editedDepartment = $_POST['department'];
    $editedDOB = $_POST['dob'];
    $editedGender = $_POST['gender'];
    $editedMobile = $_POST['mobileno'];
    $editedEmail = $_POST['emailid'];
    $editedAddress = $_POST['address'];
    $editedCGPA = $_POST['cgpa'];
    $editedMessage = $_POST['message'];
    
    $updateQuery = "UPDATE `stud_data` SET 
    `Roll No`='$editedRollNo', 
    `Register No`='$editedRegNo', 
    `Student Name`='$editedName', 
    `Class`='$editedClass', 
    `Department`='$editedDepartment', 
    `Date of Birth`='$editedDOB', 
    `Gender`='$editedGender', 
    `Mobile Number`='$editedMobile', 
    `Email Id`='$editedEmail', 
    `Address`='$editedAddress', 
    `CGPA`='$editedCGPA', 
    `Message`='$editedMessage' 
    WHERE `Roll No`='$stud_id'";
    $result = mysqli_query($con, $updateQuery);
    if ($result) {
        
        header("Location: content2.php?stud_id=$stud_id");
        echo '<script>alert("Data updated successfully!.");</script>';
    } else {
        echo "Error updating data: " . mysqli_error($con);
    }
}
?>
