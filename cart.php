<?php
include('include/header.php');
include('include/dbcon.php');

$user = $_SESSION['username'];
$grandtotal = 0; // Initialize grand total
$sql22 = "SELECT email FROM user_info WHERE username = '$user'";
$run22 = sqlsrv_query($con, $sql22);

if ($run22 === false) {
    die(print_r(sqlsrv_errors(), true)); // Print error message if query execution fails
}

if (sqlsrv_has_rows($run22)) {
    $row22 = sqlsrv_fetch_array($run22, SQLSRV_FETCH_ASSOC);
    if ($row22 === false) {
        die(print_r(sqlsrv_errors(), true)); // Print error message if fetching data fails
    }
} else {
    echo "No rows found for the given username.";
}

// Update quantity query
if(isset($_POST['updateqntybtn'])){
    $updateqnty = $_POST['updateqnty'];
    $updateqntyid = $_POST['updateqntyid'];

    $sql1 = "UPDATE cart SET item_qnty = ? WHERE id = ?";
    $params = array($updateqnty, $updateqntyid);
    $stmt1 = sqlsrv_query($con, $sql1, $params);

    if($stmt1){
        // Quantity updated successfully
    } else {
        // Error updating quantity
        echo "Error updating quantity: " . print_r(sqlsrv_errors(), true);
    }
}

// Delete item query
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $sql3 = "DELETE FROM cart WHERE id = ?";
    $stmt3 = sqlsrv_query($con, $sql3, array($id));

    if($stmt3){
        echo "success";
    } else {
        echo "Error executing query: " . print_r(sqlsrv_errors(), true);
    }
}

// Delete all items query
if(isset($_POST['delete_all'])){
    $sql_delete_all = "DELETE FROM cart WHERE username = ?";
    $stmt_delete_all = sqlsrv_prepare($con, $sql_delete_all, array(&$user));

    if(sqlsrv_execute($stmt_delete_all)){
        $message[] = 'Deleted all items from cart!';
    } else {
        echo "Error executing query: " . print_r(sqlsrv_errors(), true);
    }
}

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
</head>

<body>
    <table class="table table-striped" style="margin:10px 10px 10px 10px;">
        <thead>
            <tr>
                <th>Sr No</th>
                <th>FoodName</th>
                <th>Category</th>
                <th>Item Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql_select_cart = "SELECT * FROM cart WHERE insertedBy = ?";
            $stmt_select_cart = sqlsrv_prepare($con, $sql_select_cart, array(&$user));
            
            if(sqlsrv_execute($stmt_select_cart)) {
                $incr = 1;
                while($row1 = sqlsrv_fetch_array($stmt_select_cart, SQLSRV_FETCH_ASSOC)) {
                    ?>
            <tr>
                <td><?php echo $incr ?></td>
                <td><?php echo $row1['item_name']?></td>
                <td><?php echo $row1['item_category']?></td>
                <td>&#8377;<?php echo $row1['item_price']?></td>
                <td>
                    <form action="" method="POST">
                        <input type="hidden" value="<?php echo $row1['id']?>" name="updateqntyid">
                        <div class="qnty_box">
                            <input type="number" min="1" value="<?php echo $row1['item_qnty'] ?>" name="updateqnty">
                            <input type="submit" class="update_qnty" value="Update" name="updateqntybtn">
                        </div>
                    </form>
                </td>
                <td>&#8377;<?php echo $item_sum = number_format($row1['item_price'] * $row1['item_qnty']) ?></td>

                <td>
                    <button type="button" class="sbtn btn-danger removebtn"
                        id="<?php echo $row1['id']?>">Remove</button>
                </td>
            </tr>
            <?php
                    $incr++;
                    $grandtotal += ($row1['item_price'] * $row1['item_qnty']);
                }
            } else {
                echo "Error executing query: " . print_r(sqlsrv_errors(), true);
            }
            ?>
        </tbody>
    </table>
    <div class="bottom flex justify-content-around" style="margin-top: 30px;">
        <a class="sbtn" href="menu.php">Continue Order</a>
        <h2 class="bottom_btn">Grand Total: <span>&#8377;<?php echo number_format($grandtotal) ?></span></h2>
        <a class="sbtn" id="buynow" href="javascript:void(0)" style="width:220px;" data-productid="111"
            data-productname="pritpatel" data-amount="1000" class="btn btn-primary buynow">Proceed to CheckOut</a>
    </div>
</body>

</html>
<script>
    
$(document).ready(function() {
    $(document).on('click', '.removebtn', function() {
        var id = $(this).attr('id').trim();
        $.ajax({
            url: window.location.href,
            type: 'POST',
            data: {
                id: id
            },
            success: function(data) {
                console.log("Deleted successfully");
                alert("Item has been removed!");
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("An error occurred while removing the item.");
            }
        });
    });
});

$("#buynow").click(function() {
    var username = "<?php echo $user?>";
    var amount = "<?php echo $grandtotal?>";

    var options = {
        "key": "rzp_test_5sJaXfhQfaQBC1",
        "amount": amount * 100,
        "name": "FoodLover",
        "image": "favicon1.png",
        "handler": function(response) {
            var paymentid = response.razorpay_payment_id;
            $.ajax({
                url: "payment-process.php",
                type: "POST",
                data: {
                    username: username,
                    amount: amount,
                    paymentid: paymentid
                },
                success: function(finalresponse) {
                    if (finalresponse == 'done') {
                        //     // Clear cart upon successful payment
                        $.ajax({
                            url: "sent_email.php",
                            type: "POST",
                            data: {
                                email: "<?php echo $row22['email']; ?>"
                            },
                            success: function(emailResponse) {
                                console.log("Email sent");
                            },
                            error: function(xhr, status, error) {
                                console.error("Error sending email: " + xhr
                                    .responseText);
                            }
                        });

                    } else {
                        window.location.href = "home.php";

                    }
                    console.log("success");
                }
            });
        },
        "theme": {
            "color": "#fe5722"
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.open();
});
</script>