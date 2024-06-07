<?php
include('include/header.php');
?>

<div class="event">
    <div class="left">
        <h1>Upcoming Event</h1>
    </div>
    <div class="right">
        <button class="btn btn-menu" id="view" type="button">View All</button>
    </div>
</div>

<div class="cardcontainer" style="display: flex; flex-wrap: wrap;">
    <?php
    $sql = "SELECT * FROM event";
    $run = sqlsrv_query($con, $sql);
    $countdownIndex = 0; // Initialize a counter for unique countdown IDs
    
    while ($row = sqlsrv_fetch_array($run, SQLSRV_FETCH_ASSOC)) {
        $countdownIndex++; // Increment the counter for each card
    ?>
    <div class="card" style="width: 18rem; margin: 0 20px 20px 0;">
        <div class="card-body">
            <h5 class="card-title"><?php echo $row['etitle'] ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo $row['esubtitle'] ?></h6>
            <h5 class="card-date"><?php echo $row['edate']->format('d-M-Y') ?></h5>
            <!-- Unique ID for countdown element -->
            <?php
            $eventDate = strtotime($row['edate']->format('d-M-Y h:i:s')); // Convert event date to Unix timestamp
            $countdownId = "demo_" . $countdownIndex; // Generate unique countdown ID
            ?>
            <!-- Display the countdown timer in an element -->
            <p id="<?php echo $countdownId; ?>"></p>
            <script>
                // Set the date we're counting down to for this card
                var countDownDate_<?php echo $countdownIndex; ?> = new Date("<?php echo date("M d, Y H:i:s", $eventDate); ?>").getTime();

                // Update the count down every 1 second for this card
                var x_<?php echo $countdownIndex; ?> = setInterval(function() {
                    // Get today's date and time
                    var now = new Date().getTime();

                    // Find the distance between now and the count down date for this card
                    var distance = countDownDate_<?php echo $countdownIndex; ?> - now;

                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Display the result in the element with unique ID
                    document.getElementById("<?php echo $countdownId; ?>").innerHTML = days + "d " + hours + "h " +
                        minutes + "m " + seconds + "s ";

                    // If the count down is finished, write some text
                    if (distance < 0) {
                        clearInterval(x_<?php echo $countdownIndex; ?>);
                        document.getElementById("<?php echo $countdownId; ?>").innerHTML = "EXPIRED";
                    }
                }, 1000);
            </script>

            <p class="card-text"><?php echo $row['eoffer'] ?></p>
            <a href="reservation.php" class="sbtn "> Book Table </a>
            <!-- <button type="button" class="sbtn btn-primary modalbtn" data-bs-toggle="modal" data-bs-target="#exampleModal"
                data-etitle="<?php echo $row['etitle'] ?>"
                data-edate="<?php echo $row['edate']->format('d-M-y') ?>"
                data-etime="<?php echo $row['etime']->format('h:i:s a') ?>"
                data-eimg="<?php echo $row['eimg'] ?>"> Book Table </button> -->
        </div> 
    </div>
    <?php } ?>
</div>

</body>
</html>
<style>
.eventTab {
    display: none;
    /* Hide the timetable by default */
}
</style>


<script>
document.getElementById('view').addEventListener('click', function() {
    // Get the timetable element
    var eventTab = document.querySelector('.eventTab');

    // Toggle the visibility of the timetable
    if (eventTab.style.display === 'none') {
        eventTab.style.display = 'block'; // Show the timetable
    } else {
        eventTab.style.display = 'none'; // Hide the timetable
    }
});
</script>
<div class="eventTab">

    <table class="table table-striped">
        <thead>

            <th>Date</th>
            <th>Time</th>
            <th>Event Name</th>
            <th>Description</th>
            <th>Special Offer</th>

        </thead>
        <tbody>
            <tr>
                <td><?php echo $row['edate']->format('d-M-y')?></td>
                <td> <?php echo $row['etime']->format('h:i:s a')?></td>
                <td><?php echo $row['etitle'] ?></td>
                <td><?php echo $row['esubtitle'] ?></td>
                <td><?php echo $row['eoffer'] ?></td>
            </tr>

        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    $(".modalbtn").on("click", function() {
        $("#Eventmodal").modal("show");
    })

})
</script>