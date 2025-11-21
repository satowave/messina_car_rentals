<?php
require "includes/common.php";
session_start();

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('location: index.php');
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    $delete_links = "DELETE FROM rentals WHERE car_id = $id";
    mysqli_query($con, $delete_links) or die("Error deleting from rentals: " . mysqli_error($con));

    $delete_product = "DELETE FROM products WHERE id = $id";
    mysqli_query($con, $delete_product) or die("Error deleting from products: " . mysqli_error($con));
}

$redirect = $_SERVER['HTTP_REFERER'] ?? 'products.php';
header('location: ' . $redirect);
exit();
?>