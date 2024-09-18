<?php


    $uname=$_POST["uname"];
    $password1=$_POST["password"];
    $name=$_POST["name"];
    $Dept=$_POST["dept"];
    
    $class=$_POST["class"];
    $mark=$_POST["mark"];
    $city=$_POST["city"];
    $birthday=$_POST["birthday"];


    //data base connection
    include 'connection.php';
    if($conn->connect_error){
        echo "Connection problem!!!! ";
        exit();
    }else{
        $stmt = $conn->prepare("select * from `itdata3` WHERE ROLLNO=?");
                        $stmt->bind_param("s",$uname);
                        $stmt->execute();
                        $stmt_result= $stmt->get_result();
                        if($stmt_result->num_rows>0){
                             $data=$stmt_result->fetch_assoc();
                           $id=$data['ROLLNO'];
                            if($id==$id){
                               echo "ID Already Exists !!!!!";
                           }
                        }
                           else{
                         
        date_default_timezone_set('Asia/Kolkata');
            $date=date('Y-m-d H:i:s');
        $password= hash('SHA256', $password1);
        $stmt = $conn->prepare("insert into `itdata3` (ROLLNO,PASSWORD,NAME,CLASS,DEPARTMENT,MARK,CITY,BIRTHDAY,LASTLOGIN)values(?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssss",$uname,$password,$name,$class,$Dept,$mark,$city,$birthday,$date);
        $stmt->execute();
        echo"registration successfully.....";
        $stmt->close();
        $conn->close();}
    }
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