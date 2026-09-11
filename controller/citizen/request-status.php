<?php

session_start();

require_once __DIR__ . "/../../model/citizen/CitizenModel.php";

if (!isset($_SESSION["citizen_id"])) {
    header("Location: login.php");
    exit();
}

if (
    $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cancel"])
) {

    if (isset($_SESSION["request_id"])) {
        $requestId = (int) $_SESSION["request_id"];
        cancelEmergencyRequest($requestId, $_SESSION["citizen_id"]);
        unset($_SESSION["request_id"]);
    }
    unset($_SESSION["emergency_request"]);
    unset($_SESSION["wheelchair"]);
    unset($_SESSION["wheelchairNumber"]);
    unset($_SESSION["injury"]);
    unset($_SESSION["injuryLevel"]);
    unset($_SESSION["injuryDescription"]);
    header("Location: request-status.php");
    exit();
}

$request = null;
if (isset($_SESSION["request_id"])) {
    $requestId = (int) $_SESSION["request_id"];
    $request = getCitizenEmergencyRequest($requestId, $_SESSION["citizen_id"]
    );
}

require_once __DIR__ . "/../../view/citizen/request-status.php";
?>