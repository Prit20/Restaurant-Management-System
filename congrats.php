<?php
include('include//dbcon.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Congratulations! </title>
</head>

<body>
    <h1>Congratulations!</h1>
    <p>Your reservation has been confirmed with the following details:</p>
    
    <ul>
        <li><strong>Total Persons:</strong> <?php echo $_GET['number']; ?></li>
        <li><strong>Date:</strong> <?php echo $_GET['date']; ?></li>
        <li><strong>Time:</strong> <?php echo $_GET['time']; ?></li>
        <li><strong>Table Name:</strong> <?php echo $_GET['tableName']; ?></li>
    </ul>
</body>

</html>
