<?php
session_start();
require 'includes/common.php';

// This page only reads category data (no inserts/updates), so browsing it won't change the database.

$category_copy = [
    'SUV' => 'Comfortable, adventure-ready rides like the Fiat 500X and Jeep Renegade with space for Taormina detours, family gear, and Aspromonte hikes.',
    'Sports Car' => 'Lean, quick, and spirited—Abarth and Maserati toys perfect for twilight sprints along Viale Boccetta and the curves above Ganzirri Lake.',
    'Sedan' => "Balanced comfort and efficiency—think Fiat Tipo and Alfa Romeo Giulia—for breezing through Messina's waterfront and quick trips to the ferry port.",
    'Luxury' => 'Top-of-the-line interiors and refined performance from Maserati and Ferrari for promenades along Via Garibaldi or stylish arrivals at the Duomo.',
    'Rentals' => 'Doorstep drop-off, flexible returns, and concierge help—ideal when you just want the car waiting at the port or hotel.'
];

$category_cards = [];
$category_query = "SELECT c.category_id, c.category_name, (SELECT image FROM products p WHERE p.category_id = c.category_id ORDER BY p.id LIMIT 1) AS image FROM categories c WHERE c.category_id <> 1 ORDER BY c.category_id";

if ($result = mysqli_query($con, $category_query)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $category_cards[] = [
            'id' => (int)$row['category_id'],
            'name' => $row['category_name'],
            'image' => $row['image'] ? 'images/' . $row['image'] : 'images/category-placeholder.svg',
            'description' => $category_copy[$row['category_name']] ?? 'Signature picks curated for Messina drives.'
        ];
    }
}

if (empty($category_cards)) {
    $category_cards = [
        ['id' => 2, 'name' => 'SUV', 'image' => 'images/fb1.jpg', 'description' => $category_copy['SUV']],
        ['id' => 3, 'name' => 'Sports Car', 'image' => 'images/sp1.jpg', 'description' => $category_copy['Sports Car']],
        ['id' => 4, 'name' => 'Sedan', 'image' => 'images/sb1.jpg', 'description' => $category_copy['Sedan']],
        ['id' => 5, 'name' => 'Luxury', 'image' => 'images/ya1.jpg', 'description' => $category_copy['Luxury']],
        ['id' => 6, 'name' => 'Rentals', 'image' => 'images/category-placeholder.svg', 'description' => $category_copy['Rentals']],
    ];
}

$rental_perks = [
    'Doorstep delivery or port handoff in Messina',
    'Zero-excess insurance and roadside assistance',
    'Flexible return windows for ferry or flight days',
    'Extras on request: child seats, Wi‑Fi hotspot, chargers'
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Messina Car Rentals</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Delius Swash Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <link rel="stylesheet" href="index.css">
</head>

<body style="margin-bottom:100px">
    <?php
    include 'includes/header_menu.php';
    ?>

    <div class="hero">
        <div class="hero-text">
            <div class="mb-2" style="letter-spacing: 2px; text-transform: uppercase; color: var(--accent-color); font-weight: 600;">Messina, Sicily</div>
            <h1 class="display-4">Messina Car Rentals</h1>
            <p class="motto">Night drives on the Strait, mountain switchbacks at dawn.</p>
            <p class="lead-text">Curated cars for coastal promenades, hilltop villages, and neon-lit evenings in Messina. Pick a style that fits the mood and we'll have it ready.</p>
            <div class="d-flex justify-content-center mt-3 flex-wrap">
                <a href="cars.php" class="btn btn-neon m-2">Browse cars</a>
                <a href="#spotlight" class="btn btn-outline-light m-2">See Messina routes</a>
            </div>
        </div>
    </div>


    <div class="container info-section py-5">
        <h2 class="text-center pb-4" style="color: #e8ecef">Car Categories</h2>
        <div class="row">
            <?php foreach ($category_cards as $card) { ?>
                <div class="col-md-6 mb-4">
                    <div class="card h-100 text-center">
                        <img src="<?php echo htmlspecialchars($card['image']); ?>" class="card-img-top square-img" alt="<?php echo htmlspecialchars($card['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($card['name']); ?>s</h5>
                            <p class="card-text"><?php echo htmlspecialchars($card['description']); ?></p>
                            <?php if (in_array($card['name'], ['Rentals', 'Rental'])) { ?>
                                <ul class="list-unstyled text-start small text-muted mb-0">
                                    <?php foreach ($rental_perks as $perk) { ?>
                                        <li class="d-flex align-items-start mb-1">
                                            <span class="text-success mr-2" aria-hidden="true">&#10003;</span>
                                            <span><?php echo htmlspecialchars($perk); ?></span>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <p class="text-center mt-4 text-muted">Each category is tuned for Messina's shoreline, hills, and vibrant piazzas.</p>
    </div>

    <div id="spotlight" class="spotlight py-5">
        <div class="container">
            <div class="section-header text-center">
                <p class="eyebrow">Local highlights</p>
                <h2 class="mb-3">Messina drives we love</h2>
                <p class="text-muted">Pick a vibe and pair it with your favorite ride.</p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="spotlight-card">
                        <div class="tag">Sunset</div>
                        <h5>Strait glow hour</h5>
                        <p>Golden-hour run along the Lungomare with photo stops above Ganzirri Lake.</p>
                        <span class="muted">Best with: sports cars</span>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="spotlight-card">
                        <div class="tag">Night</div>
                        <h5>Neon night drive</h5>
                        <p>Late-night cruise under the city lights with playlists to match the glow.</p>
                        <span class="muted">Best with: luxury cars</span>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="spotlight-card">
                        <div class="tag">Day trip</div>
                        <h5>Taormina and back</h5>
                        <p>Coastal sprint to Taormina with a detour to Castelmola for espresso views.</p>
                        <span class="muted">Best with: SUVs</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container video-section py-5">
        <h3 class="text-center pb-3">Our Messina Hub</h3>
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <p class="mb-3 text-muted">Pick up near the port for fast ferry access or cruise the Lungomare in minutes.</p>
            </div>
        </div>
    </div>

    <div class="tips-strip py-4">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-3 mb-md-0">
                    <h6>ZTL ready</h6>
                    <p>We guide you around restricted zones so you can glide through the centro.</p>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <h6>Viewpoints</h6>
                    <p>Hit the belvedere above the Strait for skyline shots without the crowds.</p>
                </div>
                <div class="col-md-4">
                    <h6>Local support</h6>
                    <p>On-call tips for parking near the Duomo or quick ferry escapes.</p>
                </div>
            </div>
        </div>
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
        echo "<script type='text/javascript'>\n$(document).ready(function(){\n$('#signup').modal('show');\n});\n</script>";
        echo "<script type='text/javascript'>alert('" . $z . "')</script>";
    } ?>

    <?php if (isset($_GET['errorl'])) {
        $z = $_GET['errorl'];
        echo "<script type='text/javascript'>\n$(document).ready(function(){\n$('#login').modal('show');\n});\n</script>";
        echo "<script type='text/javascript'>alert('" . $z . "')</script>";
    } ?>

</body>

</html>