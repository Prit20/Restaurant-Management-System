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
    <title>staff Page </title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col">

            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                    data-bs-target="#addModal">+Add</button>
            </div>
        </div>
    </div>

    <table class="table table-hover" id="tabledata">

        <!-- <table class="table table-striped"> -->
        <thead>
            <tr>
                <th>Id</th>
                <th>Staff_Id</th>
                <th>SImage</th>
                <th>SName</th>
                <th>SDesignation</th>
                <th>SSalary</th>
                <th>SEmail</th>
                <th>SCo_No</th>
                <th>SAddress</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql1 ="SELECT * FROM staff";
            $run1= sqlsrv_query($Con,$sql1);
            
            while($row1 = sqlsrv_fetch_array($run1, SQLSRV_FETCH_ASSOC)){
            ?>
            <tr>

                <td> <?php echo $row1['id']?></td>
                <td> <?php echo $row1['staff_id']?></td>
                <td><img style="height:100px; width:100px;" src="<?php echo 'upload1/'.$row1['simage']?>" ></td>

                <td> <?php echo $row1['sname']?></td>
                <td> <?php echo $row1['sdesignation']?></td>
                <td> <?php echo $row1['ssalary']?></td>
                <td> <?php echo $row1['semail']?></td>
                <td> <?php echo $row1['smobile']?></td>
                <td> <?php echo $row1['saddress']?></td>
                <td> <button type="button" class="btn btn-warning btn-sm editbtn"
                        id=" <?php echo $row1['id']?>">Edit</button> </td>
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
                    <form action="ad_staff_db.php" method="post" id="saveForm" enctype="multipart/form-data">
                        <label class="form-label w-100 mb-2">Staff_Id
                            <input type="text" name="staff_id" class="form-control">
                        </label>

                        <label class="form-label w-100 mb-2">SImage
                            <input type="file" name="simage" class="form-control">
                        </label>

                        <label class="form-label w-100 mb-2">SName
                            <input type="text" name="sname" class="form-control">
                        </label>
                        <label class="form-label w-100 mb-2">SDesignation
                            <input type="text" name="sdesignation" class="form-control">
                        </label>
                        <label class="form-label w-100 mb-2">SSalary
                            <input type="text" name="ssalary" class="form-control">
                        </label>
                        <label class="form-label w-100 mb-2">SEmail
                            <input type="text" name="semail" class="form-control">
                        </label>
                        <label class="form-label w-100 mb-2">SCo_No
                            <input type="text" name="smobile" class="form-control">
                        </label>
                        <label class="form-label w-100 mb-2">SAddress
                            <input type="text" name="saddress" class="form-control">
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
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
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
    $('#staffpage').addClass('active');


    $(document).on('click', '.editbtn', function() {
        var id = $(this).attr('id');
        $.ajax({
            url: 'ad_staff_edit.php',
            type: 'POST',
            data: {
                id: id
            },
            success: function(data) {
                $('#UpdateForm').html(data);
                $('#editModal').modal('show');
            }
        });

    });

    $(document).on('click', '#update', function() {
        var formData = new FormData($('#UpdateForm')[0]); // Get form data including files

        $.ajax({
            url: 'ad_staff_db.php',
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
    </script>
    <?php
include('/xampp/htdocs/Project/Restaurant/admin/include/foot.php');
?>