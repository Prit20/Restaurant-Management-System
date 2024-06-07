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
    <title> contactus Page </title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                
            </div>
            <div class="col-auto">
            <!-- <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addModal">+Add</button> -->
            </div>
        </div>
    </div>

<table class="table table-hover" id="tabledata">

    <!-- <table class="table table-striped"> -->
    <thead>
            <tr>
                <th>Id</th>
                <th>UserName</th>
                <th>Email</th>
                <th>message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql1 ="SELECT * FROM contactus";
            $run1= sqlsrv_query($Con,$sql1);
            
            while($row1 = sqlsrv_fetch_array($run1, SQLSRV_FETCH_ASSOC)){
            ?>
            <tr>

                <td> <?php echo $row1['id']?></td>
                <td> <?php echo $row1['name']?></td>
                <td> <?php echo $row1['email']?></td>
                <td> <?php echo $row1['message']?></td>
                <td> <button type="button" class="btn btn-primary btn-sm replybtn" id=" <?php echo $row1['id']?>">Reply</button>  </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
</table>

    
<script>
$('#contactpage').addClass('active');


</script>
<?php
include('/xampp/htdocs/Project/Restaurant/admin/include/foot.php');
?>