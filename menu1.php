<?php 
// include('../includes/header_dark.php');
include('include/dbcon.php');
$sql = "SELECT p.product_id,p.product_title,p.product_price,p.product_menu_image,w.isRemoved,p.product_description,p.category
FROM product_details_db p
FULL JOIN wishlist_db w ON p.product_id = w.product_id
where p.isActive='true'";
$run = SQLSRV_QUERY($con, $sql);


 // Prepare and bind the SQL statement to check if the item is already in the cart
 $sql2 = "SELECT * FROM cart WHERE item_name = '$item_name'";
 $stmt2 = sqlsrv_prepare($con, $sql2, array(&$item_name));
 sqlsrv_execute($stmt2);
 
 // Get the number of rows returned by the query
 $row_count = sqlsrv_num_rows($stmt2);
 
 // Check if the item is already in the cart
 if ($row_count > 0) {
	 // Item is already in the cart
	 echo "Item already in the cart";
 } else {
	 // Item is not in the cart, so insert it
	 // Prepare and bind the SQL statement to insert the item into the cart
	 $sql1 = "INSERT INTO cart (item_img, item_name, item_category, item_price, item_qnty) VALUES (' $item_img', '$item_name',' $item_category',' $item_price','$item_qnty')";
	 $stmt1 = sqlsrv_prepare($con, $sql1, array(&$item_img, &$item_name, &$item_category, &$item_price, &$item_qnty));
 
	 // Execute the statement to insert the item into the cart
	 if (sqlsrv_execute($stmt1)) {
		 // Item added to cart successfully
		 echo "Item added to cart successfully";
	 } else {
		 // Error adding item to cart
		 echo "Error adding item to cart";
	 }
	 
	 // Close the statement for inserting the item into the cart
	 sqlsrv_free_stmt($stmt1);
 }
 
 // Close the statement for checking if the item is already in the cart
 sqlsrv_free_stmt($stmt2);
 }

 
 
