<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Emergency Request</title>

    <link rel="stylesheet" href="../../assets/css/citizen.css">
</head>

<body class="servicesHub">
    <header class="navbar">
        <h2 class="early">Emergency Help Hub</h2>
        <nav class="serviceNav">
            <a href="../../controller/citizen/dashboard.php">Dashboard</a>
            <a href="../../controller/citizen/services.php">Services</a>
            <a href="../../controller/citizen/request-status.php">My Requests</a>
            <a href="../../controller/citizen/profile.php">Profile</a>
            <a href="../../controller/citizen/logout.php">Logout</a>
        </nav>
    </header>

    <main class="containers">
        <form method="POST" id="requestForm">
            <h2>Emergency Request</h2>

            <?php if (!empty($error)): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <div class="field">
                <label for="emService">Emergency Service</label>
                <input type="text" id="emService" name="emService" value="<?= htmlspecialchars($emService) ?>" readonly><input
                type="hidden" name="provider_id" value="<?= htmlspecialchars($providerId) ?>">
            </div>
            <div class="field">
                <label for="emergencyType">Emergency Type</label>
                <select id="emergencyType" name="emergencyType" require>
                    <option value="">Select Emergency Type</option>
                    <option value="Accident"<?= ($emergencyType == "Accident") ? "selected" : "" ?>>Accident</option>
                    <option value="Medical Emergency"<?= ($emergencyType == "Medical Emergency") ? "selected" : "" ?>>Medical Emergency</option>
                    <option value="Fire"<?= ($emergencyType == "Fire") ? "selected" : "" ?>> Fire</option>
                    <option value="Other"<?= ($emergencyType == "Other") ? "selected" : "" ?>>Other</option>
                </select>
            </div>
            <div class="field">
                <label for="people">Number of People</label>
                <input type="number" id="people" name="people" min="1" value="<?= htmlspecialchars($people) ?>"require>
            </div>
            <div class="field">
                <label for="vehicles">Number of Vehicles</label>
                <input type="number" id="vehicles" name="vehicles" min="1" value="<?= htmlspecialchars($vehicles) ?>"require >

            </div>

            <div class="field">
                <label for="emergencyLocation">Emergency Location</label>
                <input type="text" id="emergencyLocation" name="emergencyLocation" value="<?= htmlspecialchars($emergencyLocation) ?>" require>
            </div>
            <div class="field">
                <label for="details">Additional Details</label>
                <textarea id="details" name="details"><?= htmlspecialchars($details) ?></textarea>
            </div>
            <button type="submit" class="primary-btn">Send Emergency Request</button>
        </form>
    </main>

    <script src="../../assets/js/script.js"></script>
</body>

</html>