<?php
include('include/head.php');
include('include/dbcon.php');
$cur_date = date('Y-m-d h:i:s');

?>
<div class="container12-fluid mt-4">
<div class="container21">
    <div class="row card_admin1">
        <div class="col-md-4 effect">
            <div class="card-counter bg-c-blue">
                <i class="bi bi-list-ol"></i>
                <!-- <img src="Restaurant/img/inventory.png" alt="Img"> -->
            <!-- <img src="C:\xampp\htdocs\Project\Restaurant\img\inventory.png" alt="gif" width="400px" height="400px" /> -->

                <span class="count-name"> Inventory Tracking </span>
                <?php 
                $sql="SELECT COUNT(*) AS item_count FROM menu";
                $query=sqlsrv_query($Con,$sql);
                if($query){
                  $row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
                  $item_count = $row['item_count'];
                  echo "<span class='count-numbers'>$item_count</span>";
                }
                 ?>
                  <div class="view-more-container">
                 <a href="ad_menu.php" class="link">View more -></a>
             </div>
              </div>
            </div>
        <div class="col-md-4 card_admin2">
            <div class="card-counter bg-c-green">
                <i class="bi bi-calendar2-event"></i>
                <span class="count-name">Event for Current Month</span>
                <?php
               $sql="SELECT COUNT(*) AS item_count FROM event";
               $query=sqlsrv_query($Con,$sql);
               if($query){
                 $row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
                 $item_count = $row['item_count'];
                 echo "<span class='count-numbers'>$item_count</span>";
               }
                ?>
       <div class="view-more-container">
                 <a href="ad_event.php" class="link">View more -></a>
             </div>

            </div>
        </div>
        <div class="col-md-4 card_admin3">
            <div class="card-counter bg-c-pink">
                <i class="bi bi-person"></i>
                <span class="count-name"> Our Staff </span>
                <?php
               $sql="SELECT COUNT(*) AS item_count FROM staff";
               $query=sqlsrv_query($Con,$sql);
               if($query){
                 $row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
                 $item_count = $row['item_count'];
                 echo "<span class='count-numbers'>$item_count</span>";
               }
                ?>
                 <div class="view-more-container">
                 <a href="ad_staff.php" class="link">View more -></a>
             </div>
            </div>
        </div>
      
    </div>

</div>

<div class="container22">
    <div class="row card_admin1">
        <div class="col-md-4">
            <div class="card-counter bg-c-pink">
                <i class="bi bi-people"></i>
                <span class="count-name">System Users</span>
                <?php
                 
                 $sql="SELECT COUNT(*) AS item_count FROM user_info";
                 $query=sqlsrv_query($Con,$sql);
                 if($query){
                   $row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
                   $item_count = $row['item_count'];
                   echo "<span class='count-numbers'>$item_count</span>";
                 }
                  ?>
               <div class="view-more-container">
                 <a href="ad_user.php" class="link">View more -></a>
             </div>
                

            </div>
        </div>
        <div class="col-md-4 card_admin2">
            <div class="card-counter bg-c-yellow">
                <i class="bi bi-bookmark-check"></i>
                <span class="count-name">Resrved Table</span>
                <?php
                 
                 $sql="SELECT COUNT(*) AS item_count FROM  table_db";
                 $query=sqlsrv_query($Con,$sql);
                 if($query){
                   $row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
                   $item_count = $row['item_count'];
                   echo "<span class='count-numbers'>$item_count</span>";
                 }
                  ?>
                   <div class="view-more-container">
                 <a href="ad_table.php" class="link">View more -></a>
             </div>
            </div>
        </div>
        <div class="col-md-4 card_admin3">
            <div class="card-counter bg-c-green">
                <i class="bi bi-patch-question"></i>
                <span class="count-name">Users querys</span>
                <?php
                 
                 $sql="SELECT COUNT(*) AS item_count FROM  contactus";
                 $query=sqlsrv_query($Con,$sql);
                 if($query){
                   $row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
                   $item_count = $row['item_count'];
                   echo "<span class='count-numbers'>$item_count</span>";
                 }
                  ?>
                   <div class="view-more-container">
                 <a href="ad_contact.php" class="link">View more -></a>
             </div>
            </div>
        </div>
      
    </div>

</div>

</div>

<?php
include('include/foot.php');
?>

<style>

.container21{
  
  width: 100%;

  gap: 10px;
  margin-top: 50px;
}
.container22{
  
  width: 100%;

  gap: 10px;
  margin-top: 50px;

}

.card-counter{
  box-shadow: 2px 2px 10px #DADADA;
  margin: 5px;
  padding: 20px 10px;
  background-color: #fff;
  height: 150px;
  border-radius: 5px;
  transition: .3s linear all;
}

.card-counter:hover{
  box-shadow: 4px 4px 20px #DADADA;
  transition: .3s linear all;
}

.card-counter.primary{
  background-color: #007bff;
  color: #FFF;
}

.card-counter i{
  font-size: 56px;
  margin-left: 17px ;
  opacity: 0.2;
}

.card-counter .count-numbers{
  position: absolute;
  right: 35px;
  top: 20px;
  font-size: 32px;
  display: block;
}

.card-counter .count-name{
  position: absolute;
  right: 35px;
  top: 65px;
  font-style: italic;
  text-transform: capitalize;
  opacity: 0.5;
  display: block;
  font-size: 18px;
}
/* .card-counter .count-link{
  position: absolute;
  right: 35px;
  top: 115px;
  font-style: italic;
  text-transform: capitalize;
  color: black;
  opacity: 0.5;
  font-size: 18px;

} */
.card-counter {
    position: relative;
}

.view-more-container {
    position: absolute;
    bottom: 10px; /* Adjust this value as needed */
    left: 50%;
    transform: translateX(-50%);
    font-size: large;
  }
  .view-more-container a{
    color: black;
    opacity: 0.7;
  }

.order-card {
  color: #fff;
}

.bg-c-blue {
  background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
  background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
  background: linear-gradient(35deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
  background: linear-gradient(45deg,#FF5370,#ff869a);
  /* color: #FFF; */

}


.card {
  border-radius: 5px;
  -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
  box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
  border: none;
  margin-bottom: 30px;
  -webkit-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

.card .card-block {
  padding: 25px;
}

.order-card i {
  font-size: 26px;
}

.f-left {
  float: left;
}

.f-right {
  float: right;
}
</style>