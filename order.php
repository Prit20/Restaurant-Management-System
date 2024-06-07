<?php
include('include/header.php');
include('include/dbcon.php');

$user = $_SESSION['username'];
$grandtotal = 0; // Initialize grand total




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
                <!-- <th>Action</th> -->
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
                        <td>$<?php echo $row1['item_price']?></td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" value="<?php echo $row1['id']?>" name="updateqntyid">
                                <div class="qnty_box">
                                    <input type="number" min="1" value="<?php echo $row1['item_qnty'] ?>"  name="updateqnty">
                                    <input type="submit" class="update_qnty" value="Update"  name="updateqntybtn">
                                </div>
                            </form>
                        </td>
                        <td>$<?php echo $item_sum = number_format($row1['item_price'] * $row1['item_qnty']) ?></td>
                       
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
        <h2 class="bottom_btn">Grand Total: <span>$<?php echo number_format($grandtotal) ?></span></h2>
        <button class="btn btn-success btn-md" >Success</button>

        <!-- <a class="sbtn" id="buynow" href="javascript:void(0)" style="width:220px;" data-productid="111" data-productname="pritpatel" data-amount="1000" class="btn btn-primary buynow">Proceed to CheckOut</a> -->
    </div>
</body>
</html>
<script>
$(document).ready(function(){
    $(document).on('click','.removebtn',function(){
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

$("#buynow").click(function(){
    var username = "<?php echo $user?>";
    var amount = "<?php echo $grandtotal?>";

    var options = {
        "key": "rzp_test_5sJaXfhQfaQBC1",
        "amount": amount * 100,
        "name": "FoodLover",
        "image": "favicon1.png",
        "handler": function (response){
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
                    if(finalresponse == 'done') {
                        // Clear cart upon successful payment
                        $.ajax({
                            url: "clear-cart.php",
                            type: "POST",
                            data:{id:id},
                            success: function(response) {
                                if(response == 'done') {
                                    window.location.href = "home.php";
                                } else {
                                    console.error("Error clearing cart: " + response);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("Error clearing cart: " + xhr.responseText);
                            }
                        });
                    } else {
                        window.location.href = "home.php";
                        
                    }
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
