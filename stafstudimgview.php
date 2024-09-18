<?php 
session_start();
$_SESSION=$_GET["stud_id"];
$stud_id = $_GET["stud_id"];

include 'connection.php';
if($conn->connect_error){
    echo "Connection problem!!!! ";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Certificates</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            padding: 20px;
        }
        .certificate {
            width: calc(20% - 40px); /* 20% width with 40px margin */
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .certificate_view {
            width: 100%;
            height: 250px; /* Adjust height as needed */
            border: none;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .certificate h2 {
            margin-top: 0;
            font-size: 18px;
        }
        .download-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .download-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <?php 
    $sql = "SELECT * FROM stud_cert WHERE `Roll No`='$stud_id'";
    $res = mysqli_query($conn, $sql);

    $counter = 0; // Counter to track the number of certificates in the row

    if(mysqli_num_rows($res) > 0) {
        while($certificate = mysqli_fetch_assoc($res)) {
            if ($counter % 5 == 0) {
                echo '<div class="clearfix"></div>'; // Clearfix for every 5th certificate
            }
            ?>
            <div class="certificate">
                <?php if (pathinfo($certificate['Image_url'], PATHINFO_EXTENSION) === 'pdf'): //uploads/<?= $certificate['Image_url']  ?>
                    <iframe class="certificate_view" src="#" frameborder="0"></iframe>
                <?php else: ?>
                    <img class="certificate_view" src="uploads/<?= $certificate['Image_url'] ?>" alt="Certificate">
                <?php endif; ?>
                <h2><?= $certificate['Certificate_Name'] ?></h2>
                <a href="uploads/<?= $certificate['Image_url'] ?>" class="download-link" download>Download</a>
            </div>
            <?php 
            $counter++;
        }
    } else { ?>
        <p>No certificates found.</p>
    <?php } ?>
</div>
</body>
</html>
