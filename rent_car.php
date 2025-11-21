<?php
require 'includes/common.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location: index.php');
    exit();
}
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['car_id'])){
    $car_id = (int)$_POST['car_id'];
    $user_id = $_SESSION['user_id'];
    $start = mysqli_real_escape_string($con, $_POST['start_date']);
    $end = mysqli_real_escape_string($con, $_POST['end_date']);
    $query = "INSERT INTO rentals(user_id, car_id, start_date, end_date, status) VALUES($user_id,$car_id,'$start','$end','Booked')";
    mysqli_query($con, $query) or die(mysqli_error($con));
}
header('location: cart.php');
?>