?>
<style>
	@media only screen and (min-width: 1169px) and (max-width: 1182px) {
		ul#masonry.row li.card-container {
			width: 310px;
			height: 450px;
		}
	}

	@media only screen and (min-width: 992px) and (max-width: 1168px) {
		ul#masonry.row li.card-container {
			width: 310px;
			height: 450px;
		}
	}

	@media only screen and (min-width: 576px) and (max-width: 767px) {
		ul#masonry.row {
			display: flex;
			flex-direction: row;
		}

		ul#masonry.row li.card-container {
			width: 270px;
			height: 370px;
		}

		ul#masonry.row li.card-container .dz-title {
			font-size: 18px;
		}

		ul#masonry.row li.card-container .dz-price {
			font-size: 15px;
		}

		ul#masonry.row li.card-container p {
			font-size: 12px;
		}

		ul#masonry.row li.card-container .addCart {
			width: 110px;
			height: 40px;
		}

		ul#masonry.row li.card-container .addWishList {
			width: 60px;
			height: 40px;
		}

		ul#masonry.row li.card-container .addCart span {
			font-size: 10px;
		}

	}



	.card-container {
		height: 400px;
		/* Set a fixed height for the cards */
		/* overflow: hidden; */
		/* Hide the overflow content */
	}

	.dz-content {
		height: 100%;
		/* Make sure dz-content takes 100% height of the card-container */
		display: flex;
		flex-direction: column;
		justify-content: space-between;
	}

	.dz-media img {
		/* width: 150px;
		height: 150px; */
		border-radius: 50%;
		object-fit: cover;
		/* Optional: Ensures the entire image is visible */
	}

	.message.hide {
		display: block;
		opacity: 1;
	}

	.message {
		display: none;
		opacity: 0;
	}

	.message {
		display: flex;
		flex-direction: row;
		align-items: center;
		justify-content: space-around;
		position: fixed;
		top: 10%;
		right: 2%;
		z-index: 9999;
		color: #fff;
		background-color: var(--primary);
		width: 350px;
		height: 40px;
		border-radius: 7px;
		font-weight: 500;
		text-align: center;
	}

	.ui-like {
		--icon-size: 24px;
		--icon-secondary-color: rgb(211, 205, 205);
		--icon-hover-color: rgb(230, 107, 107);
		--icon-primary-color: rgb(230, 26, 26);
		--icon-circle-border: 1px solid var(--icon-primary-color);
		--icon-circle-size: 35px;
		--icon-anmt-duration: 0.3s;
	}

	.ui-like input {
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		display: none;
	}

	.ui-like .like {
		width: var(--icon-size);
		height: auto;
		fill: var(--icon-secondary-color);
		cursor: pointer;
		-webkit-transition: 0.2s;
		-o-transition: 0.2s;
		transition: 0.2s;
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
		position: relative;
		-webkit-transform-origin: top;
		-ms-transform-origin: top;
		transform-origin: top;
	}

	.like::after {
		content: "";
		position: absolute;
		width: 10px;
		height: 10px;
		-webkit-box-shadow: 0 30px 0 -4px var(--icon-primary-color),
			30px 0 0 -4px var(--icon-primary-color),
			0 -30px 0 -4px var(--icon-primary-color),
			-30px 0 0 -4px var(--icon-primary-color),
			-22px 22px 0 -4px var(--icon-primary-color),
			-22px -22px 0 -4px var(--icon-primary-color),
			22px -22px 0 -4px var(--icon-primary-color),
			22px 22px 0 -4px var(--icon-primary-color);
		box-shadow: 0 30px 0 -4px var(--icon-primary-color),
			30px 0 0 -4px var(--icon-primary-color),
			0 -30px 0 -4px var(--icon-primary-color),
			-30px 0 0 -4px var(--icon-primary-color),
			-22px 22px 0 -4px var(--icon-primary-color),
			-22px -22px 0 -4px var(--icon-primary-color),
			22px -22px 0 -4px var(--icon-primary-color),
			22px 22px 0 -4px var(--icon-primary-color);
		border-radius: 50%;
		-webkit-transform: scale(0);
		-ms-transform: scale(0);
		transform: scale(0);
	}

	.like::before {
		content: "";
		position: absolute;
		border-radius: 50%;
		border: var(--icon-circle-border);
		opacity: 0;
	}

	/* actions */

	.ui-like:hover .like {
		fill: var(--icon-hover-color);
	}

	.ui-like input:checked+.like::after {
		-webkit-animation: circles var(--icon-anmt-duration) cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
		animation: circles var(--icon-anmt-duration) cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
		-webkit-animation-delay: var(--icon-anmt-duration);
		animation-delay: var(--icon-anmt-duration);
	}

	.ui-like input:checked+.like {
		fill: var(--icon-primary-color);
		-webkit-animation: like var(--icon-anmt-duration) forwards;
		animation: like var(--icon-anmt-duration) forwards;
		-webkit-transition-delay: 0.3s;
		-o-transition-delay: 0.3s;
		transition-delay: 0.3s;
	}

	.ui-like input:checked+.like::before {
		-webkit-animation: circle var(--icon-anmt-duration) cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
		animation: circle var(--icon-anmt-duration) cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
		-webkit-animation-delay: var(--icon-anmt-duration);
		animation-delay: var(--icon-anmt-duration);
	}

	@-webkit-keyframes like {
		50% {
			-webkit-transform: scaleY(0.6);
			transform: scaleY(0.6);
		}

		100% {
			-webkit-transform: scaleY(1);
			transform: scaleY(1);
		}
	}

	@keyframes like {
		50% {
			-webkit-transform: scaleY(0.6);
			transform: scaleY(0.6);
		}

		100% {
			-webkit-transform: scaleY(1);
			transform: scaleY(1);
		}
	}

	@-webkit-keyframes circle {
		from {
			width: 0;
			height: 0;
			opacity: 0;
		}

		90% {
			width: var(--icon-circle-size);
			height: var(--icon-circle-size);
			opacity: 1;
		}

		to {
			opacity: 0;
		}
	}

	@keyframes circle {
		from {
			width: 0;
			height: 0;
			opacity: 0;
		}

		90% {
			width: var(--icon-circle-size);
			height: var(--icon-circle-size);
			opacity: 1;
		}

		to {
			opacity: 0;
		}
	}

	@-webkit-keyframes circles {
		from {
			-webkit-transform: scale(0);
			transform: scale(0);
		}

		40% {
			opacity: 1;
		}

		to {
			-webkit-transform: scale(0.8);
			transform: scale(0.8);
			opacity: 0;
		}
	}

	@keyframes circles {
		from {
			-webkit-transform: scale(0);
			transform: scale(0);
		}

		40% {
			opacity: 1;
		}

		to {
			-webkit-transform: scale(0.8);
			transform: scale(0.8);
			opacity: 0;
		}
	}
