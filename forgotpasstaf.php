<?php
    session_start();
    $_SESSION["uname"] =$_POST["uname"];
    $uname=$_POST["uname"];
    $password1=$_POST["password"];
  
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
        $stmt = $conn->prepare("select * from `staffdata` WHERE USERNAME=?");
                        $stmt->bind_param("s",$uname);
                        $stmt->execute();
                        $stmt_result= $stmt->get_result();
                        if($stmt_result->num_rows>0){
                             $data=$stmt_result->fetch_assoc();
                           $id=$data['USERNAME'];
                            if($id==$id){
                                date_default_timezone_set('Asia/Kolkata');
            $date=date('Y-m-d H:i:s');
        
        
        $stmt = $conn->prepare("update staffdata set PASSWORD=? where USERNAME=?");
        $password= hash('SHA256', $password1);
        $stmt->bind_param("ss",$password,$uname);
        $stmt->execute();
        echo"Password changed successfully.....";
        
        $stmt->close();
        $conn->close();
                               
                           }
                        }
                           else{
                               echo "<br><br>ID NOT Exists !!!!! <br><br>";
                               ?>
                               <a href ="staffnew.html">SIGN UP</a>    to continue<?php
                           }
                         
        
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Password</title>
    </head>
    <body>
        <form action="logout.php">
            <br><button class="btnn" >Go to home</button></a>
        </form>
</body>
</html>

