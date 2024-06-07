<?php
include('/xampp/htdocs/Project/Restaurant/admin/include/dbCon.php');


if(isset($_POST['id'])){
$sql ="SELECT * FROM staff where id = '".$_POST['id']."'";
$run= sqlsrv_query($Con,$sql);
$row = sqlsrv_fetch_array($run, SQLSRV_FETCH_ASSOC)
?>
<div class="mb-3">
    <input type="hidden" name="id" class="form-control" value =" <?php echo $row['id']?>">
    <label class="form-label">Staff_Id</label>
    <input type="text" name="staff_id" class="form-control" value="<?php echo $row['staff_id']?>">
</div>
<div class="mb-3">
    <label class="form-label w-100 mb-2">SImage</label>
    <input type="file" name="simage" class="form-control" value="src='upload1/<?php echo $row['simage']; ?>'">
</div>

<div class="mb-3">
    <label class="form-label">SName</label>
    <input type="text" name="sname" class="form-control" value="<?php echo $row['sname']?>">
</div>
<div class="mb-3">
    <label class="form-label">SDesignation</label>
    <input type="text" name="sdesignation" class="form-control" value="<?php echo $row['sdesignation']?>">
</div>
<div class="mb-3">
    <label class="form-label">SSalary</label>
    <input type="text" name="ssalary" class="form-control" value="<?php echo $row['ssalary']?>">
</div>
<div class="mb-3">
    <label class="form-label">SEmail</label>
    <input type="text" name="semail" class="form-control" value="<?php echo $row['semail']?>">
</div>
<div class="mb-3">
    <label class="form-label">SCo_No</label>
    <input type="text" name="smobile" class="form-control" value="<?php echo $row['smobile']?>">
</div>
<div class="mb-3">
    <label class="form-label">SAddress</label>
    <input type="text" name="saddress" class="form-control" value="<?php echo $row['saddress']?>">
</div>


<?php
}
?>
