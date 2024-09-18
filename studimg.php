<?php 
include 'connection.php';
if($conn->connect_error){
    echo "Connection problem!!!! ";
    exit();
}
session_start();
if(!isset($_SESSION["uname"])){
    header('Location: firstpage1.html');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>View</title>
	<style>
		body {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-wrap: wrap;
			min-height: 100vh;
		}
		.alb {
			width: 200px;
			height: 200px;
			padding: 5px;
		}
		.alb img {
			width: 100%;
			height: 100%;
		}
		a {
			text-decoration: none;
			color: black;
		}
	</style>
</head>
<body>
     <a href="staffdata.php">&#8592;</a>
     <?php 
          $sql = "SELECT * FROM 21it_a_image_1 ";
          $res = mysqli_query($conn,  $sql);

          if (mysqli_num_rows($res) > 0) {
          	while ($images = mysqli_fetch_assoc($res)) {  ?>
             
             <div class="alb">
             	<img src="uploads/<?=$images['IMAGE_URL']?>">
             </div>
          		
    <?php } }?>
</body>
</html>