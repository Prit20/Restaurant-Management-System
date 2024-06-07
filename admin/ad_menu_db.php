<?php
session_start();
$user=$_SESSION['username'];
$curDate= date("Y-m-d h:i:s");
include('/xampp/htdocs/Project/Restaurant/admin/include/dbCon.php');

if(isset($_POST['save'])){
    
    $img= $_FILES['Image']['name'];//name is keyboard
    $category=$_POST['category'];
    $foodname=$_POST['foodname'];
    $price=$_POST['price'];
    

    $imgExt = substr($img, strripos($img, '.')); // get file extention
    $image = $foodname . $imgExt;
    move_uploaded_file($_FILES["Image"]["tmp_name"], "upload/" . $image);

    $sql="INSERT INTO menu (img,category,foodname,price,createdAt,createdBy,updatedAt,updatedBy) VALUES ('$image','$category','$foodname','$price','$curDate','$user','$curDate', '$user')";
    $run= sqlsrv_query($Con,$sql);
    if($run){
       ?>
        <script>
        alert('Added Successfully');
        // window.location = "dashboard.php";
        </script>
        <?php
    }else{
        echo"error".sqlsrv_errors();
    }
}
if(isset($_POST['id'])){
    $id =$_POST['id'];
    $img= $_FILES['Image']['name'];//name is keyboard
    $category=$_POST['category'];
    $foodname=$_POST['foodname'];
    $price=$_POST['price'];
    

    $imgExt = substr($img, strripos($img, '.')); // get file extention
    $image = $foodname . $imgExt;
    move_uploaded_file($_FILES["Image"]["tmp_name"], "upload/" . $image);

    $sql1="UPDATE menu SET img ='$image',category = '$category', foodname = '$foodname', price = '$price'  WHERE id ='$id'";
    $run1= sqlsrv_query($Con,$sql1);
    if($run1){
        move_uploaded_file($_FILES["Image"]["tmp_name"], "upload/" . $image);
        echo('update Successfully');

    }else{
        print_r(sqlsrv_errors());
    }
}