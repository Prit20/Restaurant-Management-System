<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- icon bootstrep cdn       -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="style.css" />
    <!-- js -->
    <script src="script.js"></script>
</head>

<body>

    <div class="Rcontainer">
        <h2>Registration Form</h2>
        <form id="registrationForm" action="register_db.php" method="post">
            <div class="form-group ">
               
                <label for="username"> <i class="bi bi-person"></i> Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="username" > <i class="bi bi-person"></i> User Full Name</label>
                <input type="text" id="userid" name="fname" required>
            </div>
            <div class="form-group">
                <label for="email"> <i class="bi bi-envelope"></i> Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone"><i class="bi bi-telephone"></i> Phone Number</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="password"><i class="bi bi-lock"></i> Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword"><i class="bi bi-lock"></i> Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
            </div>
            <div class="form-group flex justify-content-start">
                <input type="checkbox" id="showPassword" onchange="togglePassword()"> 
                <label for="showPassword"> Show Password</label>
            </div>
            <button type="submit" name="rgtr">Register</button>
        </form>
    </div>


<script>
    function togglePassword() {
    var passwordField = document.getElementById("password");
    var confirmPasswordField = document.getElementById("confirmPassword");
    var checkbox = document.getElementById("showPassword");
  
    if (checkbox.checked) {
      passwordField.type = "text";
      confirmPasswordField.type = "text";
    } else {
      passwordField.type = "password";
      confirmPasswordField.type = "password";
    }
  }
</script>