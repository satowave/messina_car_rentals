<?php
session_start();
require "includes/common.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];

    $card_number = mysqli_real_escape_string($con, $_POST['card_number']);
    $expiry_date = mysqli_real_escape_string($con, $_POST['expiry_date']);
    $cvv = mysqli_real_escape_string($con, $_POST['cvv']);

    $query = "INSERT INTO payment(`user_id`, `card_number`, `expiry_date`, `cvv`) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($stmt, "isss", $user_id, $card_number, $expiry_date, $cvv);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $redirect_to = isset($_POST['redirect_to']) ? $_POST['redirect_to'] : 'cart.php';
    mysqli_close($con);
    header('location: ' . $redirect_to);
    exit();
}

mysqli_close($con);
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
    <link rel="stylesheet" href="style11.css">
</head>
<body>
<?php
include 'includes/header_menu.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Payment Method</title>
    
</head>
<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h2>Add Payment Method</h2>

    <label for="card_number">Card Number:</label>
    <input type="text" name="card_number" required>

    <label for="expiry_date">Expiry Date:</label>
    <input type="text" name="expiry_date" placeholder="MM/YYYY" required>

    <label for="cvv">CVV:</label>
    <input type="text" name="cvv" required>

    <input type="hidden" name="redirect_to" value="<?php echo isset($_GET['redirect']) ? htmlspecialchars($_GET['redirect']) : 'cart.php'; ?>">

    <input type="submit" value="Add Payment Method">
</form>

</body>
</html>

