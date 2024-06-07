<?php
include('include/dbcon.php');
// Retrieve the data passed from the reservation page

$total_person = $_POST['number'];
$date = $_POST['date'];
$time = $_POST['time'];
$status='';
$sql="SELECT status from table_db ";
$query=sqlsrv_query($con,$sql);

if($query){
    while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC)){

        if($row['status']=='booked'){
            $status='Booked';
        }else{
            $status='Available';
        }

?>

<?php
    }
}
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="tablecontain">
        <div class="line flex justify-content-around">
            <img src="/Project/Restaurant/img/2pr.jpg" class="tableConfirm" alt="1" id="1"
                style="height: 200px; width: 200px;">
                
            
            <img src="/Project/Restaurant/img/2pr.jpg" class="tableConfirm" alt="2" id="2"
                style="height: 200px; width: 200px;">
            <div class="3pr flex justify-content-around">
                <img src="/Project/Restaurant/img/3pr.jpg" class="tableConfirm" alt="3" id="3"
                    style="height: 200px; width: 200px;">
                <img src="/Project/Restaurant/img/3pr.jpg" class="tableConfirm" alt="3" id="3"
                    style="height: 200px; width: 200px;">
                <img src="/Project/Restaurant/img/3pr.jpg" class="tableConfirm" alt="3" id="3"
                    style="height: 200px; width: 200px;">
            </div>
        </div>
        <div class="line flex justify-content-around">
            <img src="/Project/Restaurant/img/4pr.jpg" class="tableConfirm" alt="4" id="4"
                style="height: 200px; width: 200px;">
            <img src="/Project/Restaurant/img/4pr.jpg" class="tableConfirm" alt="4" id="4"
                style="height: 200px; width: 200px;">
            <img src="/Project/Restaurant/img/4pr.jpg" class="tableConfirm" alt="4" id="4"
                style="height: 200px; width: 200px;">
            <img src="/Project/Restaurant/img/4pr.jpg" class="tableConfirm" alt="4" id="4"
                style="height: 200px; width: 200px;">
        </div>
        <div class="line flex justify-content-around">
            <div class="6pr flex justify-content-start">
                <img src="/Project/Restaurant/img/5pr.jpg" class="tableConfirm" alt="5" id="5"
                    style="height: 200px; width: 200px;">
                <img src="/Project/Restaurant/img/5pr.jpg" class="tableConfirm" alt="5" id="5"
                    style="height: 200px; width: 200px;">

            </div>
            <div class="6pr flex justify-content-end">
                <img src="/Project/Restaurant/img/6pr.jpg" class="tableConfirm" alt="6" id="6"
                    style="height: 200px; width: 200px;">
                    <!-- <?php echo $status; ?> -->
                <img src="/Project/Restaurant/img/6pr.jpg" class="tableConfirm" alt="6" id="6"
                    style="height: 200px; width: 200px;">

            </div>
        </div>
        <div class="line flex justify-content-around">
            <div class="5pr flex justify-content-start">
                <img src="/Project/Restaurant/img/5pr.jpg" class="tableConfirm" alt="5" id="5"
                    style="height: 200px; width: 200px;">
                <img src="/Project/Restaurant/img/5pr.jpg" class="tableConfirm" alt="5" id="5"
                    style="height: 200px; width: 200px;">

            </div>
            <div class="line flex justify-content-around">
                <img src="/Project/Restaurant/img/8pr.jpg" class="tableConfirm" alt="8" id="8"
                    style="height: 200px; width: 200px;">
                <img src="/Project/Restaurant/img/8pr.jpg" class="tableConfirm" alt="8" id="8"
                    style="height: 200px; width: 200px;">
            </div>
        </div>



    </div>

    <!-- Table 1 popup modal  -->
    <div class="modal fade" id="clicktable1" tabindex="-1" aria-labelledby="clicktable" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reserve Table </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- <form method="POST" action="table_db.php" id="Tableinfo" enctype="multipart/form-data"> -->
                    <form method="POST" action="table_db.php" id="Tableinfo" enctype="multipart/form-data">
                        <!-- <input type="hidden" id="tableName2" value="Table 1"> -->
                        <div class="form-group row">

                            <label for="inputEmail3" class="col-sm-2 col-form-label">Table Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tableName" name="tablename1" disabled>
                            </div>
                     </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Total person</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="totalperson1" name="totalperson1"
                                    value="<?php echo $total_person; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Date </label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="date" name="date1"
                                    value="<?php echo $date; ?>" placeholder="Expected Date" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Time</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control" id="time" name="time1"
                                    value="<?php echo $time; ?>" placeholder="Expexted time" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name1"
                                    placeholder="Your Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Mobile</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" id="mobile1" name="mobile1"
                                    placeholder="9090909090">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email1" name="email1"
                                    placeholder="abc@example.com">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Message </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="message1" name="message1"
                                    placeholder="Write Your Message">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="sbtn" data-bs-dismiss="modal">Close</button>
                            <!-- <button type="submit" name="confirmdb" class="sbtn"  >Confirm Reservation</button> -->
                            <button type="submit" name="confirmdb" class="sbtn" id="confirm">Confirm Reservation</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</body>

</html>

<script>
// $(document).on('click', '#confirm', function() {
//     // Get the values filled by the user
//     var number = $('#number').val();
//     var date = $('#date').val();
//     var time = $('#time').val();
//     var id = $(this).attr('id');
//     var tableName = $('#tableName').val();
    


//     // Redirect to congrats.php with parameters
//     window.location.href = 'congrats.php?number=' + number + '&date=' + date + '&time=' + time + '&tableName=' +
//         tableName;

//         // window.location.href = 'congrats.php?number=' + number + '&date=' + date + '&time=' + time + '&tablename=' + tableName;
//         // window.location.href = 'congrats.php?number=' + number + '&date=' + date + '&time=' + time + '&tablename=' + tableName + '&name=' + name + '&mobile=' + mobile + '&email=' + email + '&message=' + message;


// });

$(document).on('click', '.tableConfirm', function() {
    var id = $(this).attr('id');
    $('#tableName').val('Table ' + id);
    $('#clicktable1').modal('show');
});
$(document).on('click', '#confirm', function() {  
    alert("your table is successfully booked");
    header("location:home.php");
});

</script>