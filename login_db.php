<?php
include("include/dbcon.php");
session_start();

// include("include/session.php");


if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql= "SELECT * FROM user_info WHERE username='$username' and password = '$password'";
    // $run = sqlsrv_query($con,$sql);
    $query=sqlsrv_query($con, $sql, array(), array("Scrollable"=> 'static'));
    $count= sqlsrv_num_rows($query);
    // $row = sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
    

    if($count > 0){
        $_SESSION['username'] = $username; 
        // $_SESSION['email'] = $email;

        // After successful login
$_SESSION['new_user_login'] = true; // Set flag indicating a new user has logged in

        header("location:home.php");
        exit;
    }else{
        echo "error1";
        print_r(sqlsrv_errors());
    }
}else{
    echo "error2";
        print_r(sqlsrv_errors());
}
?>