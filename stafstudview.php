<?php

session_start();
$_SESSION["studuname"] =$_POST["studuname"];
if((!isset($_SESSION["studuname"]))and (!isset($_SESSION["studuname"]))){
    header('Location: firstpage1.html');
}
$uname=$_SESSION["studuname"];
include 'connection.php';
if($conn->connect_error){
    echo "Connection problem!!!! ";
    exit();
}

?>



<!DOCTYPE html>
<html lang="eng">
<head>
    <title>STUDENT PROFILE</title>
    <style>
        table, th, td {
  border: 1px solid;
  
}
td{
    width:130px;
}
    </style>

    <script></script>
</head>
<div class="bg">
    <div class="fbt">
        <h2><center>My-Performance</center></h2>
    </div>
    <div class="fbb">
        <h2>Welcome To IT Dept.</h2>
        <form action="logout.php" method="post">
            
            <div>
                <?php
                 echo $uname;
                ?>
            <br>
                        <br>
                                    <br>
                    <CENTER><table >
                        <tr><br>
                            
                            <td>ROLLNO</td>
                            
                            <td>NAME</td>
                            <td>CLASS</td>
                            <td>DEPARTMENT</td>
                            
                            <td>MARK</td>
                            
                            <td>BIRTHDAY</td>
                            <td>CERTIFICATE</td>
                            <td>CERTIFICATE</td>
                            <td>LASTLOGIN</td>
                        </tr><br>

                    <?php
                
                
                        
                        
                        
                        $query="select * from `itdata3` where `itdata3`.ROLLNO='$uname'";
                        $result=mysqli_query($con,$query);
                        while($row =mysqli_fetch_array($result)){
                            $class=$row['CLASS'];
                            $id = $row['ROLLNO'];
                            ?>
                            <tr><br>
                                <td><?php echo $row['ROLLNO']; ?></td>
                                <td><?php echo $row['NAME']; ?></td>
                                <td><?php echo $row['CLASS']; ?></td>
                                <td><?php echo $row['DEPARTMENT']; ?></td>
                                
                                <td><?php echo $row['MARK']; ?></td>
                                
                                <td><?php echo $row['BIRTHDAY']; ?></td>
                                <td><a href="studupload.php">Upload</a></td>
                                <td><a href="stafstudimgview.php">View</a></td>
                                <td><?php echo $row['LASTLOGIN']; ?></td>
                            </tr>

                            <?php
                        }

            
                        date_default_timezone_set('Asia/Kolkata');
                        
            $date=date('Y-m-d H:i:s');
            $sql=$con->prepare("update `itdata3` set LASTLOGIN='$date' where ROLLNO=?");
            $last=$con->prepare("insert into lastlogin values(?,?,?)");
            $last->bind_param("sss",$id,$class,$date);
                $sql->bind_param("s",$id);
                $sql->execute();
                $last->execute();

                    
                     
                    ?>
                    

                </table></CENTER>
                            <br>
                                        <br>
            </div>
            
            <center><button class="btnn" >LOGOUT</button></a></center>
        </form>
        <br>
    </div>
</div>

</html>