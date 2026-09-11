<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Status</title>

    <link rel="stylesheet" href="../../assets/css/citizen.css">
</head>

<body class="servicesHub">
    <header>
        <h2 class="early"> Emergency Help Hub</h2>
        <nav class="serviceNav">
            <a href="../../controller/citizen/dashboard.php">Dashboard</a>
            <a href="../../controller/citizen/services.php">Services</a>
            <a href="../../controller/citizen/profile.php">Profile</a>
        </nav>
    </header>
    <main class="container">
        <h1>My Emergency Request</h1>
        <div id="requestBox">
            <?php if ($request == null): ?>
                <p>You have no active emergency request.</p>
                <a href="../../controller/citizen/services.php">
                    <button type="button" class="primary-btn"> Find Emergency Service </button>
                </a>
            <?php else: ?>
                <div class="service-card">
                    <h3> Request Details </h3>
                    <p>
                        <strong>Service:</strong><?= htmlspecialchars($request["service_type"]); ?>
                    </p>
                    <p>
                        <strong>Emergency Type:</strong><?= htmlspecialchars($request["emergency_type"]); ?>
                    </p>
                    <p>
                        <strong>People:</strong><?= htmlspecialchars($request["people_count"]); ?>
                    </p>

                    <p>
                        <strong>Vehicles:</strong><?= htmlspecialchars($request["vehicles_requested"]); ?>
                    </p>

                    <p>
                        <strong>Location:</strong><?= htmlspecialchars($request["location"]); ?>
                    </p>

                    <p>
                        <strong>Additional Information:</strong><?= htmlspecialchars($request["details"]); ?>
                    </p>

                    <p>
                        <strong>Wheelchair:</strong><?= $request["wheelchair_required"] ? "Yes" : "No"; ?>
                    </p>

                    <?php if ($request["wheelchair_required"]): ?>
                        <p>
                            <strong>Number of Wheelchairs:</strong><?= htmlspecialchars($request["wheelchair_count"]); ?>
                        </p>
                    <?php endif; ?>
                    <p>
                        <strong>Injury:</strong><?= $request["injury_present"] ? "Yes" : "No"; ?>
                    </p>
                    <?php if ($request["injury_present"]): ?>
                        <p>
                            <strong>Injury Level:</strong><?= htmlspecialchars($request["injury_level"]); ?>
                        </p>

                        <p>
                            <strong>Injury Description:</strong><?= htmlspecialchars($request["injury_description"]); ?>
                        </p>
                    <?php endif; ?>

                    <p>
                        <strong>Status:</strong>
                        <span id="status"><?= htmlspecialchars($request["status"]); ?></span>
                    </p>

                    <form method="post" action="../../controller/citizen/request-status.php">
                        <input type="hidden" name="cancel" value="1">
                        <button type="submit">Cancel Request</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <p>
            © 2026 Emergency Finder - Citizen Portal.
        </p>
    </footer>
</body>
</html>
