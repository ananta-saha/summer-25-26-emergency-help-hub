<?php

session_start();

require_once __DIR__ . "/../../model/citizen/CitizenModel.php";

$fnameErr = $emailErr = $phoneErr = $addressErr = "";

$dbErr = "";
$successMsg = "";
$fname = $email = $phone = $address = "";

if (!isset($_SESSION["citizen_id"])) {
    header("Location: login.php");
    exit();
}

$citizenId = $_SESSION["citizen_id"];

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
            $fnameErr = "Use letters, spaces, hyphens and apostrophes only";
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

    if (empty($_POST["address"])) {
        $addressErr = "Enter your full address";
    } else {
        $address = cleanInput($_POST["address"]);
        if (strlen($address) < 8) {
            $addressErr = "Address must be at least 8 characters";
        }
    }

    $isValid = !$fnameErr && !$emailErr && !$phoneErr && !$addressErr;

    if ($isValid) {
        $updateResult = updateCitizenProfile(
            $citizenId,
            $fname,
            $email,
            $phone,
            $address
        );

        if ($updateResult["success"]) {
            $successMsg = "Profile updated successfully.";
            $_SESSION["citizen_name"] = $fname;
            $_SESSION["citizen_email"] = $email;
        } else {
            $dbErr = $updateResult["error"];
        }
    }
}

$citizen = findCitizenProfile($citizenId);
if ($citizen) {
    $fname = $citizen["name"];
    $email = $citizen["email"];
    $phone = $citizen["phone"];
    $address = $citizen["address"];
} else {
    $dbErr = "Citizen profile not found.";
}

require_once __DIR__ . "/../../view/citizen/profile.php";
?>