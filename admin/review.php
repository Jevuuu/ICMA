<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Review</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
    <?php

    //learn from w3schools.com

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['user_type']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    

    //import database
    include("../connection.php");

    
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title">Administrator</p>
                                    <p class="profile-subtitle">admin@gmail.com</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                <a href="../index.html" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord  " >
                        <a href="index.php" class="non-style-link-menu "><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-clinic ">
                        <a href="clinics.php" class="non-style-link-menu "><div><p class="menu-text">Clinics</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-schedule">
                        <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">Schedule</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">Appointment</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient ">
                        <a href="patient.php" class="non-style-link-menu "><div><p class="menu-text">Patients</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient menu-active menu-icon-patient-active">
                        <a href="review.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Reviews</p></a></div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%">

                    <a href="index.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                        
                    </td>
                    <td>
                        
                        <form action="" method="post" class="header-search">

                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Clinic name or Email" list="clinic">&nbsp;&nbsp;
                            
                            <?php
                                echo '<datalist id="rating">';
                                $list11 = $database->query("select  rate_star from rating;");

                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();
                                    $d=$row00["rate_star"];
                               
                                    echo "<option value='$d'><br/>";
                                  
                                };

                            echo ' </datalist>';
?>
                            
                       
                            <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        
                        </form>
                        
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 
                        date_default_timezone_set('Asia/Kolkata');

                        $date = date('Y-m-d');
                        echo $date;
                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
               
                
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Reviews (<?php echo $list11->num_rows; ?>)</p>
                    </td>
                    
                </tr>
                <?php
                    if($_POST){
                        $keyword=$_POST["search"];
                        
                        $sqlmain= "select * from rating where patient_email='$keyword' or patient_name='$keyword' or patient_name like '$keyword%' or patient_name like '%$keyword' or patient_name like '%$keyword%' ";
                    }else{
                        $sqlmain= "select * from rating order by rate_id desc";

                    }



                ?>
                  
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown"  style="border-spacing:0;">
                        <thead>
                        <tr>
                                <th class="table-headin">
                                    
                                
                                Clinic Name
                                
                                </th>
                               
                                <th class="table-headin">
                                
                            
                                Clinic Location
                                
                                </th>
                                <th class="table-headin">
                                Clinic Number
                                </th>
                                <th class="table-headin">
                                    
                                Rating
                                    
                                </th>
                                
                                <th class="table-headin">
                                    
                                    Events
                                    
                                </tr>
                        </thead>
                        <tbody>
                        
                            <?php

                                
                                $result= $database->query($sqlmain);

                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="patient.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Clinics &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{
                                for ( $x=0; $x<$result->num_rows;$x++){
                                    $row=$result->fetch_assoc();
                                    $rid=$row["rate_id"];
                                    $rate=$row["rate_star"];
                                    
                                    
                                    $clinic=$row["clinic_id"];
                                    $cgps_res= $database->query("select clinic_gps from clinic where clinic_id='$clinic'");
                                    $cgps_array= $cgps_res->fetch_assoc();
                                    $cgps_name=$cgps_array["clinic_gps"];
                                  
                                    $clinic=$row["clinic_id"];
                                    $cnum_res= $database->query("select clinic_num from clinic where clinic_id='$clinic'");
                                    $cnum_array= $cnum_res->fetch_assoc();
                                    $cnum_name=$cnum_array["clinic_num"];

                                    $clinic=$row["clinic_id"];
                                    $c_res= $database->query("select clinic_name from clinic where clinic_id='$clinic'");
                                    $c_array= $c_res->fetch_assoc();
                                    $c_name=$c_array["clinic_name"];
                                    
                                    echo '<tr>
                                        <td> &nbsp;'.
                                        substr($c_name,0,35)
                                        .'</td>
                                       
                                        <td>
                                            '.substr($cgps_name,0,35).'
                                        </td>
                                       
                                        <td>
                                            '.substr($cnum_name,0,35).'
                                        </td>
                                        <td>
                                            '.substr($rate,0,11).'
                                        </td>
                                       <td>
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <a href="?action=view&id='.$rid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                       
                                        </div>
                                        </td>
                                    </tr>';
                                    
                                }
                            }
                                 
                            ?>
 
                            </tbody>

                        </table>
                        </div>
                        </center>
                   </td> 
                </tr>
                       
                        
                        
            </table>
        </div>
    </div>
    <?php 
    if($_GET){
        $id=$_GET["id"];
        $action=$_GET["action"];
        if($action=='view'){
        $sqlmain = "SELECT * FROM rating WHERE rate_id = $id";
        $result= $database->query($sqlmain);
        $row=$result->fetch_assoc();
        $rid=$row["rate_id"];
        $rate=$row["rate_star"];
                                    
                                    
        $clinic=$row["clinic_id"];
        $cgps_res= $database->query("select clinic_gps from clinic where clinic_id='$clinic'");
        $cgps_array= $cgps_res->fetch_assoc();
        $cgps_name=$cgps_array["clinic_gps"];
                                  
        $clinic=$row["clinic_id"];
        $cnum_res= $database->query("select clinic_num from clinic where clinic_id='$clinic'");
        $cnum_array= $cnum_res->fetch_assoc();
        $cnum_name=$cnum_array["clinic_num"];

        $clinic=$row["clinic_id"];
        $c_res= $database->query("select clinic_name from clinic where clinic_id='$clinic'");
        $c_array= $c_res->fetch_assoc();
        $c_name=$c_array["clinic_name"];
                                    
      
       
       


        $sqlmain12= "SELECT * FROM rating WHERE rate_id = $id";
        $result12= $database->query($sqlmain12);
        echo '
        <div id="popup1" class="overlay">
                <div class="popup" style="width: 70%;">
                <center>
                    <h2></h2>
                    <a class="close" href="review.php">&times;</a>
                    <div class="content">
                        
                        
                    </div>
                    <div class="abc scroll" style="display: flex;justify-content: center;">
                    <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                    
                        <tr>
                            <td>
                                <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
                            </td>
                        </tr>
                        
                        <tr>
                            
                            <td class="label-td" colspan="2">
                                <label for="name" class="form-label">Clinic Name: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                '.$c_name.'<br><br>
                            </td>
                            
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="Email" class="form-label">Rating Average: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                            '.$rate.'<br><br>
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="spec" class="form-label"><b>Reviews:</b> ('.$result12->num_rows.')</label>
                                <br><br>
                            </td>
                        </tr>

                        
                        <tr>
                        <td colspan="4">
                            <center>
                             <div class="abc scroll">
                             <table width="100%" class="sub-table scrolldown" border="0">
                             <thead>
                             <tr>   
                                    <th class="table-headin">
                                         Patient Name
                                     </th>
                                     <th class="table-headin">
                                         Rating
                                     </th>
                                     <th class="table-headin">
                                         
                                         Text
                                         
                                     </th>
                                    
                                     
                                     <th class="table-headin">
                                         Time
                                     </th>
                                     
                             </thead>
                             <tbody>';
                             
            
            
                                     
                                     $result= $database->query($sqlmain12);
            
                                     if($result->num_rows==0){
                                         echo '<tr>
                                         <td colspan="7">
                                         <br><br><br><br>
                                         <center>
                                         <img src="../img/notfound.svg" width="25%">
                                         
                                         <br>
                                         <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                         <a class="non-style-link" href="appointment.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Appointments &nbsp;</font></button>
                                         </a>
                                         </center>
                                         <br><br><br><br>
                                         </td>
                                         </tr>';
                                         
                                     }
                                     else{
                                     for ( $x=0; $x<$result->num_rows;$x++){
                                         $row=$result->fetch_assoc();
                                         $rid=$row["rate_id"];
                                         $rate=$row["rate_star"];
                                         $time=$row["rate_time"];
                                         $text=$row["rate_text"];

                                         $patient=$row["patient_id"];
                                         $p_res= $database->query("select patient_name from patient where patient_id='$patient'");
                                         $p_array= $p_res->fetch_assoc();
                                         $p_name=$p_array["patient_name"];
                                                                        
                                         echo '<tr style="text-align:center;">
                                            <td>
                                            '.substr($p_name,0,15).'
                                            </td>
                                             <td style="font-weight:600;padding:25px">'.
                                             
                                             substr($rate,0,25)
                                             .'</td >

                                             <td style="font-weight:600;padding:25px">'.
                                             
                                             substr($text,0,25)
                                             .'</td >
                                             
                                             <td style="font-weight:600;padding:25px">
                                             '.$time.'
                                             
                                             </td>
                                             
                                             
                                             
            
                                             
                                         </tr>';
                                         
                                     }
                                 }
                                      
                                 
            
                                echo '</tbody>
            
                             </table>
                             </div>
                             </center>
                        </td> 
                     </tr>

                    </table>
                    </div>
                </center>
                <br><br>
        </div>
        </div>
        ';  
            }
        }
?>
</div>

</body>
</html>