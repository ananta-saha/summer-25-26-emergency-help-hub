<?php

require_once __DIR__
    . "/../../model/organization/OrganizationModel.php";


$nameErr = "";
$emailErr = "";
$phoneErr = "";
$usernameErr = "";
$passwordErr = "";
$confirmPasswordErr = "";
$addressErr = "";
$dbErr = "";

$name = "";
$email = "";
$phone = "";
$username = "";
$address = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /* NAME */

    if (empty($_POST["name"])) {

        $nameErr = "Enter organization name.";

    } else {

        $name = trim($_POST["name"]);

    }


    /* EMAIL */

    if (empty($_POST["email"])) {

        $emailErr = "Enter email address.";

    } else {

        $email = trim($_POST["email"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $emailErr = "Enter a valid email address.";

        }
    }


    /* PHONE */

    if (empty($_POST["phone"])) {

        $phoneErr = "Enter phone number.";

    } else {

        $phone = trim($_POST["phone"]);

        if (!preg_match("/^01[0-9]{9}$/", $phone)) {

            $phoneErr =
                "Enter a valid 11 digit phone number.";

        }
    }


    /* USERNAME */

    if (empty($_POST["username"])) {

        $usernameErr = "Enter username.";

    } else {

        $username = trim($_POST["username"]);

        if (
            !preg_match(
                "/^[A-Za-z0-9_]{4,20}$/",
                $username
            )
        ) {

            $usernameErr =
                "Username must be 4-20 characters.";

        }
    }


    /* PASSWORD */

    $password = $_POST["password"] ?? "";

    if (empty($password)) {

        $passwordErr = "Enter password.";

    } elseif (strlen($password) < 6) {

        $passwordErr =
            "Password must be at least 6 characters.";

    }


    /* CONFIRM PASSWORD */

    $confirmPassword =
        $_POST["confirm_password"] ?? "";


    if (empty($confirmPassword)) {

        $confirmPasswordErr =
            "Confirm your password.";

    } elseif ($password !== $confirmPassword) {

        $confirmPasswordErr =
            "Passwords do not match.";

    }


    /* ADDRESS */

    if (empty($_POST["address"])) {

        $addressErr = "Enter address.";

    } else {

        $address = trim($_POST["address"]);

    }


    /* FINAL VALIDATION */

    $isValid =
        empty($nameErr) &&
        empty($emailErr) &&
        empty($phoneErr) &&
        empty($usernameErr) &&
        empty($passwordErr) &&
        empty($confirmPasswordErr) &&
        empty($addressErr);


    if ($isValid) {

        if (
            organizationExists(
                $email,
                $username
            )
        ) {

            $dbErr =
                "Email or username already exists.";

        } else {

            $passwordHash =
                password_hash(
                    $password,
                    PASSWORD_DEFAULT
                );


            $result =
                registerOrganization(
                    $name,
                    $email,
                    $username,
                    $passwordHash,
                    $phone,
                    $address
                );


            if ($result["success"]) {

                header(
                    "Location: login.php?registered=1"
                );

                exit();

            } else {

                $dbErr =
                    "Registration failed: "
                    . $result["error"];
            }
        }
    }
}


require_once __DIR__
    . "/../../view/organization/register.php";

?>