</style>
<script>
	$(document).ready(function() {

		$('#auto_refresh_cart').load("../includes/refresh_cart.php");

		// $.ajax({
		// 	url: "../includes/refresh_cart.php",
		// 	method: "POST",
		// 	data: {
		// 		refresh_cart: 1
		// 	},
		// 	success: function(data) {
		// 		$('#auto_refresh_cart').load('../includes/refresh_cart.php');
		// 	}

		// });



	});
</script>

<div class="page-content bg-white">
	<!-- Banner  -->
	<div class="dz-bnr-inr style-1 text-center bg-parallax" style="background-image:url('../images/banner/bnr5.jpg'); background-size:cover; background-position:center;">
		<div class="container">
			<div class="dz-bnr-inr-entry">
				<h1>Menu</h1>
				<!-- Breadcrumb Row -->
				<nav aria-label="breadcrumb" class="breadcrumb-row">
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Menu</li>
					</ul>
				</nav>
				<!-- Breadcrumb Row End -->
			</div>
		</div>
	</div>
	<div class="d-flex flex-row-reverse m-2 message">
		<div class="error ">
			<div class="error__title text-center">Product added to cart <i class='bx bx-check-circle text-white ' style="font-size:20px; position:relative; top:4px; right:1px"></i> </div>
		</div>
	</div>
	<!-- Banner End -->
	<!-- Our Menu-->
	<section class="content-inner">
		<div class="container">
			<div class="row">
				<div class="col-xl-10 col-lg-9 col-md-12">
					<div class="site-filters style-1 clearfix">
						<ul class="filters" data-bs-toggle="buttons">
							<li data-filter=".All" class="btn active"><a href="javascript:void(0);"><span><i class="flaticon-fast-food"></i></span>ALL</a></li>

							<?php
							$product_display_query = "SELECT DISTINCT category FROM product_details_db where isActive='TRUE'";
							$query_run = SQLSRV_QUERY($con, $product_display_query);
							while ($row = SQLSRV_FETCH_ARRAY($query_run, SQLSRV_FETCH_ASSOC)) {
							?>

								<li data-filter=".<?= $row['category'] ?>" class="btn active"><a href="javascript:void(0);"><i class="flaticon-cocktail"></i><?= strtoupper($row['category']) ?></a></li>
								<!-- <li data-filter=".pizza" class="btn active"><a href="javascript:void(0);"><i class="flaticon-pizza-slice"></i>PIZZA</a></li>
								<li data-filter=".salad" class="btn active"><a href="javascript:void(0);"><i class="flaticon-salad"></i>SALAD</a></li>
								<li data-filter=".sweet" class="btn active"><a href="javascript:void(0);"><i class="flaticon-cupcake"></i>SWEETS</a></li>
								<li data-filter=".spicy" class="btn active"><a href="javascript:void(0);"><i class="flaticon-chili-pepper"></i>SPICY</a></li>
								<li data-filter=".special" class="btn active"><a href="javascript:void(0);"><i class="flaticon-hamburger-1"></i>BURGER</a></li> -->
							<?php } ?>
						</ul>
					</div>
				</div>
				<div class="col-xl-2 col-lg-3 col-md-12 text-lg-end mb-lg-0 m-b30 d-flex d-lg-block align-items-center justify-content-between">
					<strong class="filter-item-show d-lg-none">51,740 items</strong>
					<a data-bs-toggle="offcanvas" href="Menu.phpl#offcanvasFilter" role="button" aria-controls="offcanvasFilter" class="btn btn-primary filter-btn btn-hover-2">
						Filter <span><i class="icon-filter m-l5"></i></span>
					</a>
				</div>
				<div class="offcanvas offcanvas-end filter-category-sidebar" tabindex="-1" id="offcanvasFilter">
					<button type="button" class="btn-close style-1" data-bs-dismiss="offcanvas" aria-label="Close"><i class="la la-close"></i></button>
					<div class="offcanvas-body">
						<div class="widget">
							<div class="widget-title">
								<h4 class="title">Refine By Categories</h4>
							</div>
							<div class="category-check-list">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="productCheckBox-01">
									<label class="form-check-label" for="productCheckBox-01">
										Pizza
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="productCheckBox-02">
									<label class="form-check-label" for="productCheckBox-02">
										Hamburger
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="productCheckBox-03">
									<label class="form-check-label" for="productCheckBox-03">
										Cold Drink
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="productCheckBox-04">
									<label class="form-check-label" for="productCheckBox-04">
										Sandwich
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="productCheckBox-05">
									<label class="form-check-label" for="productCheckBox-05">
										Muffin
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="productCheckBox-06">
									<label class="form-check-label" for="productCheckBox-06">
										Burrito
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="productCheckBox-07">
									<label class="form-check-label" for="productCheckBox-07">
										Taco
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="productCheckBox-08">
									<label class="form-check-label" for="productCheckBox-08">
										Hot Dog
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="productCheckBox-09">
									<label class="form-check-label" for="productCheckBox-09">
										Noodles
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="productCheckBox-10">
									<label class="form-check-label" for="productCheckBox-10">
										Macrony
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="productCheckBox-11">
									<label class="form-check-label" for="productCheckBox-11">
										Cheese Pasta
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="productCheckBox-12">
									<label class="form-check-label" for="productCheckBox-12">
										Fish Fry
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="productCheckBox-13">
									<label class="form-check-label" for="productCheckBox-13">
										Cold Coffee
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="productCheckBox-14">
									<label class="form-check-label" for="productCheckBox-14">
										Manchurian
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="productCheckBox-15">
									<label class="form-check-label" for="productCheckBox-15">
										Dosa
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="productCheckBox-16">
									<label class="form-check-label" for="productCheckBox-16">
										Momos
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="productCheckBox-17">
									<label class="form-check-label" for="productCheckBox-17">
										Soup
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="productCheckBox-18">
									<label class="form-check-label" for="productCheckBox-18">
										Chicken Burger
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="productCheckBox-19">
									<label class="form-check-label" for="productCheckBox-19">
										Beverages
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="productCheckBox-20">
									<label class="form-check-label" for="productCheckBox-20">
										Lemon Lime Soda
									</label>
								</div>
							</div>
						</div>
						<div class="widget">
							<div class="widget-title">
								<h4 class="title">Near Me</h4>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="productCheckBox-21">
								<label class="form-check-label" for="productCheckBox-21">
									Ortus Restaurant
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="productCheckBox-22">
								<label class="form-check-label" for="productCheckBox-22">
									Amar Punjabi Restaurant
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="productCheckBox-23">
								<label class="form-check-label" for="productCheckBox-23">
									Other
								</label>
							</div>
						</div>
						<div class="widget rating-filter">
							<div class="widget-title">
								<h4 class="title">Rating</h4>
							</div>
							<ul>
								<li><span>5 Star</span></li>
								<li><i class="icon-star-on"></i></li>
								<li><i class="icon-star-on"></i></li>
								<li><i class="icon-star-on"></i></li>
								<li><i class="icon-star-on"></i></li>
								<li><i class="icon-star-on"></i></li>
							</ul>
							<ul>
								<li><span>4 Star</span></li>
								<li><i class="icon-star-on"></i></li>
								<li><i class="icon-star-on"></i></li>
								<li><i class="icon-star-on"></i></li>
								<li><i class="icon-star-on"></i></li>
							</ul>
							<ul>
								<li><span>3 Star</span></li>
								<li><i class="icon-star-on"></i></li>
								<li><i class="icon-star-on"></i></li>
								<li><i class="icon-star-on"></i></li>
							</ul>
							<ul>
								<li><span>2 Star</span></li>
								<li><i class="icon-star-on"></i></li>
								<li><i class="icon-star-on"></i></li>
							</ul>
							<ul>
								<li><span>1 Star</span></li>
								<li><i class="icon-star-on"></i></li>
							</ul>
						</div>
						<div class="widget">
							<div class="widget-title">
								<h4 class="title">Price Range</h4>
							</div>
							<div class="range-slider style-1">
								<div id="slider-tooltips"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<ul id="masonry" class="row">

				<?php
				$sr = 1;
				while ($row = SQLSRV_FETCH_ARRAY($run, SQLSRV_FETCH_ASSOC)) {
					$product_id = $row['product_id'];
					$isChecked = ($row['isRemoved'] == '0') ? 'checked' : '';
				?>
					<li class="card-container col-lg-3 col-md-6 col-sm-6 m-b30 All <?= $row['category'] ?> wow fadeInUp" data-wow-delay="0.4s">
						<a href="ProductDetail.php?product_id=<?= $product_id ?>">
							<div class="dz-img-box style-2 box-hover">
								<div class="dz-media">
									<!-- <img src="../images/shop/<?= $row['product_menu_image'] ?>" alt="/"> -->
									<img src="../../../backend/testing/images/images/menu_image/<?= $row['product_menu_image'] ?>" alt="/" width="150px" height="150px">
								</div>
								<div class="dz-content">
									<form id="<?php echo 'addForm' . $sr ?>">
										<!-- action="../includes/cart_db.php" -->
										<h4 class="dz-title"><?= $row['product_title'] ?></h4>
										<!-- <p class="text-dark"><?= implode(' ', array_slice(explode(' ', $row['product_description']), 0, 12)); ?>...</p> -->
										<p class="text-dark"><?= substr($row['product_description'], 0, 55) ?>...</p>
										<h5 class="dz-price text-primary">₹<?= $row['product_price'] ?></h5>
										<input type="hidden" name="productId" value="<?= $product_id ?>">
										<input type="hidden" name="product_price" value="<?= $row['product_price'] ?>">
						</a>
						<!-- <input type="hidden" name="add_wishlist" value="add_to_wishlist"> -->
						<button type="button" name="add_to_cart" class="btn btn-primary btn-hover-2 addCart" id="<?php echo 'addForm' . $sr ?>"><span>Add To Cart<span></button>
						<button type="button" class="btn btn-primary bg-transparent addWishList" id="<?php echo 'addwishlist' . $sr ?>" data-product-id="<?= $product_id ?>" data-product-title="<?= $row['product_title'] ?>" data-product-price="<?= $row['product_price'] ?>">
							<label class="ui-like">
								<input type="checkbox" <?= $isChecked ?>>
								<div class="like">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="">
										<g stroke-width="0" id="SVGRepo_bgCarrier"></g>
										<g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g>
										<g id="SVGRepo_iconCarrier">
											<path d="M20.808,11.079C19.829,16.132,12,20.5,12,20.5s-7.829-4.368-8.808-9.421C2.227,6.1,5.066,3.5,8,3.5a4.444,4.444,0,0,1,4,2,4.444,4.444,0,0,1,4-2C18.934,3.5,21.773,6.1,20.808,11.079Z"></path>
										</g>
									</svg>
								</div>
							</label>
						</button>

						</form>
		</div>
</div>

</li>
<?php $sr++;
				} ?>

