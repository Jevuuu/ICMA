
    <?php
    
    

    //import database
    include("../connection.php");



    if($_POST){
        //print_r($_POST);
        $result= $database->query("select * from users");
        $name=$_POST['name'];
        $oldemail=$_POST["oldemail"];
        $spec=$_POST['spec'];
        $barangay=$_POST['barangay'];
        $email=$_POST['email'];
        $tele=$_POST['Tele'];
        $password=md5($_POST['password']);
        $cpassword=md5($_POST['cpassword']);
        $clinic_gps=$_POST['clinic_gps'];
        $id=$_POST['id00'];
        
        if ($password==$cpassword){
            $error='3';
            $result= $database->query("select clinic.clinic_id from clinic inner join users on clinic.clinic_email=users.user_email where users.user_email='$email';");
            //$resultqq= $database->query("select * from clinic where docid='$id';");
            if($result->num_rows==1){
                $id2=$result->fetch_assoc()["clinic_id"];
            }
            else if (strlen($_POST['password']) < 8) {
                $error='<label form="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password too short!</label>';
            }
            else if (!preg_match('/[A-Z]/',$_POST['password']) || !preg_match('/[a-z]/',$_POST['password']) || !preg_match('/[0-9]/',$_POST['password'])) {
                $error='<label form="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password must contain atleast 1 digit and capital letter.</label>';
            }else{
                $id2=$id;
            }
            
            echo $id2."jdfjdfdh";
            if($id2!=$id){
                $error='1';
                //$resultqq1= $database->query("select * from clinic where docemail='$email';");
                //$did= $resultqq1->fetch_assoc()["docid"];
                //if($resultqq1->num_rows==1){
                    
            }else{

                //$sql1="insert into clinic(docemail,docname,docpassword,docnic,doctel,specialties) values('$email','$name','$password','$nic','$tele',$spec);";
                $sql1="update clinic set clinic_email='$email',clinic_name='$name',clinic_password='$password',clinic_num='$tele',spec_id=$spec,clinic_gps='$clinic_gps', br_id=$barangay where clinic_id=$id ;";
                $database->query($sql1);
                
                $sql1="update users set user_email='$email' where user_email='$oldemail' ;";
                $database->query($sql1);
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
    

    header("location: clinics.php?action=edit&error=".$error."&id=".$id);
    ?>
    
   

</body>
</html>