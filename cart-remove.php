<?php
require 'includes/common.php';
session_start();
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $rental_id = (int)$_GET['id'];
    $user_id = $_SESSION['user_id'];
    $query = "DELETE FROM rentals WHERE id=$rental_id AND user_id=$user_id";
    mysqli_query($con, $query);
}
header('location: cart.php');
?>
