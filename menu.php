<?php
include('include/header.php');
include('include/dbcon.php');

$user=$_SESSION['username'];
$curDate= date("Y-m-d h:i:s");
 
if(isset($_POST['add_to_cart'])){
    $item_img = $_POST['item_img'];
    $item_name = $_POST['item_name'];
    $item_category = $_POST['item_category'];
    $item_price = $_POST['item_price'];
    $item_qnty = 1;

// Prepare and bind the SQL statement to check if the item is already in the cart
$sql2 = "SELECT * FROM cart WHERE item_name = '$item_name'";
$params = array(&$item_name);
$stmt2 = sqlsrv_query($con, $sql2, $params,array("scrollable"=>'static'));

// Check if the query execution was successful
if ($stmt2 !== false) {
    // Get the number of rows returned by the query
    $row_count = sqlsrv_num_rows($stmt2);

    // Check if the item is already in the cart
    if ($row_count > 0) {
        // Item is already in the cart
        // echo "Item already in the cart";
        $display_message="Iteam alredy into the cart";
    } else {
        // Item is not in the cart, so insert it
        // Prepare and bind the SQL statement to insert the item into the cart
        $sql1 = "INSERT INTO cart (item_img, item_name, item_category, item_price, item_qnty, insertedAt, insertedBy) VALUES (' $item_img', '$item_name',' $item_category',' $item_price','$item_qnty','$curDate','$user')";
        $params1 = array(&$item_img, &$item_name, &$item_category, &$item_price, &$item_qnty, &$curDate, &$user);
        $stmt1 = sqlsrv_prepare($con, $sql1, $params1);

        // Execute the statement to insert the item into the cart
        if (sqlsrv_execute($stmt1)) {
            // Item added to cart successfully
            // echo "Item added to cart successfully";
            $display_message="Item added to cart successfully";
        } else {
            // Error adding item to cart
            echo "Error adding item to cart";
        }
        
        // Close the statement for inserting the item into the cart
        sqlsrv_free_stmt($stmt1);
    }
} else {
    // Error executing the query
    // Handle the error
    echo "Error executing the query";
}

// Close the statement for checking if the item is already in the cart
sqlsrv_free_stmt($stmt2);

}
$sql = "SELECT * FROM menu";
$run = sqlsrv_query($con, $sql);
?>

<!-- Restaurant Menu -->
<div class="section" id="menu">
    <div class="container">
        <ul class="category">
            <!-- Your category list goes here -->
            <li><a href="?category=all"
                    class="<?= isset($_GET['category']) && $_GET['category'] === 'all' ? 'active' : '' ?>">All</a>
            </li>
            <li><a href="?category=panjabi"
                    class="<?= isset($_GET['category']) && $_GET['category'] === 'panjabi' ? 'active' : '' ?>">Panjabi</a>
            </li>
            <li><a href="?category=biryani"
                    class="<?= isset($_GET['category']) && $_GET['category'] === 'biryani' ? 'active' : '' ?>">Biryani</a>
            </li>
            <li><a href="?category=chinese"
                    class="<?= isset($_GET['category']) && $_GET['category'] === 'chinese' ? 'active' : '' ?>">Chinese</a>
            </li>
            <li><a href="?category=pizza"
                    class="<?= isset($_GET['category']) && $_GET['category'] === 'pizza' ? 'active' : '' ?>">Pizza</a>
            </li>
            <li><a href="?category=burger"
                    class="<?= isset($_GET['category']) && $_GET['category'] === 'burger' ? 'active' : '' ?>">Burger</a>
            </li>
            <li>
                <div class="search">
                    <input type="search" placeholder="Search">
                    <button type="button" class="sbtn">Search</button>
                </div>
            </li>
            <!-- <li> <i class="bi bi-bag-heart fa-2x" style="color:#fe5722; "></i></li> -->
            <!-- select query for the deaply count number at cart icon  -->
            <?php
            
$select_item_count = "SELECT * FROM cart  WHERE insertedBy = '$user'";
$params1 = array(&$item_name);
$run_count = sqlsrv_query($con,$select_item_count, $params1,array("scrollable"=>'static'));
$row_count1 = sqlsrv_num_rows($run_count);

            ?>
            <li><a href="cart.php"><i class="bi bi-cart fa-2x" style="color:#fe5722;"></i> <span><sup><?php echo"$row_count1";?></sup></span></a> </li>
        </ul>
        <?php
    if(isset($display_message)){
        echo "<div class='display_message flex justify-content-around' style='font-size:22px;' >
                <span>$display_message</span>
                <i class='bi bi-x' onclick=\"this.parentElement.style.display='none';\"> </i>
              </div>";
    }
?>

        <div class="container">
            <div class="menu-items" style="display: grid; grid-template-columns: repeat(4, 1fr); margin-left: -35px;">
                <?php
                // Display menu items based on category
                if ($run !== false) {
                    while ($row = sqlsrv_fetch_array($run, SQLSRV_FETCH_ASSOC)) {
                        if (!isset($_GET['category']) || $_GET['category'] === 'all' || strtolower($row['category']) === $_GET['category']) {
                            echo "<form method='post' action=''>";
                            echo "<div class='restaurant-menu'>";
                            echo "<div class='menu-item Menucard' style= 'margin-left:-38px;'>";
                            echo "<img style='height: 300px; width: 240px; border-radius: 10px;' src='/project/Restaurant/admin/upload/" . $row['img'] . "' alt='" . $row['foodname'] . "' />";
                            echo "<h2 >" . $row['foodname'] . "</h2>";
                            echo "<p>Category: " . $row['category'] . "</p>";
                            // Format the price to display two decimal places
                            $formatted_price = number_format($row['price'], 2);
                            echo "<p>Price:  &#8377;" . $formatted_price . "</p>";

                            // Hidden input fields for item data
                            echo "<input type='hidden' name='item_img' value='/project/Restaurant/admin/upload/" . $row['img'] . "'>";
                            echo "<input type='hidden' name='item_name' value='" . $row['foodname'] . "'>";
                            echo "<input type='hidden' name='item_category' value='" . $row['category'] . "'>";
                            echo "<input type='hidden' name='item_price' value='" . $row['price'] . "'>";

                            echo "<div class='flex justify-content-around'>";
                            echo "<button class='btn-menu addItemBtn' name='add_to_cart'>Add to Cart</button>";
                            // echo "<a href='wishlist.php?id=" . $row['id'] . "'><i class='bi bi-heart fa-2x' style='color:#fe5722; '></i></a>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</form>";
                        }
                    }
                    sqlsrv_free_stmt($run);
                } else {
                    echo "No menu items available.";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- End Restaurant Menu -->