<?php
include('include/dbcon.php');

session_start();
$user=$_SESSION['username'];
$curDate= date("Y-m-d h:i:s");

$amount=$_POST['amount'];
$pay_id=$_POST['paymentid'];

$sql="INSERT INTO payment (username,payment_id,total,payAt,payBy) VALUES ('$user','$pay_id','$amount','$curDate','$user')";
$query=sqlsrv_query($con,$sql);
if($query){
    echo 'done';
}else{
    echo 'error';
}
?>
    
   