<?php
    session_start();
    $_SESSION["staff_id"] =$_POST["uname"];
    $uname=$_POST["uname"];
    $password=$_POST["password"];

    //data base connection
     // Database connection
     include 'connection.php';
        
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }else{
        $stmt = $conn->prepare("select * from staffdata where USERNAME=?");
        $stmt->bind_param("s",$uname);
        $stmt->execute();
        $stmt_result= $stmt->get_result();
        if($stmt_result->num_rows>0){
            $data = $stmt_result->fetch_assoc();
            if(hash('SHA256',$password)===$data["password"]){
                
                header("Location: staff_stud_view.php");
            }else{
                echo "Invalid Email or password";
            }
        }else{
            echo "Invalid Email or password";
        }
    }
?>
