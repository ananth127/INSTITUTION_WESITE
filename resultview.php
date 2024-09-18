<html>

<head>
    <title>
        EXAM RESULT 2024
    </title>
    <style>
        #wrapper {
            position: relative;
            width: 1080px;
            min-width: 1080px;
            margin: 15px auto 0 auto;
            background: #FFFFFF;
            border-radius: 6px;
            box-shadow: 0px 5px 20px 2px rgba(0, 0, 0, 0.1);
            bottom: 0px;
        }

        html {


            flex-direction: column;

            background: linear-gradient(0deg, rgba(132, 208, 99, 0.5999649859943977) 0%, rgba(49, 138, 145, 0.756827731092437) 50%, rgba(109, 110, 113, 1) 100%);
        }
    </style>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>

<body>
    <div id="wrapper">
        <table align="margin-top" border="0" height="100%" width="100%">
            <tr style="height:20%">
                <td>
                    <h1 align="left"><img width="150px" height="100px" src="logo.jpg"></h1>
                </td>
                <td>
                    <h1 align="center">VSB ENGINEERING COLLEGE</h1>
                    <h3 align="CENTER"> (An Autonomous Institution)</h3>
                </td>
                <td>
                    <h1 align="right"><img height="100px" width="200px" src="rhineland.jpeg"> </h1>
                </td>

            </tr>
            <tr style="height:5%">
                <td colspan="3" align="right"><a href="#" onclick="printPage()">Print</a></td>
            </tr>

            <tr style="height:2%">
                <td colspan="3" bgcolor="#209D9D"></td>
            </tr>
            <tr style="height:20%">
                <td colspan="3" align="center">
                    <h2> Result for Nov / Dec Examination,2024</h2>
                </td>
            </tr>



            <?php
            $REGNO = $_POST['REGNO'];
            $DOB = $_POST['DOB'];
            // Database connection
        include 'connection.php';
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

            $query = "SELECT *
FROM `student_login_detials`
JOIN `iii_it_result_05` ON `student_login_detials`.REGNO = `iii_it_result_05`.`REG NO.`
WHERE `student_login_detials`.REGNO = '$REGNO' AND `student_login_detials`.DOB = '$DOB';
";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
            ?><tr>
                        <td align="center" colspan="3">
                            <br>
                            <table id="resulttable" align="center" rules="rows" border="1px" width="80%">
                                <tbody>
                                    <tr>
                                        <td colspan="4">
                                            <table style="width:100%;">
                                                <tbody>
                                                    <tr>
                                                        <th style="text-align:left; width:150px;">Register Number : </th>
                                                        <th colspan="3" style="text-align:left;"><?php echo $row["REGNO"]; ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th style="text-align:left;">Name : </th>
                                                        <th colspan="3" style="text-align:left;"><?php echo $row["Student_Name"]; ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th style="text-align:left;">Branch :</th>
                                                        <th colspan="3" style="text-align:left;"> <?php echo "IT" ?></th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="background:#1C7575;color:white;">Semester</th>
                                        <th style="background:#1C7575;color:white;">Subject Name</th>
                                        <th style="background:#1C7575;color:white;">Grade</th>
                                        <th style="background:#1C7575;color:white;">GPA</th>
                                    </tr>

                                    
                                    <tr>
                                        <th>05</th>
                                        <th>CS3591 - CN</th>
                                        <th><?php echo $row["CS3591-GRADE"]; ?></th>
                                        <th><?php echo $row["CS3591-GPA"]; ?></th>
                                    </tr>
                                    <tr>
                                        <th>05</th>
                                        <th>IT3501 - FSWD</th>
                                        <th><?php echo $row["IT3501-GRADE"]; ?></th>
                                        <th><?php echo $row["IT3501-GPA"]; ?></th>
                                    </tr>
                                    <tr>
                                        <th>05</th>
                                        <th>CS3551 - DC</th>
                                        <th><?php echo $row["CS3551-GRADE"]; ?></th>
                                        <th><?php echo $row["CS3551-GPA"]; ?></th>
                                    </tr>
                                    <tr>
                                        <th>05</th>
                                        <th>CS3691 - ESIoT</th>
                                        <th><?php echo $row["CS3691-GRADE"]; ?></th>
                                        <th><?php echo $row["CS3691-GPA"]; ?></th>
                                    </tr>
                                    <tr>
                                        <th>05</th>
                                        <th>CCS334 - BDA</th>
                                        <th><?php echo $row["CCS334-GRADE"]; ?></th>
                                        <th><?php echo $row["CCS334-GPA"]; ?></th>
                                    </tr>
                                    <tr>
                                        <th>05</th>
                                        <th>CCS366 - STA</th>
                                        <th><?php echo $row["CCS366-GRADE"]; ?></th>
                                        <th><?php echo $row["CCS366-GPA"]; ?></th>
                                    </tr>
                                    <tr>
                                        <th>05</th>
                                        <th>MX3084 - DRRM</th>
                                        <th><?php echo $row["MX3084-GRADE"]; ?></th>
                                        <th><?php echo $row["MX3084-GPA"]; ?></th>
                                    </tr>
                                    <tr>
                                        <th>05</th>
                                        <th>IT3511 - FSWD Lab</th>
                                        <th><?php echo $row["IT3511-GRADE"]; ?></th>
                                        <th><?php echo $row["IT3511-GPA"]; ?></th>
                                    </tr>
                                    
                            </table>
<h1 align="center">Grade : <?php echo $row["GPA"]; ?> <br>CGPA : <?php echo $row["CGPA"]; ?></h1>

                        <?php }
                } else { ?>
                    <tr>
                        <td align="center" colspan="3"><?php echo "THERE IS NO REGISTER NUMBER REGISTERED"; ?></td>
                    </tr><?php

                        } ?>

                <tr>
                    <td align="center" colspan="3"><a href="index.html">logout</a></td>
                </tr>
                </tbody>

        </table>
    </div>

</body>

</html>