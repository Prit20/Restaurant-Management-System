<?php
include('include/dbcon.php');
if(isset($_POST['table_show'])){

    $totalperson = $_POST['number'];
    $date = $_POST['date'];
    $time = $_POST['time'];
        if(isset($_POST['confirmdb'])){
        $tablename = $_POST['tablename1'];

        $name = $_POST['name1'];
        $mobile = $_POST['mobile1'];
        $email = $_POST['email1'];
        $message = $_POST['message1'];


        $sql ="INSERT INTO table_db ( tablename, totalperson, date, time, name, mobile, email, message, status) 
        VALUES (?,?,?,?,?,?,?,?,?)";

        $params = array($tablename, $totalperson, $date, $time, $name, $mobile, $email, $message, 'booked');

        $run = sqlsrv_query($con, $sql, $params);

        if(!$run){
        die( print_r(sqlsrv_errors(), true));
        }
        else{
        echo '<script>alert("Your Table is successfully Booked! Table Id is '.$tablename.'")</script>';
        // header("location:congrats.php?id=$mobile");
        }
        }else{
        die( print_r(sqlsrv_errors(), true));

        }

}else{
    die( print_r(sqlsrv_errors(), true));

    }

?>