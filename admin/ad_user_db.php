<?php
session_start();
$user=$_SESSION['username'];
$curDate= date("Y-m-d h:i:s");
include('/xampp/htdocs/Project/Restaurant/admin/include/dbCon.php');

    
    if(isset($_POST['id'])){
        $id =$_POST['id'];
        $username=$_POST['username'];
        $fullname=$_POST['fullname'];
        $email=$_POST['email'];
        $conum=$_POST['conum'];
    
        $sql1="UPDATE user_info SET username ='$username',fullname = '$fullname', email = '$email', conum = '$conum', createdAt ='$curDate', createdBy ='$user', updatedAt = '$curDate', updatedBy='$user' WHERE id ='$id'";
        $run1= sqlsrv_query($Con,$sql1);
        if($run1){
            echo('update Successfully');
    
        }else{
            print_r(sqlsrv_errors());
        }
    }

    if(isset($_POST['id'])){
        $id=$_POST['id'];
        // $sql3="DELETE FROM user_info WHERE id='$id' ";
        // $query3=sqlsrv_query($Con,$sql3);
        $sql3 = "DELETE FROM user_info WHERE id = '$id'";
$params = array($id);
$query3 = sqlsrv_query($Con, $sql3, $params);

if($query3){
    echo "success";
} else {
    echo "Error executing query: " . print_r(sqlsrv_errors(), true);
}
    }