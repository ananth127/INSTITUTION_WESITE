<?php
session_start();
if (!isset($_SESSION["uname"])) {
    header('Location: index.html');
}
$uname = $_SESSION["uname"];

 // Database connection
 include 'connection.php';
        
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Login</title>
    <style>
        /* Add CSS styles for layout */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        .container {
            display: flex;
            flex-direction: row;
            height: 100vh;
        }

        .sidebar {
            background-color: #f4f4f4;
            width: 20%;
            padding: 20px;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        .iframe-container {
            width: 100%;
            height: 100%;
            border: none;
            /* Remove border */
        }
        .stud_rollno{
            text-decoration: none;
            color: #333;
            border:1px solid blue;
            margin: 10px;
            padding: 10px;
            display: flex;
            justify-content: center;
        }
        .btnn{
            text-align: right;

        }.logout_btn{
            border: 10px solid red;
            text-decoration: none;
            background-color:blanchedalmond ;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <h1>Staff Login</h1>
        <div class="btnn"> <a class="logout_btn" href="logout.php">LOGOUT</a>
 </div>
            </div>

    <!-- Container for Sidebar and Content -->
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar" style="overflow-y: auto;">
            
            <?php
            $stmt = $conn->prepare("select * from `staffdata` WHERE USERNAME=?");
            $stmt->bind_param("s", $uname);
            $stmt->execute();
            $stmt_result = $stmt->get_result();
            if ($stmt_result->num_rows > 0) {
                $data = $stmt_result->fetch_assoc();
                $class = $data['CLASS'];
                $id = $data['USERNAME'];
                $name = $data['NAME'];
                echo "Staff ID = $id <br>";
            }
            ?>
            <h2>Studene's RollNo.</h2>
            <ul>
                <?php
                if ($class == "HOD") {
                    $query = "select * from `stud_data`";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) {
                ?>
                        <li>
                            <!-- Embedding PHP code inside JavaScript function call -->
                            <a class="stud_rollno" href="#" onclick="loadContent('content2.php', {uname: '<?php echo $row['Roll No']; ?>', pass: 'your_password'})"><?php echo $row['Roll No']; ?></a>
                        </li>
                <?php
                    }
                }
                
                else if($class=="ADMIN"){
                    $query="select * from `staffdata`";
                $result=mysqli_query($conn,$query);
                while($row =mysqli_fetch_array($result)){
                    
                ?>
                 <li>
                            <!-- Embedding PHP code inside JavaScript function call -->
                            <a class="stud_rollno" href="#" onclick="loadContent('content2.php', {uname: '<?php echo $row['Roll No']; ?>', pass: 'your_password'})"><?php echo $row['Roll No']; ?></a>
                        </li>
                <?php
                    }
                }
                
                else{

                    $query="select * from `stud_data` where stud_data.`Class`='$class'";
                    $result=mysqli_query($conn,$query);
                    while($row =mysqli_fetch_array($result)){
                        ?>
                         <li>
                            <!-- Embedding PHP code inside JavaScript function call -->
                            <a class="stud_rollno" href="#" onclick="loadContent('content2.php', {uname: '<?php echo $row['Roll No']; ?>', pass: 'your_password'})"><?php echo $row['Roll No']; ?></a>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>
        </div>

        <!-- Content -->
        <div class="content">
            <iframe class="iframe-container" id="content-frame" name="content-frame"></iframe>
        </div>
    </div>

    <!-- JavaScript function to load content inside iframe -->
    <script>
        function loadContent(url, data) {
            var iframe = document.getElementById('content-frame');

            // Construct URL with query parameters
            var queryParams = [];
            for (var key in data) {
                if (data.hasOwnProperty(key)) {
                    queryParams.push(encodeURIComponent(key) + '=' + encodeURIComponent(data[key]));
                }
            }
            var queryString = queryParams.join('&');
            var fullUrl = url + '?' + queryString;

            // Set iframe src to the constructed URL
            iframe.src = fullUrl;
        }
    </script>
</body>

</html>