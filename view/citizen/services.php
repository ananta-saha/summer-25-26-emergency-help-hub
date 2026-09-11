<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Emergency Services</title>

    <link rel="stylesheet" href="../../assets/css/citizen.css">

</head>

<body class="servicesHub">

    <header>
        <h2 class="early">Emergency Help Hub</h2>
        <nav class="serviceNav">
            <a href="../../controller/citizen/dashboard.php">Dashboard </a>
            <a href="../../controller/citizen/request-status.php">My Requests</a>
            <a href="../../controller/citizen/profile.php">Profile</a>
            <a href="../../controller/citizen/index.php">Logout</a>
        </nav>
    </header>

    <main class="container">
        <h1>Find Emergency Services</h1>
        <p>Select the emergency service you need.</p>
        <div class="search-box">
            <form method="POST">
                <label for="location "></label>
                <input type="text" id="location" name="location" placeholder="Enter your location" value="<?= htmlspecialchars($location) ?>">

                <label for="service"></label>
                <select id="serviceType" name="serviceType">
                    <option value="" selected disabled>Select Service</option>
                    <option value="ambulance"<?= $serviceType == "ambulance" ? "selected" : "" ?>> Ambulance</option>
                    <option value="fire"<?= $serviceType == "fire" ? "selected" : "" ?>> Fire Service</option>
                    <option value="police"<?= $serviceType == "police" ? "selected" : "" ?>>Police</option>
                    <option value="hospital"<?= $serviceType == "hospital" ? "selected" : "" ?>>Hospital</option>
                </select>
                <button type="submit">Search</button>

            </form>
        </div>

        <?php if ($dbErr != ""): ?>
            <p>
                <?= htmlspecialchars($dbErr) ?>
            </p>
        <?php endif; ?>
        <div id="serviceResults">
            <?php if ($searched && $dbErr == ""): ?>
                <?php if (count($services) > 0): ?>
                    <?php foreach ($services as $service): ?>
                        <div class="service-card">
                            <h3>
                                <?= htmlspecialchars( strtoupper($service["service_type"]) ) ?>
                            </h3>
                            <p>
                                Location: <?= htmlspecialchars($service["address"]) ?>
                            </p>
                            <p>
                                Status:<strong><?= htmlspecialchars($service["availability_status"]) ?></strong>
                            </p>
            <button
                type="button" onclick="sendRequest('<?= htmlspecialchars($service["service_type"]) ?>', '<?= htmlspecialchars($service["provider_id"]) ?>')">
                     Request Service
            </button>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>
                        No service provider found for this location.
                    </p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <p>
            © 2026 Emergency Finder - Citizen Portal.
        </p>
    </footer>

    <script src="../../assets/js/script.js"></script>
</body>
</html>