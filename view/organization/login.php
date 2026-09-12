<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Organization Login</title>

</head>


<body>


<h2>
    Organization Login
</h2>


<?php if (!empty($loginErr)): ?>

    <p>
        <?php echo htmlspecialchars($loginErr); ?>
    </p>

<?php endif; ?>


<form method="POST">


    <!-- EMAIL -->

    <div>

        <label>
            Organization Email
        </label>

        <br>

        <input
            type="email"
            name="email"
            value="<?php echo htmlspecialchars($email); ?>"
        >

        <br>

        <?php if (!empty($emailErr)): ?>

            <small>
                <?php echo htmlspecialchars($emailErr); ?>
            </small>

        <?php endif; ?>

    </div>


    <br>


    <!-- PASSWORD -->

    <div>

        <label>
            Password
        </label>

        <br>

        <input
            type="password"
            name="password"
        >

        <br>

        <?php if (!empty($passwordErr)): ?>

            <small>
                <?php echo htmlspecialchars($passwordErr); ?>
            </small>

        <?php endif; ?>

    </div>


    <br>


    <button type="submit">

        Login

    </button>


</form>


</body>

</html>