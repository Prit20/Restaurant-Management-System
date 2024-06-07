<?php
session_start();
$user=$_SESSION['username'];
$curDate= date("Y-m-d h:i:s");
include('/xampp/htdocs/Project/Restaurant/admin/include/dbCon.php');

if(isset($_POST['save'])){
    
    $img= $_FILES['eimg']['name'];//name is keyboard
    $edate=$_POST['edate'];
    $etime=$_POST['etime'];
    $etitle=$_POST['etitle'];
    $esubtitle=$_POST['esubtitle'];
    $eoffer=$_POST['eoffer'];
    

    $imgExt = substr($img, strripos($img, '.')); // get file extention
    $image = $etitle . $imgExt;
    move_uploaded_file($_FILES["eimg"]["tmp_name"], "upload2/" . $image);

    $sql="INSERT INTO event (eimg,edate,etime,etitle,esubtitle,eoffer,createdAt,createdBy,updatedAt,updatedBy) VALUES ('$image','$edate','$etime','$etitle','$esubtitle','$eoffer','$curDate','$user','$curDate', '$user')";
    $run= sqlsrv_query($Con,$sql);
    if($run){
       ?>
        <script>
        alert('Added Successfully');
        // window.location = "dashboard.php";
        </script>
        <?php
    }else{
        $errors = sqlsrv_errors();
        if ($errors !== null) {
            foreach ($errors as $error) {
                echo "SQL error: " . $error['message'] . "<br/>";
            }
        } else {
            echo "Unknown error occurred.";
        }
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