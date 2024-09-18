<?php
session_start();
$uname=$_SESSION["uname"];
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
                            <td>IMAGE</td>
                            <td>USERNAME</td>
                            
                        </tr><br>

                    <?php
                
                
                        
                        echo $uname;
                        $query="select * from 21it_a_image_1 where USERNAME='$uname'";
                        $result=mysqli_query($con,$query);
                        while($row =mysqli_fetch_array($result)){
                            ?>
                            <tr><br>
                                <td><img src="21ITAIMAGES/<?=$row['IMAGE_URL']?>"></td>
                                <td><?php echo $row['USERNAME']; ?></td>
                                
                            </tr>

                            <?php
                        }

            
                        

                    
                     
                    ?>
                    

                </table>
            </div>
            
            <button class="btnn" >SUBMIT</button></a>
        </form>
        <br>
    </div>
</div>

</html>