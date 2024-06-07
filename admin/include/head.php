<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="/Project/Restaurant/admin/style2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script src="/Project/Restaurant/admin/script2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


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


    <!-- card link  -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">


<!-- bootstrep icon cdn  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

    <body id="body-pd">
        <header class="header" id="header">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div> <a class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span
                            class="nav_logo-name">FoodLover</span> </a>
                    <div class="nav_list">
                        <a href="/Project/Restaurant/admin/dashboard.php"
                            class="nav_link <?= basename($_SERVER['PHP_SELF']) === 'dashboard.php' ? 'active' : '' ?>">
                            <i class='bx bx-grid-alt nav_icon'></i>
                            <span class="nav_name">Dashboard</span>
                        </a>

                        <a href="/Project/Restaurant/admin/ad_menu.php" id="menupage"
                            class="nav_link <?= basename($_SERVER['PHP_SELF']) === 'ad_menu.php' ? 'active' : '' ?>">
                            <i class='bx bx-message-square-detail nav_icon'></i>
                            <span class="nav_name">Menu</span>
                        </a>

                        <a href="/Project/Restaurant/admin/ad_event.php" id="eventpage" class="nav_link">
                            <i class='bx bx-calendar-check nav_icon'></i>
                            <span span class="nav_name">Event </span>
                        </a>
                        <a href="/Project/Restaurant/admin/ad_staff.php" id="staffpage" class="nav_link">
                            <i class='bx bx-bookmark nav_icon'></i>
                            <span span class="nav_name">Staff</span>
                        </a>
                        <a href="/Project/Restaurant/admin/ad_user.php" id="userpage" class="nav_link">
                            <i class='bx bx-user nav_icon'></i>
                            <span class="nav_name">Users</span>
                        </a>
                        <a href="/Project/Restaurant/admin/ad_table.php" id="tablepage" class="nav_link">
                            <i class='bx bx-folder nav_icon'></i>
                            <span class="nav_name">Table Reservation </span>
                        </a>
                        <a href="/Project/Restaurant/admin/ad_contact.php" id="contactpage" class="nav_link">
                            <i class="bx bx-chat nav_icon" ></i>
                            <span class="nav_name"> Contact Us </span>
                        </a>
                        
                    </div>
                </div> 
            
<div >           <a style="margin-top: 13px; margin-bottom:-2px;" href="/Project/Restaurant/home.php" class="nav_link"> <i class='bi bi-house-door-fill nav_icon'></i> <span
                        class="nav_name"> Back To Home </span> </a>
                <a href="/Project/Restaurant/logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                        class="nav_name">SignOut</span> </a> </div>
     
            </nav>
        </div>
        <!--Container Main start-->
        <div class="height-100 bg-light" style="margin-top:65px;">
            <!-- <h4>Main Components</h4> -->