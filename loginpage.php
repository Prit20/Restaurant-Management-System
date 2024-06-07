<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        

    <!-- CSS -->
    <link rel="stylesheet" href="style.css" />
    <!-- js -->
    <script src="script.js"></script>
   </head>
<body>
    
    <!-- Main Content -->
    <div class="container-fluid">
    <div class="row main-content bg-success text-center">
        <div class="col-md-4 text-center company__info">
            <span class="logo">
                <h2>FoodLover</h2>
            </span>
        </div>
        <div class="col-md-8 col-xs-12 col-sm-12 login_form ">
            <div class="container-fluid">
                <div class="row">
                    <h2>Log In</h2>
                </div>
                <div class="row">
                    <form method="POST" action="login_db.php" class="form-group ">
                        <div class="row">
                            <input type="text" name="username" id="username" class="form__input" placeholder="Username">
                        </div>
                        <div class="row">
                            <!-- <span class="fa fa-lock"></span> -->
                            <input type="password" name="password" id="password" class="form__input"
                                placeholder="Password">
                        </div>
                        <div class="row1 flex justify-content-around ">
                            <div class="leftside">
                                <input type="checkbox" name="remember_me" id="remember_me" class="">
                                <label for="remember_me">Remember Me!</label>
                            </div>
                            <div class="rightside">
                                <a href="#">ForgotPassword?</a>
                            </div>
                        </div>
                        <div class="row">
                            <input type="submit" name="login" value="Login" class="btn">
                        </div>
                    </form>
                </div>
                <div class="row">
                    <p>Don't have an account? <a href="register.php">Register Here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<!-- <div class="container-fluid text-center footer">
    Coded with &hearts; by <a href="https://bit.ly/yinkaenoch">Yinka.</a></p>
</div> -->

</body>


