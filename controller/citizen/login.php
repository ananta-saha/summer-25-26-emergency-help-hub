<?php

session_start();

require_once __DIR__ . "/../../model/citizen/CitizenModel.php";

$emailErr = $passwordErr = $loginErr = "";
$dbErr = "";

$email = $password = "";
function cleanInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "Enter your email or phone";
    } else {
        $email = cleanInput($_POST["email"]);
        if ( !filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^01[0-9]{9}$/", $email)) {
            $emailErr = "Enter a valid email or 11 digit phone number";
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Enter your password";
    } else {
        $password = $_POST["password"];
        if (strlen($password) < 8) {
            $passwordErr = "Password must be at least 8 characters";
        } elseif ( !preg_match("/[A-Za-z]/", $password) || !preg_match("/[0-9]/", $password)) {
            $passwordErr ="Password must contain at least one letter and one number";
        }
    }

    $isValid = !$emailErr && !$passwordErr;
    if ($isValid) {
        try {
            $user = findCitizenByEmailOrPhone($email);
            if (!$user) {
                $loginErr = "You are not registered. Please register first.";
            } elseif ($user["status"] != "Active") {
                $loginErr = "Your account is inactive. Please contact the administrator.";
            } elseif (password_verify($password, $user["password"])) {
                $_SESSION["citizen_id"] = $user["citizen_id"];
                $_SESSION["citizen_name"] = $user["name"];
                $_SESSION["citizen_email"] = $user["email"];

                header("Location: dashboard.php");
                exit();
            } else {
                $loginErr = "Incorrect password.";
            }
        } catch (Exception $e) {
            $dbErr = "Could not process login.";
        }
    }
}

require_once __DIR__ . "/../../view/citizen/login.php";
?>