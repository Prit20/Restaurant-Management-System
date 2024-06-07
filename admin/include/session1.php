<?php
session_start(); // Start the session

// Check if the user is logged in
if(!isset($_SESSION['username'])) {
    ?>
    <script>
        alert("please login frist!");
        window.open('loginpage.php', '_self');
    </script>
    <?php
}

?>