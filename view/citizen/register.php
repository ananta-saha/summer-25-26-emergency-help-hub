<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Citizen Registration - Emergency Help Hub</title>

    <link rel="stylesheet" href="../../assets/css/citizen.css?v=2">
</head>

<body>
    <header class="navbar">
        <h2>🚑 Emergency Finder</h2>
        <nav>
            <a href="../../controller/citizen/index.php">Home</a>
            <a href="../../controller/citizen/login.php">Login</a>
        </nav>
    </header>

    <div class="main-container">
        <form class="card" method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate>
            <h1>Create Account</h1>
            <p>Register as a citizen to access emergency services</p>
            <?php if ($dbErr): ?>
                <span class="error">
                    <?= htmlspecialchars($dbErr) ?>
                </span>
            <?php endif; ?>

            <div class="field">
                <label for="fname">Full Name</label>
                <input type="text" id="fname" name="fname" placeholder="Enter your full name" value="<?= $fname ?>">
                <?php if ($fnameErr): ?>
                    <span class="error">
                        <?= htmlspecialchars($fnameErr) ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" value="<?= $email ?>">
                <?php if ($emailErr): ?>
                    <span class="error">
                        <?= htmlspecialchars($emailErr) ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="field">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" inputmode="numeric" placeholder="Enter your 11 digit phone number" value="<?= $phone ?>">
                <?php if ($phoneErr): ?>
                    <span class="error">
                        <?= htmlspecialchars($phoneErr) ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="field">
                <label for="pass">Password</label>
                <input type="password" id="pass" name="pass" placeholder="Create a password">
                <?php if ($passErr): ?>
                    <span class="error">
                        <?= htmlspecialchars($passErr) ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="field">
                <label for="cpass">Confirm Password</label>
                <input type="password" id="cpass" name="cpass" placeholder="Confirm your password">
                <?php if ($cpassErr): ?>
                    <span class="error">
                        <?= htmlspecialchars($cpassErr) ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="field">
                <label for="address">Address</label>
                <textarea id="address" name="address" rows="4" cols="47" placeholder="Enter your full address"><?= $address ?></textarea>
                <?php if ($addressErr): ?>
                    <span class="error">
                        <?= htmlspecialchars($addressErr) ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="buttons">
                <button type="submit" class="btn-primary">Create Account</button>
            </div>

            <p class="auth-footer">
                Already have a citizen account?
                <a href="../../controller/citizen/login.php">Login </a>
            </p>
        </form>

        <?php if ($isValid): ?>
            <section class="card summary">
                <h2>Registration Successful</h2>
                <p>Your citizen account has been created successfully.</p>
                <table class="result-table">
                    <tr>
                        <td>Full Name</td>
                        <td><?= $fname ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?= $email ?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><?= $phone ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?= $address ?></td>
                    </tr>
                </table>
                <div class="buttons">
                    <a href="../../controller/citizen/login.php">
                        <button type="button" class="btn-primary">Go to Login</button>
                    </a>
                </div>
            </section>
        <?php endif; ?>
    </div>

    <footer>
        <p>
            © 2026 Emergency Finder - Citizen Portal.
        </p>
    </footer>
</body>
</html>