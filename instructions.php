<?php
require("includes/common.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Messina Car Rentals - Instructions</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Delius Swash Caps' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
  <link rel="stylesheet" href="aboutfr.css">
</head>
<body style="overflow-x:hidden; padding-bottom:100px; font-family: 'Andika', sans-serif; background-color: var(--bg-color);">
  <?php include 'includes/header_menu.php'; ?>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-lg">
          <div class="card-body p-5">
            <h3 class="text-center pt-3 title">How to Rent a Car in Messina</h3>
            <hr />
            <p class="lead text-muted">Follow these simple steps to start your next drive along the Strait.</p>
            <ol class="lead">
              <li>Create an account or log in.</li>
              <li>Browse the available cars.</li>
              <li>Select your preferred dates and click <strong>Rent</strong>.</li>
            </ol>
            <div class="text-center mt-4">
              <div class="mb-3">
                <img src="https://media.giphy.com/media/111ebonMs90YLu/giphy.gif" alt="Great Job" class="img-fluid" style="max-width:150px;">
                <img src="https://media.giphy.com/media/xUPGcfb7tZIkUoIFuU/giphy.gif" alt="Thumbs Up" class="img-fluid" style="max-width:150px;">
              </div>
              <div class="video-container">
                <iframe src="https://www.youtube.com/embed/3s9pQ-7Ha2c" title="Car Rental Instructions" frameborder="0" allowfullscreen></iframe>
              </div>
              <p class="mt-3"><a href="https://www.youtube.com/watch?v=3s9pQ-7Ha2c" target="_blank">Watch on YouTube</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container inspiration pb-5">
    <h3 class="text-center">Road Trip Inspiration</h3>
    <ul class="list-unstyled text-center">
      <li><a href="https://www.youtube.com/@carwow" target="_blank">carwow</a></li>
      <li><a href="https://www.youtube.com/@ThrottleHouse" target="_blank">Throttle House</a></li>
      <li><a href="https://www.youtube.com/@AutoTrader" target="_blank">AutoTrader</a></li>
    </ul>
    <p class="text-center mt-3">Questions about road trips or vehicles? Call us at +393516321344.</p>
  </div>

  <?php include 'includes/footer.php'; ?>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function () {
      $('[data-toggle="popover"]').popover();
    });
    $(document).ready(function () {
      if (window.location.href.indexOf('#login') != -1) {
        $('#login').modal('show');
      }
    });
  </script>
  <?php if (isset($_GET['error'])) {
    $z = $_GET['error'];
    echo "<script type='text/javascript'>\n      $(document).ready(function(){\n        $('#signup').modal('show');\n      });\n    </script>";
    echo "<script type='text/javascript'>alert('" . $z . "')</script>";
  } ?>
  <?php if (isset($_GET['errorl'])) {
    $z = $_GET['errorl'];
    echo "<script type='text/javascript'>\n      $(document).ready(function(){\n        $('#login').modal('show');\n      });\n    </script>";
    echo "<script type='text/javascript'>alert('" . $z . "')</script>";
  } ?>
</body>
</html>
