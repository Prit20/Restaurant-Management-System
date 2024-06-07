<?php
include('include/session.php');
include('include/dbcon.php');

$user = $_SESSION['username'];
$sql = "SELECT * FROM user_info WHERE username = '$user'"; // Added single quotes around $user
$run = sqlsrv_query($con, $sql);

if ($run === false) {
    die(print_r(sqlsrv_errors(), true)); // Print SQL errors
}

$row = sqlsrv_fetch_array($run, SQLSRV_FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
</head>
<body>
  <!-- Main -->
  <div class="main">
        <h2>Profile</h2>
        <div class="card">
            <div class="card-body">
                <i class="fa fa-pen fa-xs edit"></i>
                <form action="profile_db.php" method="POST">
                <table>
                    <tbody>
                        <tr>
                            <td>User Name</td>
                            <td>:</td>
                            <td><input type="text" class="form__input" id="username" name="username" value="<?php echo $row['username'] ?>" required></td>
                        </tr>
                        <tr>
                            <td>Full Name</td>
                            <td>:</td>
                            <td><input type="text" class="form__input" name="fname" value="<?php echo $row['fullname'] ?>" required></td>

                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><input type="text" class="form__input" id="email" name="email" value="<?php echo $row['email'] ?>" required></td>

                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td>:</td>
                            <td><input type="text" class="form__input" id="phone" name="phone" value="<?php echo $row['conum'] ?>" required></td>

                        </tr>
                    </tbody>
                </table>
                <div style="display:flex ; justify-content:space-around;">
                    <div>
                     <button style="margin-left: -50px; width:120px;" class="btn1"  type="submit" id="save_chang" name="save_chang"> Update</button></div>
                    <div>

                     <a href="home.php" type="button" class="btn" id="back_to_home" name="back_to_home">Back To Home</a></div>
                </div>
            </form>

            </div>
        </div>



</body>
</html>

<style>
  :root {
  --clr-primary: #fe5722;
  /* --clr-primary: #0050fc; */
  --clr-secondary: #272d36;
}
.btn {
  padding: 5px 5px;
  background: var(--clr-primary);
  border-radius: 4px;
  color: #fff;
  text-decoration: none;
  font-size: 20px;
  width: 100%;
  
  /* margin: 20px 0; */
}
.btn1 {
  padding: 5px 5px;
  background: var(--clr-primary);
  border-radius: 4px;
  color: #fff;
  text-decoration: none;
  font-size: 20px;
  width: 100%;
  border-color: non;
  
  /* margin: 20px 0; */
}
  /* Main */
.main {
    margin-top: 2%;
    margin-left: 22%;
    font-size: 28px;
    padding: 0 10px;
    width: 50%;
}

.main h2 {
    color: #333;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 24px;
    margin-bottom: 10px;
    text-align: center;
}

.main .card {
    background-color: #fff;
    border-radius: 18px;
    box-shadow: 1px 1px 8px 0 grey;
    height: auto;
    margin-bottom: 20px;
    padding: 20px 0 20px 50px;
}

.main .card table {
    border: none;
    font-size: 16px;
    height: 270px;
    width: 80%;
}


form{
	padding: 0 2em;
}
/* form button{
    margin: auto;
    width: 100%;
    /* margin-left: -10px; */
/* } */
.form__input{
	width: 80%;
	border:0px solid transparent;
	border-radius: 0;
	border-bottom: 1px solid #aaa;
	padding: 1em .5em .5em;
	padding-left: 2em;
	outline:none;
	/* margin:1.5em auto; */
	transition: all .5s ease;
}
.form__input:focus{
	border-bottom-color:var(--clr-primary);
	box-shadow: 0 0 5px rgba(0,80,80,.4); 
	border-radius: 4px;
}
</style>