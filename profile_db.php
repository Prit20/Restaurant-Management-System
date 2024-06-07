<?php
include('include/dbcon.php');
session_start();
$user = $_SESSION['username'];
$curDate = date("Y-m-d h:i:s");

if(isset($_POST['save_chang'])) {
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Use prepared statements to prevent SQL injection
    $sql = "UPDATE user_info SET fullname = ?, email = ?, conum = ?, updatedAt = ?, updatedBy = ? WHERE username = ?";
    $params = array($fname, $email, $phone, $curDate, $user, $user);
    
    $stmt = sqlsrv_query($con, $sql, $params);

    if($stmt) {
        ?>
        <script> alert("updated successfully");
        window.open('profile.php','_self');
    </script>
         
         <?php
    } else {
        echo 'Error: ' . print_r(sqlsrv_errors(), true);
    }
}
?>
