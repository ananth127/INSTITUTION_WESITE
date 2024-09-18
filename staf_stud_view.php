<?php
session_start();
if(!isset($_SESSION["uname"])){
    header('Location: index.html');
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
    <link rel="stylesheet" href="studentsnew.html">
    <title>STUDENT PROFILE</title>
    <style>
        table, th, td {
  border: 1px solid;
  text-align:center;
  
}
td{
    width:130px;
}
    </style>
    <script></script>
</head>
<body>
<div class="bg">
    <div class="fbt">
       <center> <h2>STUDENTS DEATILS</h2>
    </div>
    <div class="fbb">
        <h2>INFORMATION TECHNOLOGY</h2></center>
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
                           $name=$data['NAME'];
                           echo "NAME = $name <br>";
                           echo "ID = $id ";
                        }
                        ?>
                        <br>
                        <br>
                                    <br>
                    <CENTER><table >
                        <tr><br>
                            
                            <td>ROLLNO</td>
                            <td>PASSWORD</td>
                            <td>NAME</td>
                            <td>CLASS</td>
                            <td>DEPARTMENT</td>
                            
                            <td>MARK</td>
                            <td>CERTIFICATE</td>
                            <td>BIRTHDAY</td>
                            <td>LASTLOGIN</td>
                        </tr><br>
                        <?php 
                        
                        if($class=="HOD"){
                            $query="select * from `itdata3`";
                        $result=mysqli_query($conn,$query);
                        while($row =mysqli_fetch_array($result)){
                            ?>
                            
                            
                            <tr>
                                
                                <td><?php echo $row['ROLLNO']; ?></td>
                                <td><?php echo $row['PASSWORD']; ?></td>
                                <td><?php echo $row['NAME']; ?></td>
                                <td><?php echo $row['CLASS']; ?></td>
                                <td><?php echo $row['DEPARTMENT']; ?></td>
                                <td><?php echo $row['MARK']; ?></td>
                                <td><a href="studimgview.php">View</a></td>
                                <td><?php echo $row['BIRTHDAY']; ?></td>
                                <td><?php echo $row['LASTLOGIN']; ?></td>
                            </tr>
                            

                            <?php 
                             
                        }
                            date_default_timezone_set('Asia/Kolkata');
                        
                        $date=date('Y-m-d H:i:s');
                        $sql=$conn->prepare("update `itdata3` set LASTLOGIN='$date' where ROLLNO=?");
                        $last=$conn->prepare("insert into stafflastlogin values(?,?,?)");
                        $last->bind_param("sss",$id,$class,$date);
                            $sql->bind_param("s",$id);
                            $sql->execute();
                            $last->execute();
                        }
                        else if($class=="ADMIN"){
                            $query="select * from `staffdata`";
                        $result=mysqli_query($conn,$query);
                        while($row =mysqli_fetch_array($result)){
                            ?>
                            
                            
                            <tr>
                                
                                <td><?php echo $row['USERNAME']; ?></td>
                                <td><?php echo $row['PASSWORD']; ?></td>
                                <td><?php echo $row['NAME']; ?></td>
                                <td><?php echo $row['CLASS']; ?></td>
                               
                                
                                <td><?php echo $row['LASTLOGIN']; ?></td>
                            </tr>
                            

                            <?php 
                             
                        }
                            date_default_timezone_set('Asia/Kolkata');
                        
                        $date=date('Y-m-d H:i:s');
                        $sql=$conn->prepare("update `staffdata` set LASTLOGIN='$date' where USERNAME=?");
                        $last=$conn->prepare("insert into stafflastlogin values(?,?,?)");
                        $last->bind_param("sss",$id,$class,$date);
                            $sql->bind_param("s",$id);
                            $sql->execute();
                            $last->execute();
                        }
                        else{

                        $query="select * from `itdata3` where itdata3.CLASS='$class'";
                        $result=mysqli_query($conn,$query);
                        while($row =mysqli_fetch_array($result)){
                            ?>
                            <tr>
                                
                                <td><form action="stafstudview.php" method="post">
                                    <input type="hidden" name="studuname" value=<?php echo $row['ROLLNO']; ?> ><button><?php echo $row['ROLLNO'];?></button></form></td>
                                <td><?php echo $row['PASSWORD']; ?></td>
                                <td><?php echo $row['NAME']; ?></td>
                                <td><?php echo $row['CLASS']; ?></td>
                                <td><?php echo $row['DEPARTMENT']; ?></td>
                                
                                <td><?php echo $row['MARK']; ?></td>
                                <td><a href="studimgview.php">View</a></td>
                                <td><?php echo $row['BIRTHDAY']; ?></td>
                                <td><?php echo $row['LASTLOGIN']; ?></td>
                            </tr>
                            

                            <?php
                             
                        }
                            date_default_timezone_set('Asia/Kolkata');
                        
            $date=date('Y-m-d H:i:s');
            $sql=$conn->prepare("update `itdata3` set LASTLOGIN='$date' where ROLLNO=?");
            $last=$conn->prepare("insert into stafflastlogin values(?,?,?)");
            $last->bind_param("sss",$id,$class,$date);
                $sql->bind_param("s",$id);
                $sql->execute();
                $last->execute();
                        }

            
                        

                    
                     
                    ?>
                    

                </table></center>
            </div><br>
            <a href="studentsnew.html"> NEW STUDENT </a> ADD here</a></p>
            <a href="lastlogindata.php">STUDENTS LAST LOGIN</a><br>
            <br>Export : 
            <a href="export.php"><img src="excel.jpg" style="padding-top:10px;width:40px;height:40px;"></a><br><br>
            <button class="btnn" >LOGOUT</button></a>
        </form>
        <br>
    </div>
</div>c:\xampp\htdocs\mydemo
</body>
</html>