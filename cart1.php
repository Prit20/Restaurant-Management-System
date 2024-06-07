<!-- cart code i ctr+x 
 -->
 <?php

// include('include/header.php');
include('include/dbcon.php');
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'add') {
        $item = [
            'id' => $_POST['id'],
            'name' => $_POST['name'],
            'price' => $_POST['price']
        ];

        array_push($_SESSION['cart'], $item);

        echo 'Item added to cart successfully.';
    }
}
?>

<!-- here end  -->
<?php
include('include/dbcon.php');
//to add product to cart or update quantity in cart header if it already have product in cart
if (isset($_POST['productId'])) {
    session_start();

    $product_id = $_POST['productId'];
    $user_id = $_SESSION['user_id'];
    $product_price = $_POST['product_price'];

    $sql1 = "SELECT product_id, product_qty FROM cart_details_db WHERE product_id = '$product_id' AND customer_id = '$user_id' AND isOrdered='FALSE' AND isActive='TRUE' GROUP BY product_id, product_qty";
    $run = SQLSRV_QUERY($con, $sql1);
    $row = SQLSRV_FETCH_ARRAY($run, SQLSRV_FETCH_ASSOC);

    $qty_count = ($row) ? $row['product_qty'] : 0;

    if ($qty_count >= 1) {
        $qty_count = $qty_count + 1;
        $single_item_final_price = $qty_count * $product_price;
        $sql2 = "UPDATE cart_details_db SET product_qty = '$qty_count', product_final_price='$single_item_final_price' WHERE product_id = '$product_id' AND customer_id = '$user_id' AND isOrdered='FALSE' AND isActive='TRUE'";
        $run2 = SQLSRV_QUERY($con, $sql2);

        if ($run2) {
            echo "Product added to cart";
            header('Location: ../views/Cart.php');
        } else {
            echo "Error updating product quantity";
            print_r(sqlsrv_errors());
        }
    } else {
        $qty_count = 1;
        $single_item_final_price = $product_price;
        $sql = "INSERT INTO cart_details_db (product_id, customer_id, isOrdered, isActive, product_qty, product_final_price) VALUES ('$product_id','$user_id','FALSE','TRUE','$qty_count','$single_item_final_price')";
        $query = SQLSRV_QUERY($Con, $sql);

        if ($query) {
            // Handle addons
            if (isset($_POST['product_addons']) && is_array($_POST['product_addons'])) {
                $addons = $_POST['product_addons'];
                $addonPrices = $_POST['addonPrice'];
                foreach ($addons as $key => $addonId) {
                    $addonPrice = $addonPrices[$key];

                    $sql = "INSERT INTO product_addon_cart_details (product_id, product_addon_id, customer_id, addon_product_price, isActive, isOrdered) VALUES ('$productId','$addonId','$user_id','$addonPrice','TRUE','FALSE')";
                    $query = SQLSRV_QUERY($Con, $sql);

                    if (!$query) {
                        echo "Error processing addon: " . print_r(sqlsrv_errors(), true);
                    }
                }
            }

            echo "Product added to cart";
        } else {
            echo "Error updating product quantity";
            print_r(sqlsrv_errors());
        }
    }
}

if (isset($_POST['product_id']) && isset($_POST['product_qty'])  && isset($_POST['product_price'])) {
    session_start();
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $product_qty = $_POST['product_qty'];
    $product_price = $_POST['product_price'];

    $final_cart_price = $product_qty * $product_price; // Assuming $product_price is available

    $sql = "UPDATE cart_details_db SET product_qty = ?, product_final_price = ? WHERE product_id = ? AND customer_id = ? AND isActive = 'TRUE' AND isOrdered = 'FALSE'";
    $params = array($product_qty, $final_cart_price, $product_id, $user_id);

    $run = sqlsrv_query($Con, $sql, $params);

    if ($run) {
        echo "Successfully updated quantity.";
    } else {
        echo "Error updating quantity.";
    }
}

