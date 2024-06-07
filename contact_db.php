<?php
include('include/dbcon.php');
session_start();
date_default_timezone_set("asia/kolkata");
$cur_date = date('Y-m-d h:i:s');
$user=$_SESSION['username'];


if(isset($_POST['contactbtn'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contactus (name,email,message,writeBy,writeAt) VALUES ('$name','$email','$message','$user','$cur_date')";
    
    $run= sqlsrv_query($con,$sql);
    if(!$run){
        echo"error";
        print_r(sqlsrv_errors());
    }
    else{
        header('location:contact.php');
        ?>
        <script>
            alert("data Successfully Submited");
            </script>
        <?php 
    }
}
?>
