<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['user_type']!='p'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    

    //import database
    include("../connection.php");
    $userrow = $database->query("select * from patient where patient_email='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["patient_id"];
    $username=$userfetch["patient_name"];

    
    if($_GET){
        //import database
        include("../connection.php");
        $id=$_GET["id"];
        $result001= $database->query("select * from patient where patient_id=$id;");
        $email=($result001->fetch_assoc())["patient_email"];
        $sql= $database->query("delete from users where user_email='$email';");
        $sql= $database->query("delete from patient where patient_email='$email';");
        //print_r($email);
        header("location: ../logout.php");
    }


?>