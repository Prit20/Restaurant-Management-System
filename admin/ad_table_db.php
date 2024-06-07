<?php
session_start();
$user=$_SESSION['username'];
$curDate= date("Y-m-d h:i:s");
include('/xampp/htdocs/Project/Restaurant/admin/include/dbCon.php');

    if(isset($_POST['id'])){
        $id =$_POST['id'];
        
    $tablename=$_POST['tablename'];
    $totalperson=$_POST['totalperson'];
    $date=$_POST['date'];
    $time=$_POST['time'];
    $name=$_POST['name'];
    $mobile=$_POST['mobile'];
    $email=$_POST['email'];
    $message=$_POST['message'];
    
        $sql1="UPDATE table_db SET tablename ='$tablename',totalperson = '$totalperson', date = '$date', time = '$time', name = '$name', mobile = '$mobile', email = '$email', message = '$message' WHERE id ='$id'";
        $run1= sqlsrv_query($Con,$sql1);
        if($run1){
            // move_uploaded_file($_FILES["Image"]["tmp_name"], "upload1/" . $image);
            echo('update Successfully');
    
        }else{
            print_r(sqlsrv_errors());
        }
    }