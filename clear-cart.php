<?php
include('include/dbcon.php');

$user = $_SESSION['username'];

$sql_clear_cart = "DELETE FROM cart WHERE insertedBy = ?";
$stmt_clear_cart = sqlsrv_prepare($con, $sql_clear_cart, array(&$user));

if(sqlsrv_execute($stmt_clear_cart)) {
    echo "done"; // Send 'done' as response if cart is cleared successfully
} else {
    echo "Error clearing cart: " . print_r(sqlsrv_errors(), true);
}
?>
