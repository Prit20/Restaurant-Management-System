<?php
include('/xampp/htdocs/Project/Restaurant/admin/include/head.php');
include('/xampp/htdocs/Project/Restaurant/admin/include/dbCon.php');
?>
<script>
    $(document).ready(function() {
        $('#tabledata').DataTable({
            dom: 'Bfrtip',
            buttons: ['pageLength', 'copy', 'csv', 'excel', 'pdf', 'print'],
        });
    });
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Booked table page </title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                
            </div>
            <div class="col-auto">
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addModal">+Add</button>
            </div>
        </div>
    </div>

<table class="table table-hover" id="tabledata">

    <!-- <table class="table table-striped"> -->
    <thead>
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Date </th>
                <th>Time </th>
                <th>Event Name</th>
                <th>Event SubTitle</th>
                <th style="width: 250px;">Event Offer</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql1 ="SELECT * FROM event";
            $run1= sqlsrv_query($Con,$sql1);
            
            while($row1 = sqlsrv_fetch_array($run1, SQLSRV_FETCH_ASSOC)){
            ?>
            <tr>

                <td> <?php echo $row1['id']?></td>
                <td><img style="height:200px; width:150px;" src="<?php echo 'upload2/'.$row1['eimg']?>" ></td>
                <td> <?php echo $row1['edate']->format('d-M-y')?></td>
                <td> <?php echo $row1['etime']->format('h:i:s a')?></td>
                <td> <?php echo $row1['etitle']?></td>
                <td> <?php echo $row1['esubtitle']?></td>
                <td> <?php echo $row1['eoffer']?></td>
                <td> <button type="button" class="btn btn-warning btn-sm editbtn" id=" <?php echo $row1['id']?>">Edit</button> 
                <button type="button" class="btn btn-danger btn-sm ml-2 deletebtn" id="<?php echo $row['id'] ?>">Delete</button> </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
</table>
    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="ad_event_db.php" method="post" id="saveForm" enctype="multipart/form-data">

                        <label class="form-label w-100 mb-2">Image
                            <input type="file" name="eimg" class="form-control">
                        </label>

                        <label class="form-label w-100 mb-2">Date
                            <input type="date" name="edate" class="form-control">
                        </label>
                        <label class="form-label w-100 mb-2">Time
                            <input type="time" name="etime" class="form-control">
                        </label>
                        <label class="form-label w-100 mb-2">Event Name
                            <input type="text" name="etitle" class="form-control">
                        </label>
                        <label class="form-label w-100 mb-2">Event SubTitle 
                            <input type="text" name="esubtitle" class="form-control">
                        </label>
                        <label class="form-label w-100 mb-2">Event Offer
                            <input type="text" name="eoffer" class="form-control">
                        </label>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="save" form="saveForm">Save</button>
                </div>
            </div>
        </div>
    </div>



     <!--Edit Modal -->
     <div class="modal fade" id="editModale" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="UpdateForm" enctype="multipart/form-data">

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" name="update" class="btn btn-primary" id="update">Save changes</button>
                </div>
            </div>
        </div>
    </div>


<script>
$('#eventpage').addClass('active');


$(document).on('click', '.editbtn', function() {
    var id = $(this).attr('id');
    $.ajax({
        url: 'ad_table_edit.php',
        type: 'POST',
        data: {id: id},
        success: function(data) {
            $('#UpdateForm').html(data);
            $('#editModale').modal('show');
        }
    });

});

$(document).on('click', '#update', function() {
    var formData = new FormData($('#UpdateForm')[0]); // Get form data including files

    $.ajax({
        url: 'ad_table_db.php',
        type: 'POST',
        data: formData, // Use FormData object
        processData: false, // Prevent jQuery from processing the data
        contentType: false, // Prevent jQuery from setting contentType
        success: function(data) {
            alert(data);
            location.reload();
        }
    });
});

$(document).on('click','.deletebtn',function(){
    var id=$(this).attr('id').trim(); // Trim any leading or trailing spaces
    $.ajax({
        url:'ad_user_db.php',
        type:'POST',
        data:{
            id:id 
        },
        success:function(data){
            console.log("Deleted successfully");
            alert("user has been deleted!");
            location.reload();
        }
    });
});

</script>
<?php
include('/xampp/htdocs/Project/Restaurant/admin/include/foot.php');
?>