</ul>
</div>
</section>
<!-- Our Menu-->

</div>
<!-- Popper.js CDN -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
	// $(document).ready(function() {
	// 	setInterval(function() {
	// 		$('#auto_refresh_cart').load('../includes/refresh_cart.php');
	// 		$('#cart_count').html(jsonResponse.total_cart_count);
	// 	}, 2000);
	// });
	$(document).on('click', '.addCart', function() {
		var form = $(this).attr('id');

		$.ajax({
			url: "../includes/cart_db.php",
			method: "POST",
			data: $('#' + form).serialize(),
			success: function(data) {
				console.log(data);
				// $('.cart-btn').click();
				// console.log("AJAX success:", data);
				$.ajax({
					url: "../includes/cart_db.php",
					method: "POST",
					data: {
						cart_count_update: 1
					},
					success: function(response) {
						$('.message').addClass('hide');

						// Toggle back to normal after 1 sec
						setTimeout(function() {
							$('.message').removeClass('hide');
						}, 1000);


						var jsonResponse = JSON.parse(response);
						if ('total_cart_count' in jsonResponse) {
							$('#auto_refresh_cart').load('../includes/refresh_header_cart.php');
							$('#cart_count').html(jsonResponse.total_cart_count);
						} else {
							console.error("Invalid JSON response structure");
						}
					}
				});
			},
			error: function(data) {
				console.log("AJAX error:", data);
			}
		});
	});

	$(document).on('change', '.addWishList input[type="checkbox"]', function() {
		var checkbox = $(this);
		var wishlistButton = checkbox.closest('.addWishList');
		var productId = wishlistButton.data('product-id');
		var productTitle = wishlistButton.data('product-title');
		var productPrice = wishlistButton.data('product-price');
		var isRemovedValue = checkbox.prop('checked') ? 'TRUE' : 'FALSE';

		wishlistButton.prop('disabled', true);

		$.ajax({
			url: "../includes/wishlist_db.php",
			method: "POST",
			data: {
				add_to_wishlist: 1,
				productId: productId,
				productTitle: productTitle,
				productPrice: productPrice,
				isRemoved: isRemovedValue,
			},
			success: function(data) {
				console.log(data);
				wishlistButton.prop('disabled', false);
				var currentCount = parseInt($('#wishlist_count').html());
				var newCount = isRemovedValue === 'FALSE' ? currentCount - 1 : currentCount + 1;
				$('#wishlist_count').html(newCount);
				// // Update wishlist count
				// $.ajax({
				// 	url: "../includes/wishlist_db.php",
				// 	method: "POST",
				// 	data: {
				// 		wishlist_count_update: 1
				// 	},
				// 	success: function(response) {
				// 		try {
				// 			var jsonResponse = JSON.parse(response);
				// 			console.log(jsonResponse);

				// 			if ('wishlist_count_update' in jsonResponse) {
				// 				// Update the badge count with the correct variable
				// 				$('#wishlist_count').html(jsonResponse.wishlist_count_update);
				// 			} else {
				// 				console.error("Invalid JSON response structure");
				// 			}
				// 		} catch (error) {
				// 			console.error("Error parsing JSON:", error);
				// 		}
				// 	}
				// });
			},
			error: function(data) {
				console.log("AJAX error:", data);
				wishlistButton.prop('disabled', false);
			}
		});
	});
</script>



<?php include('../includes/footer.php'); ?>