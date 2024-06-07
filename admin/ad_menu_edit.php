<?php
include('/xampp/htdocs/Project/Restaurant/admin/include/dbCon.php');


if(isset($_POST['id'])){
$sql ="SELECT * FROM menu where id = '".$_POST['id']."'";
$run= sqlsrv_query($Con,$sql);
$row = sqlsrv_fetch_array($run, SQLSRV_FETCH_ASSOC);
?>
<div class="mb-3">
    <input type="hidden" name="id" class="form-control" value=" <?php echo $row['id']?>">
    <label class="form-label w-100 mb-2">Image</label>
    <input type="file" name="Image" class="form-control" value="src='upload/<?php echo $row['img']; ?>'">
</div>

<div class="mb-3">
    <label class="form-label">Category</label>
    <input type="text" name="category" class="form-control" value="<?php echo $row['category']?>">
</div>
<div class="mb-3">
    <label class="form-label">foodname</label>
    <input type="text" name="foodname" class="form-control" value="<?php echo $row['foodname']?>">

</div>

<div class="mb-3">
    <label class="form-label">Price</label>
    <input type="float" name="price" class="form-control" value="<?php echo $row['price']?>">

</div>

<?php
}
?>
