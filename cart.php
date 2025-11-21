<?php
require 'includes/common.php';
session_start();
if (!isset($_SESSION['email'])) {
    header('location: index.php');
    exit();
}
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
</head>
<body>
<?php include 'includes/header_menu.php'; ?>
<div class="d-flex justify-content-center">
    <div class="col-md-8 my-5 table-responsive p-5">
        <table class="table table-striped table-bordered table-hover">
<?php
$sum = 0;
$user_id = $_SESSION['user_id'];
$query = "SELECT rentals.id, products.name, products.price, rentals.start_date, rentals.end_date FROM rentals JOIN products ON rentals.car_id = products.id WHERE rentals.user_id='$user_id' AND rentals.status='Booked'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) >= 1) {
?>
            <thead>
                <tr>
                    <th>Rental #</th>
                    <th>Car</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
<?php
    while ($row = mysqli_fetch_assoc($result)) {
        $days = (strtotime($row['end_date']) - strtotime($row['start_date']))/86400 + 1;
        $price = $row['price'] * $days;
        $sum += $price;
        echo "<tr><td>#{$row['id']}</td><td>{$row['name']}</td><td>{$row['start_date']}</td><td>{$row['end_date']}</td><td>Eu $price</td><td><a href='cart-remove.php?id={$row['id']}' class='remove_item_link'>Cancel</a></td></tr>";
    }

    $payment_res = mysqli_query($con, "SELECT payment_id FROM payment WHERE user_id='$user_id' LIMIT 1");
    $has_payment = mysqli_num_rows($payment_res) > 0;

    if ($has_payment) {
        echo "<tr><td></td><td></td><td></td><td>Total</td><td>Eu $sum</td><td><a href='success.php' class='btn btn-primary'>Confirm Rental</a></td></tr>";
    } else {
        echo "<tr><td></td><td></td><td></td><td>Total</td><td>Eu $sum</td><td><a href='paymentmethod.php?redirect=success.php' class='btn btn-warning'>Add Payment Method</a></td></tr>";
    }
?>
            </tbody>
<?php
} else {
    echo "<div> <img src='images/emptycart.png' class='image-fluid square-img'></div><br/>";
    echo "<div class='text-bold h5'>No rentals yet!</div>";
}
?>
        </table>
    </div>
</div>
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
