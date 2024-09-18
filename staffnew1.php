<?php

    $uname=$_POST["uname"];
    $password1=$_POST["password"];
    $idno=$_POST["idno"];
    $name=$_POST["name"];
    $HOD=$_POST["class"];
    
    if ($idno!=9225){
        echo "<h2>Invalid IDNO !!!!!</h2>";
    }
    else{
    //data base connection
     // Database connection
     include 'connection.php';
        
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
    
    else{
        $stmt = $conn->prepare("select * from `staffdata` WHERE USERNAME=?");
                        $stmt->bind_param("s",$uname);
                        $stmt->execute();
                        $stmt_result= $stmt->get_result();
                        if($stmt_result->num_rows>0){
                             $data=$stmt_result->fetch_assoc();
                           $id=$data['USERNAME'];
                            if($id==$id){
                               echo "ID Already Exists !!!!!";
                           }
                        }
                           else{
                         
        date_default_timezone_set('Asia/Kolkata');
            $date=date('Y-m-d H:i:s');
        $stmt = $conn->prepare("insert into staffdata(USERNAME,PASSWORD,NAME,CLASS,LASTLOGIN)values(?,?,?,?,?)");
        $password= hash('SHA256', $password1);
        $stmt->bind_param("sssss",$uname,$password,$name,$HOD,$date);
        $stmt->execute();
        echo "registration successfully.....";
        $stmt->close();
        $conn->close();
    }
}}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Password</title>
    </head>
    <body>
        <br><a href ="firstpage1.html">Go to Home Page</a>
</body>
</html>
