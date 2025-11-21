<?php
session_start();
require 'includes/common.php';

$type = '';
$category_id = 1;
$categories_list = mysqli_query($con, "SELECT category_id, category_name FROM categories ORDER BY category_id");
if (isset($_GET['category_id'])) {
    $category_id = (int)$_GET['category_id'];
    if($category_id == 1){
        $cars = mysqli_query($con, "SELECT * FROM products WHERE category_id=1");
    } else {
        $cars = mysqli_query($con, "SELECT * FROM products WHERE category_id=$category_id");
        $res = mysqli_query($con, "SELECT category_name FROM categories WHERE category_id=$category_id");
        if($row = mysqli_fetch_assoc($res)) $type = $row['category_name'];
    }
} elseif (isset($_GET['type'])) {
    $type = mysqli_real_escape_string($con, $_GET['type']);
    $cars = mysqli_query($con, "SELECT * FROM products WHERE name LIKE '%$type%'");
} else {
    $cars = mysqli_query($con, "SELECT * FROM products WHERE category_id=1");
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
    <link rel="stylesheet" href="aboutfr.css">
</head>
<body class="catalog-body category-<?php echo $category_id; ?>">
<?php
include 'includes/header_menu.php';
$car_count = $cars ? mysqli_num_rows($cars) : 0;
?>
<div class="container" style="margin-top:65px">
    <section class="catalog-hero">
        <div>
            <div class="eyebrow">Messina rentals</div>
            <h1 class="hero-title">Drive Messina in style</h1>
            <p class="hero-copy">Pick from local favorites—from Fiat city cars to Alfa Romeo sedans and Maserati grand tourers—for the Strait, the hills, or a night run along the Lungomare.</p>
            <div class="hero-badges">
                <span class="badge-pill"><i class="fa fa-bolt mr-1"></i> Instant confirmation</span>
                <span class="badge-pill"><i class="fa fa-shield mr-1"></i> Third-party insurance</span>
                <span class="badge-pill"><i class="fa fa-road mr-1"></i> Unlimited km options</span>
            </div>
            <div class="hero-actions mt-3">
                <a href="#catalog" class="btn btn-accent mr-2">View current fleet</a>
                <a href="#filters" class="btn btn-ghost">Compare categories</a>
            </div>
        </div>
        <div class="hero-card">
            <div class="hero-card-title">Need a quick pick?</div>
            <ul class="hero-card-list">
                <li><strong>City run:</strong> Choose a compact for tight alleys and easy parking.</li>
                <li><strong>Coastal cruise:</strong> Grab a cabrio or GT for the Lungomare.</li>
                <li><strong>Hill drives:</strong> SUVs with torque for Castanea and Curcuraci climbs.</li>
            </ul>
        </div>
    </section>
    <div id="filters" class="category-tabs text-center">
        <a href="cars.php" class="category-pill<?php echo $category_id==1?' active':''; ?>"><i class="fa fa-th-large mr-1"></i>All Cars</a>
        <?php mysqli_data_seek($categories_list,0); while($cat = mysqli_fetch_assoc($categories_list)){ if($cat['category_id']==1) continue; ?>
            <a href="cars.php?category_id=<?php echo $cat['category_id']; ?>" class="category-pill<?php echo $category_id==$cat['category_id']?' active':''; ?>">
                <i class="fa fa-car mr-1"></i><?php echo htmlspecialchars($cat['category_name']); ?>
            </a>
        <?php } ?>
    </div>
    <div class="catalog-meta text-center mb-3">
        <h2 class="catalog-title mb-1"><?php echo $type ? htmlspecialchars($type) : 'All Cars'; ?></h2>
        <p class="catalog-subtitle text-muted"><?php echo $car_count; ?> option<?php echo $car_count===1 ? '' : 's'; ?> ready to rent today.</p>
    </div>
    <?php if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']){ ?>
        <div class="d-flex justify-content-end mb-3">
            <a href="add_product.php?category_id=<?php echo $category_id; ?>" class="btn btn-primary">Add Car</a>
        </div>
    <?php } ?>
    <div id="catalog" class="row">
        <?php while($row = mysqli_fetch_assoc($cars)) { ?>
        <div class="col-md-6 col-12 mb-4">
            <div class="car-card">
                <div class="car-media">
                    <img src="images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="img-fluid square-img">
                    <div class="car-badge">Featured</div>
                </div>
                <div class="car-body">
                    <div class="car-header d-flex justify-content-between align-items-start">
                        <div>
                            <div class="car-name"><?php echo htmlspecialchars($row['name']); ?></div>
                            <div class="car-meta text-muted">Daily rental · Flexible pickup</div>
                        </div>
                        <div class="car-price text-right">
                            <div class="price-amount">€<?php echo $row['price']; ?></div>
                            <div class="price-chip">per day</div>
                        </div>
                    </div>
                    <div class="car-specs">
                        <span><i class="fa fa-user-o"></i> 4 seats</span>
                        <span><i class="fa fa-cog"></i> Automatic</span>
                        <span><i class="fa fa-suitcase"></i> 2 bags</span>
                    </div>
                    <div class="car-actions">
                        <?php if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']){ ?>
                            <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-danger">Delete</a>
                        <?php } else { ?>
                            <?php if (!isset($_SESSION['email'])) {?>
                                <a href="index.php#login" class="btn btn-accent">Rent</a>
                            <?php } else { ?>
                                <form action="rent_car.php" method="post" class="rent-form">
                                    <input type="hidden" name="car_id" value="<?php echo $row['id']; ?>">
                                    <div class="form-row">
                                        <div class="col-6 mb-2">
                                            <label class="sr-only" for="start-<?php echo $row['id']; ?>">Start date</label>
                                            <input id="start-<?php echo $row['id']; ?>" type="date" name="start_date" class="form-control" placeholder="Start date" required>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <label class="sr-only" for="end-<?php echo $row['id']; ?>">End date</label>
                                            <input id="end-<?php echo $row['id']; ?>" type="date" name="end_date" class="form-control" placeholder="End date" required>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <button type="submit" class="btn btn-accent">Rent</button>
                                        <span class="text-muted small">Secure checkout · No hidden fees</span>
                                    </div>
                                </form>
                            <?php } } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
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