//when order is placed all the details is stored in two tables one is in horizotal form(master table) and another vertical form for genrating report
if (isset($_POST['order_placed'])) {
    session_start();
    $user_id = $_SESSION['user_id'];

    //to get all the product item which is added to cart or going to purchased are converted to string
    $sql = "SELECT  c.product_final_price,p.product_price,product_qty,p.product_id,  p.product_price,p.product_title
    FROM cart_details_db c
    INNER JOIN product_details_db p ON c.product_id = p.product_id
    WHERE c.customer_id = '$user_id' AND c.isOrdered = 'FALSE' AND c.isActive = 'TRUE';";
    $query = sqlsrv_query($con, $sql);
    if ($query) {
        $product_id_array = array();
        $product_id_array = array();
        $product_single_product_price_array = array();
        $product_total_product_price_array = array();
        $product_product_title_array = array();
        while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
            $product_id_array[] = $row['product_id'];
            $product_qty_array[] = $row['product_qty'];
            $product_single_product_price_array[] = $row['product_price'];
            $product_total_product_price_array[] = $row['product_final_price'];
            $product_title_array[] = $row['product_title'];
        }
        $product_ids_string = implode(',', $product_id_array);
        $product_qty_string = implode(',', $product_qty_array);
        $product_title_string = implode(',', $product_title_array);
    } else {
        echo "Error executing the SQL query.";
    }
    // print_r($product_total_product_price_array);
    // die();
    //to get sum of whole cart 
    $sql1 = "SELECT SUM(product_final_price) as total_cart_price
    FROM cart_details_db
    WHERE customer_id ='$user_id' AND isActive = 'TRUE' AND isOrdered = 'FALSE'";
    $query1 = sqlsrv_query($con, $sql1);
    $row_price = sqlsrv_fetch_array($query1, SQLSRV_FETCH_ASSOC);
    $total_cart_price = $row_price['total_cart_price'];

    //to get payment method
    $payment_method = $_POST['payment_method'];
    $order_status = 'PAID';

    //to get unique order id
    $order_id = $user_id . '_' . date('YmdHis');

    $product_title = $run5['product_title'];

    //to insert details into orderd details table
    $sql2 = "INSERT INTO order_details_db(order_id,ordered_item,ordered_item_qty,total_cart_price,isOrdered,isActive,payement_method,customer_id,product_title,order_status) VALUES('$order_id','$product_ids_string','$product_qty_string','$total_cart_price','TRUE','TRUE','$payment_method','$user_id','$product_title_string','$order_status')";
    $query2 = sqlsrv_query($con, $sql2);


    //to insert data into order details data  table 
    if ($query2) {
        $sql_order_no = "SELECT MAX(order_no) as max_order_no FROM order_details_db where customer_id ='$user_id' AND isActive='TRUE' AND isOrdered='TRUE'";
        $query3 = SQLSRV_QUERY($Con, $sql_order_no);
        $run2 = SQLSRV_FETCH_ARRAY($query3, SQLSRV_FETCH_ASSOC);
        $sql_order_no_count = $run2['max_order_no'];
        // echo $sql_order_no_count;


        foreach ($product_id_array as $key => $value) {
            // $sql = "SELECT product_title FROM product_details_db Where product_id='$value' AND isActive='TRUE'";
            // $query2 = SQLSRV_QUERY($Con, $sql);
            // $run5 = SQLSRV_FETCH_ARRAY($query2, SQLSRV_FETCH_ASSOC);
            // $product_title = $run5['product_title'];

            $sql2 = "INSERT INTO order_details_data (order_id,customer_id,product_id,product_qty,product_single_price,product_total_price,payment_method,product_title,order_status,order_no) VALUES('$order_id','$user_id','" . $product_id_array[$key] . "','" . $product_qty_array[$key] . "','" . $product_single_product_price_array[$key] . "','" . $product_total_product_price_array[$key] . "','$payment_method','" .  $product_title_array[$key] . "','  $order_status','$sql_order_no_count')";
            // echo $sql2;
            // die();

            $run2 = sqlsrv_query($con, $sql2);

            // to update ordered status in cart 
            $sql3 = "UPDATE cart_details_db SET isOrdered = 'TRUE' WHERE customer_id = '$user_id' AND isActive = 'TRUE'";
            $query3 = SQLSRV_QUERY($con, $sql3);

            // $_SESSION['payment_status'] = 'TRUE';    
            // Pass the order ID as a query parameter to Success.php
            header("Location: ../views/Success.php?order_id=$order_id&amount_paid=$total_cart_price");
        }
    }
}


//to update cart count dynamically without reloading the page
if (isset($_POST['cart_count_update']) == '1') {
    session_start();
    $user_id = $_SESSION['user_id'];
    $sql_count = "SELECT COUNT(customer_id) AS total_cart_count
    FROM cart_details_db
    WHERE customer_id = '$user_id' AND isOrdered = 'FALSE' AND isActive = 'TRUE'
    GROUP BY customer_id";
    $query1 = SQLSRV_QUERY($con, $sql_count);
    $rowCount = SQLSRV_FETCH_ARRAY($query1, SQLSRV_FETCH_ASSOC);
    echo json_encode($rowCount);
}