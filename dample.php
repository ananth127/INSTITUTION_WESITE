<?php
    session_start();
    $_SESSION["uname"] =$_POST["uname"];
    $uname=$_POST["uname"];
    $password=$_POST["password"];
    $password2=$_POST["password2"];
    $idno=$_POST["idno"];
    if ($idno!=1234){
        echo "<h2>Invalid IDNO !!!!!</h2>";
    }
    else{
    //data base connection
    include 'connection.php';
    
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
        $stmt = $conn->prepare("update itdata set PASSWORD=? where USERNAME=?");
        $stmt->bind_param("ss",$password,$uname);
        $stmt->execute();
        echo"Password changed successfully.....";
        
        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Password</title>
    </head>
    <body><form action="logout.php">
        <br><button class="btnn" >GO to home</button></a>
        </form>
</body>
</html>

