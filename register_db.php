<?php
include('include/dbcon.php');
session_start();

date_default_timezone_set("asia/kolkata");
$cur_date = date('Y-m-d h:i:s');
if(isset($_POST['rgtr'])){
    $user_name = $_POST['username'];
    $f_name = $_POST['fname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $sql = "INSERT INTO user_info (username,fullname,email,conum,password,role,createdAt) VALUES ('$user_name','$f_name','$email','$phone','$password','customer','$cur_date')";
    
    $run= sqlsrv_query($con,$sql);
    if(!$run){
        echo"error";
        print_r(sqlsrv_errors());
    }
    else{
        $_SESSION['email'] = $email;
        header("location:loginpage.php");
    }
}
?>
