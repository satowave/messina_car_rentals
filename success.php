<?php
require 'includes/common.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location: index.php');
    exit();
}
$user_id = $_SESSION['user_id'];

$payment_check = mysqli_query($con, "SELECT payment_id FROM payment WHERE user_id='$user_id' LIMIT 1");
if (mysqli_num_rows($payment_check) == 0) {
    header('location: paymentmethod.php?redirect=success.php');
    exit();
}

$query = "UPDATE rentals SET status='Confirmed' WHERE user_id='$user_id' AND status='Booked'";
mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Messina Car Rentals</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    <link href='https://fonts.googleapis.com/css?family=Delius Swash Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="refresh" content="4;url=index.php" />
</head>
<body>
    <?php include 'includes/header_menu.php'; ?>
    <div class="container-fluid mt-5 pt-5" id="content" style="margin-bottom:200px">
            <div class="col-md-8 mx-auto">
                <div class="jumbotron text-center">
                      <h3>Your rental is confirmed. Thank you for hitting the road with us.</h3><hr>
                    <p>Click <a href="index.php">here</a> to reserve another car.</p>
                </div>
            </div>
        </div>
         <?php include 'includes/footer.php'?>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();
});
</script>
</html>
