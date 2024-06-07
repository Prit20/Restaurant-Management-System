<?php
include('include/header.php');
$username = $_SESSION['username'];
// $email = $_SESSION['email'];
$sql = "SELECT email FROM user_info WHERE username = ?";
$params = array($username); // assuming $username is defined elsewhere
$run = sqlsrv_query($con, $sql, $params);

// Check if the query executed successfully
if ($run === false) {
    // Handle query execution error
    die(print_r(sqlsrv_errors(), true));
}

// Fetch the result (assuming there's only one row)
if ($row = sqlsrv_fetch_array($run, SQLSRV_FETCH_ASSOC)) {
    // Store the fetched email in a variable
    $email = $row['email'];
} else {
    // Handle case when no matching user is found
    $email = ""; // or any default value
}

// Free the query result
sqlsrv_free_stmt($run);
?>

<div class="container2 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="review_db.php" method="POST" id="formSave" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <input class="form-check-input" type="radio" name="status" id="dinein" value="dinein">
                                <label class="form-check-label" for="dinein">
                                    Dine In
                                </label>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <input class="form-check-input" type="radio" name="status" id="takeaway"
                                    value="takeaway">
                                <label class="form-check-label" for="takeaway">
                                    Take Away
                                </label>
                            </div>
                            <div class="col-lg-6 mb-3">

                                <label for="name" class="form-label">Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" name="username"
                                        value="<?php echo $username; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>

                                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>"
                                        disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message"></label>
                            <textarea class="form-control" id="message" name="message" rows="7"
                                placeholder="Enter your message" style="margin-bottom: 10px;"></textarea>
                        </div>
                        <div class="center">
                            <div class="contact_usbtn">
                                <button type="submit" class="sbtn" name="reviewsubmit">Send Message</button>
                                <!-- <img src="gifs/aeroplane_fly.gif" alt="" srcset="" height="30px" width="30px"> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>