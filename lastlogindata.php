<?php
session_start();
if(!isset($_SESSION["uname"])){
    header('Location: firstpage1.html');
}
$uname=$_SESSION["uname"];

 // Database connection
 include 'connection.php';
        
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }

?>

<!DOCTYPE html>
<html lang="eng">
<head>
    
    <title>STUDENT LASTLOGIN</title>
    <style>
        table, th, td {
  border: 1px solid;
  text-align: center;  
  
}
td{
    width:150px;
}
    </style>
    <script></script>
</head>
<body>
<div class="bg">
    <div class="fbt">
        <h2><centre>STUDENTS LASTLOGIN</centre></h2>
    </div>
    <div class="fbb">
        <h2>IT Dept.</h2>
        
        <form action="logout.php" method="post">
            
            <div>
            
                        
                        <?php

        $stmt = $conn->prepare("select * from `staffdata` WHERE USERNAME=?");
                        $stmt->bind_param("s",$uname);
                        $stmt->execute();
                        $stmt_result= $stmt->get_result();
                        if($stmt_result->num_rows>0){
                            $data = $stmt_result->fetch_assoc();
                            $class=$data['CLASS'];
                            $id=$data['USERNAME'];
                            echo "ID = $id";}
                            ?>
                            
            
            <center>       <table><br>
                    <br>
                        <tr><br>
                            
                            <td>ROLLNO</td>
                            
                            <td>CLASS</td>
                            
                            <td>LASTLOGIN</td>
                        </tr><br><?php
                            if($class=="HOD"){
                            $query="select * from `lastlogin`";
                        $result=mysqli_query($conn,$query);
                        
                        while($row =mysqli_fetch_array($result)){
                            
                            ?>
                           
                            <tr>
                                
                                <td><?php echo $row['ROLLNO']; ?></td>
                                <td><?php echo $row['CLASS']; ?></td>
                                <td><?php echo $row['LASTLOGIN']; ?></td>
                            </tr>
                            

                            <?php
                        }
                                
                            }
                            else if($class=="ADMIN"){
                            $query="select * from `stafflastlogin`";
                        $result=mysqli_query($conn,$query);
                        
                        while($row =mysqli_fetch_array($result)){
                            
                            ?>
                           
                            <tr>
                                
                                <td><?php echo $row['ROLLNO']; ?></td>
                                <td><?php echo $row['CLASS']; ?></td>
                                <td><?php echo $row['LASTLOGIN']; ?></td>
                            </tr>
                            

                            <?php
                        }
                                
                            }
                            else{
                                $query="select * from lastlogin where lastlogin.CLASS='$class'";
                        $result=mysqli_query($conn,$query);
                        while($row =mysqli_fetch_array($result)){
                            ?>
                            <tr>
                                
                                <td><?php echo $row['ROLLNO']; ?></td>
                                
                                <td><?php echo $row['CLASS']; ?></td>
                                <td><?php echo $row['LASTLOGIN']; ?></td>
                            </tr>
                            
                            <?php
                        
                            }
                            
                            
                            
                        }
                        
?>
</table></center> 
        <br>
    </div>
</div>
</div><br><br>
<button class="btnn" >LOGOUT</button><br><br></form>
</body>
</html>