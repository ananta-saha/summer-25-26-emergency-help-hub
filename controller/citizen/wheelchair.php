<?php

session_start();

if (!isset($_SESSION["citizen_id"])) {
    header("Location: login.php");
    exit();
}

$wheelchair = "No";
$wheelchairNumber = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["wheelchair"])) {
        $wheelchair = $_POST["wheelchair"];
    }
    if (isset($_POST["wheelchairNumber"])) {
        $wheelchairNumber = trim($_POST["wheelchairNumber"]);
    }
    if ($wheelchair == "Yes") {
        if ($wheelchairNumber == "" || $wheelchairNumber < 1) {
            $error = "Please enter the number of wheelchairs.";
        } else {
            $_SESSION["wheelchair"] = "Yes";
            $_SESSION["wheelchairNumber"] = $wheelchairNumber;
            header("Location: injury.php");
            exit();
        }
    } else {
        $_SESSION["wheelchair"] = "No";
        $_SESSION["wheelchairNumber"] = 0;
        header("Location: injury.php");
        exit();
    }
}

require_once __DIR__ . "/../../view/citizen/wheelchair.php";

?>