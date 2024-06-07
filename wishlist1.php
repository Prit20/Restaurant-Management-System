<?php
session_start();
include('include/dbcon.php');

//add to wishlist and remove when clicked again from menu page 
if (isset($_POST['add_to_wishlist']) && isset($_POST['productId'])) {
    // $user_id = 'ayus7990';
    // $product_id = 'cc_cheese_burger_08';
    // $is_removed = 'TRUE';
    // $productPrice = '60'; 
    $productPrice = $_POST['productPrice'];
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['productId'];
    $is_removed = $_POST['isRemoved'];


    $sql_query = "SELECT product_id, COUNT(product_id) as product_count FROM wishlist_db WHERE product_id = '$product_id' AND customer_id = '$user_id' GROUP BY product_id";
    $check_query = sqlsrv_query($Con, $sql_query);
    // echo $sql_query;
    // die();
    if ($check_query) {
        $row = sqlsrv_fetch_array($check_query, SQLSRV_FETCH_ASSOC);
        $product_count = isset($row['product_count']) ? $row['product_count'] : 0;

        if ($product_count == 1) {
            if ($is_removed == 'FALSE') {
                // Remove the product from the wishlist
                $sql = "UPDATE wishlist_db SET isRemoved = 'TRUE' WHERE product_id = ? AND customer_id = ?";
                $run = sqlsrv_query($Con, $sql, array($product_id, $user_id));
                echo json_encode(array("success" => "data removed successfully"));
            } else {
                // Update the product in the wishlist
                $sql = "UPDATE wishlist_db SET isRemoved = 'FALSE' WHERE product_id = ? AND customer_id = ?";
                $run = sqlsrv_query($Con, $sql, array($product_id, $user_id));
                echo json_encode(array("success" => "data active successfully"));
            }
        } else {
            // Add the product to the wishlist
            $sql = "INSERT INTO wishlist_db (customer_id, product_id, product_price,isRemoved, createdBy) VALUES ('$user_id', '$product_id', '$productPrice','FALSE', '$user_id')";
            $run = sqlsrv_query($Con, $sql);
            // echo $sql;
            echo json_encode(array("success" => "data inserted successfully"));
        }
    }
} else {
    echo json_encode(array("error" => "Error checking wishlist: " . print_r(sqlsrv_errors(), true)));
}

//to update wishlist count in header from menu page 
if (isset($_POST['wishlist_count_update']) == '1') {
    session_start();
    // $user_id = 'ayus7990';
    $user_id = $_SESSION['user_id'];
    $sql_count = "SELECT COUNT(customer_id) AS total_wishlist_count
    FROM wishlist_db
    WHERE customer_id = '$user_id' AND isRemoved = 'FALSE'
    GROUP BY customer_id";
    echo $sql_count;
    // echo $sql_count;
    $query1 = SQLSRV_QUERY($Con, $sql_count);

    $rowCount = SQLSRV_FETCH_ARRAY($query1, SQLSRV_FETCH_ASSOC);
    $total_wishlist_count = $rowCount['total_wishlist_count'];

    // echo $total_wishlist_count;
    echo json_encode(['wishlist_count_update' => $total_wishlist_count]);
}

//to remove product from the wishlist from wishlist page 
if (isset($_POST['removeProductId'])) {
    session_start();
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['removeProductId'];

    $sql4 = "UPDATE wishlist_db SET isRemoved = 'TRUE' WHERE customer_id = '$user_id' AND product_id = '$product_id'";
    $run4 = SQLSRV_QUERY($Con, $sql4);

    if ($run4) {
        echo "Product removed from wishlist";
    } else {
        echo "Error removing product from wishlist";
        print_r(sqlsrv_errors());
    }
}