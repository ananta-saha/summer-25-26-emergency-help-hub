<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Organization Registration
    </title>

</head>


<body>


<h1>
    Organization Registration
</h1>


<?php if (!empty($dbErr)): ?>

    <p>
        <?php
        echo htmlspecialchars($dbErr);
        ?>
    </p>

<?php endif; ?>


<form method="POST">


    <!-- ORGANIZATION NAME -->

    <label>
        Organization Name
    </label>

    <br>

    <input
        type="text"
        name="name"
        value="<?php echo htmlspecialchars($name); ?>"
    >

    <br>

    <small>
        <?php echo $nameErr; ?>
    </small>

    <br><br>


    <!-- EMAIL -->

    <label>
        Email
    </label>

    <br>

    <input
        type="email"
        name="email"
        value="<?php echo htmlspecialchars($email); ?>"
    >

    <br>

    <small>
        <?php echo $emailErr; ?>
    </small>

    <br><br>


    <!-- PHONE -->

    <label>
        Phone
    </label>

    <br>

    <input
        type="text"
        name="phone"
        value="<?php echo htmlspecialchars($phone); ?>"
    >

    <br>

    <small>
        <?php echo $phoneErr; ?>
    </small>

    <br><br>


    <!-- USERNAME -->

    <label>
        Username
    </label>

    <br>

    <input
        type="text"
        name="username"
        value="<?php echo htmlspecialchars($username); ?>"
    >

    <br>

    <small>
        <?php echo $usernameErr; ?>
    </small>

    <br><br>


    <!-- ADDRESS -->

    <label>
        Address
    </label>

    <br>

    <textarea
        name="address"
    ><?php echo htmlspecialchars($address); ?></textarea>

    <br>

    <small>
        <?php echo $addressErr; ?>
    </small>

    <br><br>


    <!-- PASSWORD -->

    <label>
        Password
    </label>

    <br>

    <input
        type="password"
        name="password"
    >

    <br>

    <small>
        <?php echo $passwordErr; ?>
    </small>

    <br><br>


    <!-- CONFIRM PASSWORD -->

    <label>
        Confirm Password
    </label>

    <br>

    <input
        type="password"
        name="confirm_password"
    >

    <br>

    <small>
        <?php echo $confirmPasswordErr; ?>
    </small>

    <br><br>


    <button type="submit">

        Register Organization

    </button>


</form>


<br>


<p>

    Already registered?

    <a href="login.php">
        Login
    </a>

</p>


</body>

</html>