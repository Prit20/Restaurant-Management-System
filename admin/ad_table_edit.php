<?php
include('/xampp/htdocs/Project/Restaurant/admin/include/dbCon.php');


if(isset($_POST['id'])){
$sql ="SELECT * FROM table_db where id = '".$_POST['id']."'";
$run= sqlsrv_query($Con,$sql);
$row = sqlsrv_fetch_array($run, SQLSRV_FETCH_ASSOC)
?>
<div class="mb-3">
    <input type="hidden" name="id" class="form-control" value =" <?php echo $row['id']?>">
    <label class="form-label">TableName</label>
    <input type="text" name="tablename" class="form-control" value="<?php echo $row['tablename']?>">
</div>
<div class="mb-3">
    <label class="form-label">TotalPerson</label>
    <input type="text" name="totalperson" class="form-control" value="<?php echo $row['totalperson']?>">
</div>
<div class="mb-3">
    <label class="form-label">Date</label>
    <input type="date" name="date" class="form-control" value="<?php echo $row['date']->format('d-M-y')?>">
</div>
<div class="mb-3">
    <label class="form-label">Time</label>
    <input type="time" name="time" class="form-control" value="<?php echo $row['date']->format('h:i:s a')?>">
</div>
<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control" value="<?php echo $row['name']?>">
</div>
<div class="mb-3">
    <label class="form-label">SCo_No</label>
    <input type="tel" name="mobile" class="form-control" value="<?php echo $row['mobile']?>">
</div>
<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="text" name="email" class="form-control" value="<?php echo $row['email']?>">
</div>

<div class="mb-3">
    <label class="form-label">Message</label>
    <input type="text" name="message" class="form-control" value="<?php echo $row['message']?>">
</div>


<?php
}
?>
