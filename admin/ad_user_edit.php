<?php
include('/xampp/htdocs/Project/Restaurant/admin/include/dbCon.php');


if(isset($_POST['id'])){
$sql ="SELECT * FROM user_info where id = '".$_POST['id']."'";
$run= sqlsrv_query($Con,$sql);
$row = sqlsrv_fetch_array($run, SQLSRV_FETCH_ASSOC)
?>
<div class="mb-3">
    <input type="hidden" name="id" class="form-control" value =" <?php echo $row['id']?>">
    <label class="form-label">UserName</label>
    <input type="text" name="username" class="form-control" value="<?php echo $row['username']?>">
</div>

<div class="mb-3">
    <label class="form-label">FullName</label>
    <input type="text" name="fullname" class="form-control" value="<?php echo $row['fullname']?>">
</div>
<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="text" name="email" class="form-control" value="<?php echo $row['email']?>">
</div>
<div class="mb-3">
    <label class="form-label">Co_NO</label>
    <input type="text" name="conum" class="form-control" value="<?php echo $row['conum']?>">
</div>


<?php
}
?>
