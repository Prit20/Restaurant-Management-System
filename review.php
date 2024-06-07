<?php
include('include/header.php');
$sql = "SELECT * FROM review";
$run = sqlsrv_query($con, $sql);
?>

<!-- Testimonial -->
<div class="section" id="testimonial">
    <div class="container flex">
        <div class="text">
            <h2 class="secondary">What people say about FoodLover</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore,
                eos voluptatem odio, molestias ullam error dolor rem laboriosam illo
                quae odit aliquam sint a amet, autem natus! Praesentium, ipsam
                mollitia?
            </p>
        </div>
    </div>
    <div class="review flex justify-content-around">
        <h3>Review</h3>
        <a href="review_add.php">Write Review</a>
    </div>
    <div class="main flex justify-content-around flex-wrap" style="max-width: 1000px;">
        <?php while ($row = sqlsrv_fetch_array($run, SQLSRV_FETCH_ASSOC)) { ?>
            <div class="card" style="width: calc(33.33% - 20px); margin: 10px;">
                <div class="card-body">
                    <div class="flex justify-content-start">
                        <!-- <img src="//" alt="img"> -->
                        <div>
                            <h5 class="card-title"><?php echo $row['username']?></h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $row['status']?></h6>
                        </div>
                    </div>
                    <p class="card-text" style="margin:auto;"><?php echo $row['message']?></p>
                    <!-- <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a> -->
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<!-- End Testimonial -->
