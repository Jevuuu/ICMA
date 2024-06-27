<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['user_type']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    
    if($_GET){
        //import database
        include("../connection.php");
        $id=$_GET["id"];
        $result001= $database->query("select * from clinic where clinic_id=$id;");
        $email=($result001->fetch_assoc())["clinic_email"];
        $sql= $database->query("delete from users where user_email='$email';");
        $sql= $database->query("delete from clinic where clinic_email='$email';");
        //print_r($email);
        header("location: clinics.php");
    }


?>