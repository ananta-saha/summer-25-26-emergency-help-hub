<?php

require_once __DIR__ . "/../../model/citizen/CitizenModel.php";


$fnameErr = $emailErr = $phoneErr = $passErr = $cpassErr = $addressErr = "";
$dbErr = "";

$fname = $email = $phone = $address = $password = $confirmPassword = "";
$isValid = false;

function cleanInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["fname"])) {
        $fnameErr = "Enter your full name";
    } else {
        $fname = cleanInput($_POST["fname"]);
        if (!preg_match("/^[a-zA-Z-' ]+$/", $fname)) {
            $fnameErr ="Use letters, spaces, hyphens and apostrophes only";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Enter your email address";
    } else {
        $email = cleanInput($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Enter a valid email address";
        }
    }

    if (empty($_POST["phone"])) {
        $phoneErr = "Enter your phone number";
    } else {
        $phone = cleanInput($_POST["phone"]);
        if (!preg_match("/^01[0-9]{9}$/", $phone)) {
            $phoneErr = "Enter a valid 11 digit phone number";
        }
    }

    if (empty($_POST["pass"])) {
        $passErr = "Enter a password";
    } else {
        $password = $_POST["pass"];
        if (strlen($password) < 8) {
            $passErr ="Password must be at least 8 characters";
        } elseif ( !preg_match("/[A-Za-z]/", $password) || !preg_match("/[0-9]/", $password)) {
            $passErr ="Password must contain at least one letter and one number";
        }
    }

    if (empty($_POST["cpass"])) {
        $cpassErr = "Confirm your password";
    } else {
        $confirmPassword = $_POST["cpass"];
        if ($password !== $confirmPassword) {
            $cpassErr = "Passwords do not match";
        }
    }

    if (empty($_POST["address"])) {
        $addressErr = "Enter your full address";
    } else {
        $address = cleanInput($_POST["address"]);
        if (strlen($address) < 8) {
            $addressErr = "Address must be at least 5 characters";
        }
    }

    $isValid = !$fnameErr && !$emailErr && !$phoneErr && !$passErr && !$cpassErr && !$addressErr;

    if ($isValid) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        if (checkCitizenExists($email, $phone)) {
            $dbErr = "Email or phone number is already registered.";
            $isValid = false;
        } else {
            $result = saveCitizen(
                $fname,
                $email,
                $phone,
                $passwordHash,
                $address
            );

            if (!$result["success"]) {
                $dbErr ="Could not save registration: " . $result["error"];
                $isValid = false;
            }
        }
    }
}

require_once __DIR__ . "/../../view/citizen/register.php";
?>