<?php
include('include/dbcon.php');

date_default_timezone_set("Asia/Kolkata"); // Corrected timezone identifier

if(isset($_POST['reviewsubmit'])){
session_start();

    // Get username and email from session
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    $status = $_POST['status'];
    $message = $_POST['message'];
    $cur_date = date('Y-m-d H:i:s'); // Corrected date format

    // Prepare the SQL query with parameterized values to prevent SQL injection
    $sql = "INSERT INTO review (username, email, status, message, writeAt) VALUES (?, ?, ?, ?, ?)";

    // Prepare parameters for the query
    $params = array($username, $email, $status, $message, $cur_date);

    // Execute the SQL query
    $run = sqlsrv_query($con, $sql, $params);

    if($run === false){
        // Handle query execution error
        echo "Error inserting data into database.<br>";
        print_r(sqlsrv_errors());
    }
    else{
        // Data inserted successfully, redirect to a page
        header('location:review.php');
        exit; // Make sure to exit after redirection
    }
}
?>
