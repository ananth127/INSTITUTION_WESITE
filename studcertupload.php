<?php 
session_start();
$uname=$_SESSION["uname"];
if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
	include 'connection.php';
if($conn->connect_error){
    echo "Connection problem!!!! ";
    exit();
}

//echo $uname;
	//echo "<pre>";
//	print_r($_FILES['my_image']);
//	echo "</pre>";
    $name=$_POST['name'];
$img_name = $_FILES['my_image']['name'];
$img_name1 =$name;
//echo $img_name;
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];

	if ($error === 0) {
		
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png","pdf","dox"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
			    $new_img_name =$uname.".".$name.'.'.$img_ex_lc;
				//$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'uploads/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

				// Insert into Database
				$sql = "INSERT INTO `stud_cert`(`Roll No`,`Image_url`,`Certificate_Name`) 
				        VALUES('$uname','$new_img_name','$name')";
				mysqli_query($conn, $sql);
				
				header("Location: studata.php");
			}else {
				$em = "You can't upload files of this type";
		        header("Location: studupload.php?error=$em");
			}
		
	}else {
		$em = "unknown error occurred!";
		header("Location: studupload.php?error=$em");
	}

}else {
	header("Location: studupload.php");
}