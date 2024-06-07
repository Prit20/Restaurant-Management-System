<?php
include('include/session.php');
include('include/dbcon.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <!-- icon bootstrep cdn       -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Other meta tags and stylesheets for menu search-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- // jquery cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>Food Lover</title>
    <!-- CSS -->
    <link rel="stylesheet" href="style.css" />
    <!-- js -->
    <script src="script.js"></script>
    <!-- Ion Icons Js -->
    <script type="module" src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.esm.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.js"></script>

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">

    
    <!-- datatables  -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
</head>

<body>
    <!-- Menu -->
    <div class="menu">
        <nav>
            <input type="checkbox" id="check" />
            <label for="check" class="checkbtn">
                <ion-icon name="grid-outline"></ion-icon>
            </label>
            <!-- <img src="img/logo.png" alt="img" style="width: 80px; height:80px;"> -->
            
            <label class="logo"><h1>FoodLover</h1></label>

            <ul>
                <li><a href="home.php" class="nav_link">Home</a></li>
                <li><a href="about.php" class="nav_link">About Us</a></li>
                <li><a href="menu.php" class="nav_link">Menu</a></li>
                <li><a href="event.php" class="nav_link">Event</a></li>
                <li><a href="review.php" class="nav_link">Reviews</a></li>
                <li><a href="contact.php" class="nav_link">Contact Us</a></li>
                <li><a href="faq.php" class="nav_link"> FAQ </a></li>
                <?php
$sql = "SELECT role FROM user_info WHERE username='" . $_SESSION['username'] . "'";

$run = sqlsrv_query($con, $sql);
$row=sqlsrv_fetch_array($run,SQLSRV_FETCH_ASSOC);
if ($run) {
        if ($row['role'] == 'admin') {
    echo "<li><a href = 'admin/include/head.php' class ='nav_link'>admin</a></li>";

        }
    }
?>
                <!-- <p><?php echo $_SESSION['username'];?></p> -->
                <!-- <p><?php echo $_SESSION['username'];?></p> -->


                <li><a href="#" class="nav_link" onclick="toggleMenu()"> <i class="bi bi-person-circle"></i>
                    </a></li>
                <div class="sub-menu-warp" id="subMenu">
                    <div class="sub-menu">
                        <div class="flex-column justify-content-center user-info">
                            <img  src="https://i.imgur.com/hczKIze.jpg" alt="img" style="border-radius: 50%;">
                            <p style="margin-top: 5px;"><?php echo $_SESSION['username'];?></p>
                        </div>
                        <hr style="margin-top: -5px;">
                        <a href="profile.php" class="sub-menu-link">
                            <p> My Profile </p>
                            <span>></span>
                        </a>
                        <a href="order.php" class="sub-menu-link">
                            <p>My Order </p>
                            <span>></span>
                        </a>
                       
                        <a href="review.php" class="sub-menu-link">
                            <p>My Activity </p>
                            <span>></span>
                        </a>
                        <a href="logout.php" class="sub-menu-link">
                            <p>Log Out</p>
                            <span>></span>
                        </a>
                    </div>
                </div>

                <!-- <li><p style = "font-size:26px;"><?php echo $_SESSION['username']; ?></p></li> -->
            </ul>
        </nav>
    </div>
    <script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu() {
        subMenu.classList.toggle("open-menu");
    }
    </script>
    <a href="reservation.php" class="fixb">
        <p>Book My Table</p>
    </a>