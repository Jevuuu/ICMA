<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>clinic</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
    <?php

    //learn from w3schools.com

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['user_type']!=''){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    

    //import database
    include("../connection.php");



    if($_POST){
        //print_r($_POST);
        $result= $database->query("select * from users");
        $name=$_POST['name'];
        $spec=$_POST['spec'];
        $email=$_POST['email'];
        $tele=$_POST['Tele'];
        $password=md5($_POST['password']);
        $cpassword=md5($_POST['cpassword']);
        $clinic_gps=$_POST['clinic_gps'];
        $barangay=$_POST['barangay'];
        
        if ($password==$cpassword){
            $error='3';
            $result= $database->query("select * from users where user_email='$email';");
            if($result->num_rows==1){
                $error='1';
            }
            else if (strlen($_POST['password']) < 8) {
                $error='<label form="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password too short!</label>';
            }
            else if (!preg_match('/[A-Z]/',$_POST['password']) || !preg_match('/[a-z]/',$_POST['password']) || !preg_match('/[0-9]/',$_POST['password'])) {
                $error='<label form="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password must contain atleast 1 digit and capital letter.</label>';
            }
            
            else{

                $sql1="insert into clinic(clinic_email,clinic_name,clinic_password,clinic_num,clinic_gps,spec_id,br_id) values('$email','$name','$password','$tele','$clinic_gps',$spec,$barangay);";
                $sql2="insert into users values('$email','c')";
                

                $database->query($sql1);
                $database->query($sql2);
         
                //echo $sql1;
                //echo $sql2;
                $error= '4';
                
            }
            
        }else{
            $error='2';
        }
    
    
        
        
    }else{
        //header('location: signup.php');
        $error='3';
    }
    

    header("location: clinics.php?action=add&error=".$error);
    ?>
    
   

</body>
</html>