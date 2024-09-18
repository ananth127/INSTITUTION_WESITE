<?php
session_start();
$uname=$_SESSION["uname"];

 // Database connection
 include 'connection.php';
        
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 $con=$conn;

?>



<!DOCTYPE html>
<html lang="eng">
<head>
    <link rel="stylesheet" href="studentsnew.html">
    <title>STUDENT PROFILE</title>

    <script></script>
</head>
<div class="bg">
    <div class="fbt">
        <h2><centre>New User</centre></h2>
    </div>
    <div class="fbb">
        <h2>Welcome To IT Dept.</h2>
        <form action="logout.php" method="post">
            
            <div>
                
            
                    <table>
                        <tr><br>
                            <td>USERNAME</td>
                            <td>PASSWORD</td>
                            <td>NAME</td>
                            <td>DEPARTMENT</td>
                            <td>BLOODGROUP</td>
                            <td>MARK</td>
                            <td>CITY</td>
                            <td>BIRTHDAY</td>
                        </tr><br>

                    <?php
                
                
                        
                        echo $uname;
                        $query="SELECT * from itdata";
                        $result=mysqli_query($con,$query);
                        while($row =mysqli_fetch_array($result)){
                            ?>
                            <tr>
                                
                                <td><?php echo $row['USERNAME']; ?></td>
                                <td><?php echo $row['PASSWORD']; ?></td>
                                <td><?php echo $row['NAME']; ?></td>
                                <td><?php echo $row['DEPARTMENT']; ?></td>
                                <td><?php echo $row['BLOODGROUP']; ?></td>
                                <td><?php echo $row['MARK']; ?></td>
                                <td><?php echo $row['CITY']; ?></td>
                                <td><?php echo $row['BIRTHDAY']; ?></td>
                            </tr>
                            

                            <?php
                        }

            
                        

                    
                     
                    ?>
                    

                </table>
            </div>
            <a href="studentsnew.html"> NEW STUDENT </a> ADD here</a></p>
            <button class="btnn" >SUBMIT</button></a>
        </form>
        <br>
    </div>
</div>

</html>