<?php

session_start();

if(!isset($_SESSION["uname"])){
    header('Location: firstpage1.html');
}
$uname=$_SESSION["uname"];
include 'connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set('Asia/Kolkata');
 $date=date('Y-m-d H:i:s');
$sql="select * from itdata3";
$res=mysqli_query($conn,$sql);
$html='Created : '.$date;
$html.='<table><tr><td>ROLLNO</td><td>NAME</td><td>DEPARTMENT</td><td>MARK</td></tr>';
while($row =mysqli_fetch_array($res)){

$html.='<tr><td>'.$row['ROLLNO'].'</td><td>'.$row['NAME'].'</td><td>'.$row['DEPARTMENT'].'</td><td>'.$row['MARK'].'</td></tr>';

}
$html.='</table>';

header("Content-Type: application/xls");
header("Content-Disposition: attachment;filename=report.xls");

echo $html;
?>


