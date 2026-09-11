<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Citizen Login - Emergency Help Hub</title>

    <link rel="stylesheet" href="../../assets/css/citizen.css">
</head>

<body>
    <header class="navbar">
        <h2>🚑 Emergency Finder</h2>
        <nav>
            <a href="index.php">Home</a>
            <a href="register.php">Register</a>
        </nav>
    </header>

    <div class="main-container">
        <form method="post"
              action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate>
            <h1>Welcome Back</h1>
            <p>Login to your Citizen account</p>
            <?php if ($loginErr): ?><span class="error"><?= $loginErr ?></span><?php endif; ?>

            <div class="field">
                <label for="email">Email or Phone</label>
                <input type="text" id="email" name="email" placeholder="Enter your email or phone" value="<?= $email ?>">
                <?php if ($emailErr): ?><span class="error"><?= $emailErr ?></span> <?php endif; ?>
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password">
                <?php if ($passwordErr): ?><span class="error"><?= $passwordErr ?></span><?php endif; ?>
            </div>
            <?php if ($dbErr): ?><span class="error"><?= $dbErr ?></span><?php endif; ?>

            <div class="buttons">
                <button type="submit" class="btn-primary">Login</button>
            </div>

            <p class="auth-footer">Don't have an account?
                <a href="register.php">Create Account</a>
            </p>
        </form>
    </div>

    <footer>
        <p> © 2026 Emergency Finder - Citizen Portal.</p>
    </footer>
</body>
</html>