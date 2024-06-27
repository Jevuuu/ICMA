<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['user_type']!='p'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    
    if ($_POST) {
        // Import database
        include("../connection.php");
    
        $rate_star = $_POST["rating"];
        $text = $_POST["text"];
        $timestamp = date("Y-m-d H:i:s");
        $clinic_id = $_POST["clinic_id"];
        $patient_id = $_POST["user_id"];
    
      
      
        $sql = "INSERT INTO rating (rate_star, rate_text, rate_time, clinic_id, patient_id) VALUES ('$rate_star', '$text', '$timestamp', '$clinic_id', '$patient_id')";
        $result = $database->query($sql);
        header("location: clinics.php?action=review-added&title=$title");
        echo "Clinic Name: $clinic_id<br>";
        echo "Patient Name: $patient_id<br>";
        
        
           
    
            // Insert review with foreign key values
           
    
           
    }


?>