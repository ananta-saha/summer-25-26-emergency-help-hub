<?php

session_start();

require_once __DIR__ . "/../../config/db.php";


$emailErr = "";
$passwordErr = "";
$loginErr = "";

$email = "";


/* =========================================
   ORGANIZATION LOGIN
========================================= */

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /* EMAIL VALIDATION */

    if (empty($_POST["email"])) {

        $emailErr = "Enter organization email.";

    } else {

        $email = trim($_POST["email"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $emailErr = "Enter a valid email address.";
        }
    }


    /* PASSWORD VALIDATION */

    if (empty($_POST["password"])) {

        $passwordErr = "Enter password.";

    } else {

        $password = $_POST["password"];
    }


    /* LOGIN */

    if (
        empty($emailErr) &&
        empty($passwordErr)
    ) {

        $stmt = mysqli_prepare(
            $conn,
            "SELECT *
             FROM organizations
             WHERE email = ?
             AND status = 'Active'
             LIMIT 1"
        );


        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $email
        );


        mysqli_stmt_execute($stmt);


        $result =
            mysqli_stmt_get_result($stmt);


        $organization =
            mysqli_fetch_assoc($result);


        mysqli_stmt_close($stmt);


        if (!$organization) {

            $loginErr =
                "Organization account not found or inactive.";

        } elseif (
            password_verify(
                $password,
                $organization["password"]
            )
        ) {

            session_regenerate_id(true);


            $_SESSION["organization_id"] =
                (int) $organization["organization_id"];


            $_SESSION["organization_name"] =
                $organization["organization_name"];


            $_SESSION["organization_email"] =
                $organization["email"];


            header(
                "Location: dashboard.php"
            );

            exit();

        } else {

            $loginErr =
                "Incorrect password.";
        }
    }
}


/* =========================================
   LOAD LOGIN VIEW
========================================= */

require_once __DIR__
    . "/../../view/organization/login.php";

?>