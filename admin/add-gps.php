<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['user_type']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    
    if($_POST){
        //import database
        include("../connection.php");
        $name=$_POST["geo_name"];
        $lat=$_POST["geo_lat"];
        $long=$_POST["geo_long"];
      
        $sql="insert into gps (geo_name,geo_lat,geo_long) values ('$name','$lat','$long');";
        $result= $database->query($sql);
        header("location: gps.php?action=session-added&title=$title");
        
    }


?>