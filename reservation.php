<?php
include('include/header.php');
?>
<div class="book">
    <div class="center">
        <h3 style="font-family:Dancing Script, cursive; text-align:center; font-size: 52px;">Reservation</h3>
        <h2 style="text-align:center; font-size: 52px;">Book Your Table</h2>
        <!-- <p style="text-align:center;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. In, aliquid aperiam
            eligendi quo nisi ad at, harum
            maxime reprehenderit necessitatibus amet expedita.</p> -->
    </div>


    <form class="d-flex justify-content-around" id="formData" action="table_db.php" method="POST">
        <div class="input-group">
            <!-- <input type="hidden" id="tableName1" value="Table 1"> -->
            <input type="number" id="number" name="number" min="1" max="100" class="form-control"
                placeholder="Total Person" required>
        </div>
        <div class="input-group">
            <input type="date" id="date" name="date" class="form-control" placeholder="Expected Date" required>
        </div>
        <div class="input-group">
            <input type="time" id="time" name="time" class="form-control" placeholder="Expected Time" required>
        </div>
        <button type="submit" class="sbtn" id="book" style="height: 60px; width:240px; margin-top: 11px;" name="table_show" disabled>Check
            Availability</button>
    </form>
    <br>
    <div id="tabledata"></div>

</div>
<script>
// for the disable btn when empty 
$(document).ready(function() {
    $('#formData').submit(function(e) {
        e.preventDefault(); // Prevent form submission

        // Get form data
        var formData = {
            name: $('#name').val(),
            number: $('#number').val(),
            date: $('#date').val(),
            time: $('#time').val()
        };

        // Display form data in tabledata div
        $('#tabledata').html('<p>Total Person: ' + formData.number + '</p>' +
            '<p>Expected Date: ' + formData.date + '</p>' +
            '<p>Expected Time: ' + formData.time + '</p>');

        // Optionally, you can submit the form data to a server here using AJAX

        // Example AJAX submission
        // $.ajax({
        //     type: 'POST',
        //     url: 'submit.php',
        //     data: formData,
        //     success: function(response) {
        //         // Handle server response
        //     },
        //     error: function(xhr, status, error) {
        //         // Handle errors
        //     }
        // });
    });

    $('#number, #date, #time').on('input', function() {
        var number = $('#number').val();
        var date = $('#date').val();
        var time = $('#time').val();

        if (number != '' && date != '' && time != '') {
            $('#book').prop('disabled', false);
        } else {
            $('#book').prop('disabled', true);
        }
    });
});
// for the submit and open table get 
// $(document).on('click', '#book', function() {
//     $.ajax({
//         url: 'table_get.php',
//         type: 'POST',
//         data: $('#formData').serialize(),
//         success: function(data) {
//             $('#tabledata').html(data);
            // $('#clicktable1').modal('show');
            //    window.open('table.php','_self');
//         }
//     });
// });

$(document).on('click', '#book', function() {
    $.ajax({
        url: 'table_get.php',
        type: 'POST',
        data: $('#formData').serialize(),
        success: function(data) {
            // Get the total person count entered by the user
            var total_person = parseInt($('#number').val());

            // Display only tables with capacity equal to or greater than the total person count
            $('#tabledata').html(data);
            $('.tableConfirm').each(function() {
                var table_capacity = parseInt($(this).attr('alt'));
                if (table_capacity < total_person ) {
                    $(this).hide(); // Hide tables with capacity less than the total person count
                }
            });
        }
    });
});



</script>

<style>
:root {
    --clr-primary: #fe5722;
    /* --clr-primary: #0050fc; */
    --clr-secondary: #272d36;
}

.input-group {
    position: relative;
    width: 250px;
    /* Adjust width as needed */
    background: #fff;
    border: 0px solid transparent;
    /* border-bottom: 1px solid #aaa; */
    outline: none;
    margin: 1.5em auto;
    transition: all .5s ease;
    box-shadow: 0 3px 3px rgba(0, 0, 0, .4);

    color: var(--clr-primary);
}

.input-group:hover {
    background-color: #272d36;
    /* Change background color on hover */
}

.input-group:focus-within {
    border-color: var(--clr-secondary);
    /* Adjust border color on focus */
}

.input-group input:focus {
    outline: none;
    /* Remove outline on focus */
    /* Add additional focus styles for the input field if needed */
    border-color: var(--clr-secondary);
}

/* 
.input-group:hover{
    border-bottom-color: #fe5722;
}
.input-group:focus{
	border-bottom-color:var(--clr-primary);
	box-shadow: 0 0 5px rgba(0,80,80,.4); 
	border-radius: 4px;
} */



.input-group-icon {
    position: absolute;
    top: 9px;
    /* transform: translateY(-50%); */
    left: 200px;
    /* Adjust icon position */
}

.input-group input {
    padding-left: 30px;
    /* Ensure space for the icon */
}
</style>