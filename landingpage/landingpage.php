<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Dashboard</title>
    <style>
        .dashbord-tables{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table,.anime{
            animation: transitionIn-Y-bottom 0.5s;
        }




    </style>
    
    
</head>
<body>
    <?php

    //learn from w3schools.com


    //import database
    include("../connection.php");
  


    //echo $userid;
    //echo $username;
    
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                         
                            <tr>
                                <td colspan="2">
                                    <a href="../login.php" ><input type="button" value="Log In" class="logout-btn btn-primary-soft btn"></a>
                                    <a href="../signup.php" ><input type="button" value="Sign Up" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-home menu-active menu-icon-home-active" >
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Home</p></a></div></a>
                    </td>
                </tr>
              
                    
             

            </table>
        </div>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
                        
                        <tr >
                            
                            <td colspan="1" class="nav-bar" >
                            <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;">Home</p>
                          
                            </td>
                            <td width="25%">

                            </td>
                            <td width="15%">
                                <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                                    Today's Date
                                </p>
                                <p class="heading-sub12" style="padding: 0;margin: 0;">
                                <?php 
                                date_default_timezone_set('Asia/Kolkata');
        
                                $today = date('Y-m-d');
                                echo $today;
                                ?>
                                </p>
                            </td>
                            <td width="10%">
                               
                            </td>
        
        
                        </tr>
                <tr>
                    <td colspan="4" >
                        
                    <center>
                    <table class="filter-container clinic-header patient-header" style="border: none;width:95%" border="0" >
                    <tr>
                        <td >
                            <h3>Welcome!</h3>
                           
                            <p>Check the available Clinics below!
                              
                                
                                Track your past and future appointments history.<br>Also find out the expected arrival time of your clinic or medical consultant.
                                <a href="../signup.php" class="non-style-link"><b>"Sign up now!"</b> </a><br><br><br>
                            </p>
                            
                           
                           
                            <br>
                            <br>
                            
                        </td>
                    </tr>
                    </table>
                    </center>
                    
                </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table border="0" width="100%"">
                        <tr>
                  
                                <th class="table-headin">
                                    
                                
                                Barangay Name
                                
                                </th>
                               
                                <th class="table-headin">
                                
                            
                                Number of Clinic
                                
                                </th>
                                
                               
                        </thead>
                        <tbody>
                        <?php
$sqlmain = "SELECT * FROM barangay";
$result = $database->query($sqlmain);

if ($result->num_rows == 0) {
    echo '<tr>
        <td colspan="4">
            <br><br><br><br>
            <center>
                <img src="../img/notfound.svg" width="25%">
                <br>
                <p class="heading-main12" style="margin-left: 45px; font-size: 20px; color: rgb(49, 49, 49)">We couldn\'t find anything related to your keywords!</p>
                <a class="non-style-link" href="patient.php">
                    <button class="login-btn btn-primary-soft btn" style="display: flex; justify-content: center; align-items: center; margin-left: 20px;">&nbsp; Show all Patients &nbsp;</font></button>
                </a>
            </center>
            <br><br><br><br>
        </td>
    </tr>';
} else {
    // Fetch all barangay records
    $barangayRecords = $result->fetch_all(MYSQLI_ASSOC);

    // Count occurrences of br_id from the clinic table
    $clinicCountQuery = "SELECT br_id, COUNT(br_id) AS br_count FROM clinic GROUP BY br_id";
    $clinicResult = $database->query($clinicCountQuery);

    // Create an associative array to store clinic counts by br_id
    $clinicCounts = [];
    if ($clinicResult) {
        while ($row = $clinicResult->fetch_assoc()) {
            $clinicCounts[$row['br_id']] = $row['br_count'];
        }
    }

    // Display barangay records
    foreach ($barangayRecords as $row) {
        $br_name = $row["br_name"];
        $br_id = $row["br_id"];
        $clinicCount = isset($clinicCounts[$br_id]) ? $clinicCounts[$br_id] : 0;
        
        echo '<tr>
            <td> &nbsp;' . substr($br_name, 0, 35) . '</td>
            <td> &nbsp;' . substr($clinicCount, 0, 35) . '</td>
           
        </tr>';
    }
}
?>

                            
                            </tbody>

                       
                                                
                                            </tr>
                                        </table>
                                    </center>








                            
                                  




                                </td>
                            </tr>
                        </table>
                    </td>
                <tr>
            </table>
        </div>
    </div>


    

<?php 
    if($_GET){
        $id = $_GET["id"];
        $sqlmain = "SELECT * FROM clinic WHERE clinic_id='$id'";
        $result = $database->query($sqlmain);
        $row = $result->fetch_assoc();
        
        $br = $row["br_id"];
        $br_res = $database->query("SELECT * FROM clinic WHERE br_id='$br'");
        
        echo '
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <h2></h2>
                    <a class="close" href="landingpage.php">&times;</a>
                    <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Clinic Name(s)<br> </label>
                                </td>
                            </tr>';
        
        // Loop through all barangay records with the matching br_id
        if ($br_row = $br_res->fetch_assoc()) {
            $br_name = $br_row["clinic_name"];
            $name=$row["clinic_name"];
            echo '<tr>
                    <td class="label-td" colspan="2">
                        '.$br_name.'<br><br>
                    </td>
                </tr>';
        }else{
            echo '<tr>
                    <td class="label-td" colspan="2">
                        No clinics yet<br><br>
                    </td>
                </tr>';
        }
        
        echo '              
                            <tr>
                                <td colspan="2">
                                    <a href="landingpage.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </center>
                <br><br>
            </div>
        </div>';
    };
?>
</div>

</body>
</html>