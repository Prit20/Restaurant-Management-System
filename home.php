<?php
include('include/header.php');
include('include/dbcon.php');
// include('include/session.php');


?>

<!-- End Menu -->
<!-- <p>Hello <?php echo $_SESSION['username']; ?></p> -->

<!-- Hero Section -->
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="img/b1.png" class="d-block w-100  h-50" alt="...">
        </div>
        <div class="carousel-item">
            <img src="img/b2.png" class="d-block w-100 h-50" alt="...">
        </div>
        <div class="carousel-item">
            <img src="img/b3.png" class="d-block w-100 h-50" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div class="section flex" id="hero-section">
    <div class="text">
        <h1 class="primary">
            It's Not Just Food, <br />
            It's an <span>Experience</span>
        </h1>
        <p class="tertiary">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa,
            provident dolorum. Voluptatum ducimus minima quasi unde, voluptatibus
            soluta eligendi. Enim, architecto autem.
        </p>
        <a href="#menu" class="btn">Explore Menu</a>
    </div>
    <div class="visual">
        <img src="https://raw.githubusercontent.com/programmercloud/foodlover/main/img/home-banner.png" alt="" />
    </div>
</div>

<!-- End Hero Section -->

<!-- How It Works -->
<div class="section" id="how-it-works">
    <h2 class="secondary">How It Works</h2>

    <div class="container flex">
        <div class="box">
            <h3>Easy Order</h3>
            <ion-icon name="timer-outline"></ion-icon>
            <p>
                
            Ordering is made effortless with our intuitive interface, allowing customers to place orders quickly and conveniently, while our efficient system ensures accurate and timely delivery.
            </p>
        </div>

        <div class="box active">
            <h3>Best Quality</h3>
            <ion-icon name="trophy-outline"></ion-icon>
            <p>
            We deliver top-quality food swiftly by optimizing processes, using fresh ingredients, and employing skilled staff. Our commitment to efficiency and excellence ensures a memorable dining experience in record time.
            </p>
        </div>

        <div class="box">
            <h3>Fast Delivery</h3>
            <ion-icon name="checkmark-done-circle-outline"></ion-icon>
            <p>
Our fast delivery service ensures that your order reaches you promptly, with our dedicated team working tirelessly to bring your meal to your doorstep in record time, ensuring satisfaction with every bite.
            </p>
        </div>
    </div>
</div>
<!-- End How It Works -->

<?php
include('include/footer.php');
?>