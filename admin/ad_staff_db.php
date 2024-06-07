<?php
session_start();
$user=$_SESSION['username'];
$curDate= date("Y-m-d h:i:s");
include('/xampp/htdocs/Project/Restaurant/admin/include/dbCon.php');

if(isset($_POST['save'])){
    
    $staff_id=$_POST['staff_id'];
    $img= $_FILES['simage']['name'];//name is keyboard
    $sname=$_POST['sname'];
    $sdesignation=$_POST['sdesignation'];
    $ssalary=$_POST['ssalary'];
    $semail=$_POST['semail'];
    $smobile=$_POST['smobile'];
    $saddress=$_POST['saddress'];
    

    $imgExt = substr($img, strripos($img, '.')); // get file extention
    $image = $staff_id . $imgExt;
    move_uploaded_file($_FILES["simage"]["tmp_name"], "upload1/" . $image);

    $sql="INSERT INTO staff (staff_id, simage, sname,sdesignation, ssalary, semail, smobile, saddress, createdAt, createdBy, updatedAt, updatedBy) VALUES ('$staff_id', '$image', '$sname', '$sdesignation','$ssalary', '$semail', '$smobile', '$saddress', '$curDate', '$user', '$curDate', '$user')";

    $run= sqlsrv_query($Con,$sql);
    if($run){
        ?>
         <script>
         alert('Added Successfully');
         window.location = "ad_staff.php";

         </script>
         <?php
     }else{
         echo "Error: ";
         print_r(sqlsrv_errors());
     }
    }     
    if(isset($_POST['id'])){
        $id =$_POST['id'];
        $staff_id=$_POST['staff_id'];
        $img= $_FILES['simage']['name'];//name is keyboard
        $sname=$_POST['sname'];
        $sdesignation=$_POST['sdesignation'];
        $ssalary=$_POST['ssalary'];
        $semail=$_POST['semail'];
        $smobile=$_POST['smobile'];
        $saddress=$_POST['saddress'];
        
    
        $imgExt = substr($img, strripos($img, '.')); // get file extention
        $image = $staff_id . $imgExt;
        move_uploaded_file($_FILES["simage"]["tmp_name"], "upload1/" . $image);
    
        $sql1="UPDATE staff SET staff_id ='$staff_id',simage = '$image', sname = '$sname', sdesignation = '$sdesignation', ssalary = '$ssalary', semail = '$semail', smobile = '$smobile', saddress = '$saddress'  WHERE id ='$id'";
        $run1= sqlsrv_query($Con,$sql1);
        if($run1){
            // move_uploaded_file($_FILES["Image"]["tmp_name"], "upload1/" . $image);
            echo('update Successfully');
    
        }else{
            print_r(sqlsrv_errors());
        }
    }