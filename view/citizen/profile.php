<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Profile</title>

    <link rel="stylesheet" href="../../assets/css/citizen.css">
</head>

<body class="servicesHub">
    <header class="navbar">
        <h2>🚑 Emergency Finder</h2>
        <nav>
            <a href="../../controller/citizen/dashboard.php">Dashboard</a>
            <a href="../../controller/citizen/services.php">Services</a>
            <a href="../../controller/citizen/request-status.php">My Requests</a>
        </nav>
    </header>

    <h1 class="Profile">My Profile</h1>
    <div class="main-container">
        <?php if ($dbErr): ?>
            <p class="error">
                <?= htmlspecialchars($dbErr) ?>
            </p>
        <?php endif; ?>

        <?php if ($successMsg): ?>
            <p class="success">
                <?= htmlspecialchars($successMsg) ?>
            </p>
        <?php endif; ?>

        <form method="post"
              action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <div class="field">
                <label for="fname">Full Name</label>
                <input type="text" id="fname" name="fname" value="<?= htmlspecialchars($fname) ?>">
                <?php if ($fnameErr): ?>
                    <span class="error">
                        <?= htmlspecialchars($fnameErr) ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>">
                <?php if ($emailErr): ?>
                    <span class="error">
                        <?= htmlspecialchars($emailErr) ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="field">
                <label for="phone">Phone</label>
                <input type="number" id="phone" name="phone" value="<?= htmlspecialchars($phone) ?>">
                <?php if ($phoneErr): ?>
                    <span class="error">
                        <?= htmlspecialchars($phoneErr) ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="field">
                <label for="address">Address</label>
                <textarea id="address" name="address" rows="3" cols="48"><?= htmlspecialchars($address) ?></textarea>
                <?php if ($addressErr): ?>
                    <span class="error">
                        <?= htmlspecialchars($addressErr) ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="buttons">
                <button type="submit" class="btn-primary">Update Profile</button>
            </div>
        </form>
    </div>

    <footer>
        <p>© 2026 Emergency Finder - Citizen Portal.</p>
    </footer>
</body>
</html>