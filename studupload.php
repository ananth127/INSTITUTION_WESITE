<!DOCTYPE html>
<html>

<head>
	<title>Image Upload Using PHP</title>
	<style>
		body {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			min-height: 100vh;
			background: linear-gradient(0deg, rgba(132, 208, 99, 0.5999649859943977) 0%, rgba(49, 138, 145, 0.756827731092437) 50%, rgba(109, 110, 113, 1) 100%);
		}
	</style>
</head>

<body>
	

	<?php 
	session_start();
	if (isset($_GET['error'])) : ?>
		<p><?php echo $_GET['error']; ?></p>
	<?php endif ?>
	<form action="studcertupload.php" method="post" enctype="multipart/form-data">

		<input type="file" name="my_image" required><br><br>
		<input type="text" name="name" required minlength="3" ><br><br>
		<input type="submit" name="submit" value="Upload">

	</form>
</body>

</html>