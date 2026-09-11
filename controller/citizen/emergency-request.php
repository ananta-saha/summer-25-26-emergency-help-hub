<?php
session_start();
require_once __DIR__ . "/../../model/citizen/CitizenModel.php";

if (!isset($_SESSION["citizen_id"])) {
    header("Location: login.php");
    exit();
}

$emService = "";
$providerId = 0;

if (isset($_GET["service"])) {
    $emService = trim($_GET["service"]);
}

if (isset($_GET["provider_id"])) {
    $providerId = (int) $_GET["provider_id"];
}

$emergencyType = $people = $vehicles = $emergencyLocation = $details = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $providerId = isset($_POST["provider_id"])
        ? (int) $_POST["provider_id"]: 0;

    $emService = isset($_POST["emService"])
        ? trim($_POST["emService"])
        : "";

    $emergencyType = isset($_POST["emergencyType"])
        ? trim($_POST["emergencyType"])
        : "";

    $people = isset($_POST["people"])
        ? trim($_POST["people"])
        : "";

    $vehicles = isset($_POST["vehicles"])
        ? trim($_POST["vehicles"])
        : "";

    $emergencyLocation = isset($_POST["emergencyLocation"])
        ? trim($_POST["emergencyLocation"])
        : "";

    $details = isset($_POST["details"])
        ? trim($_POST["details"])
        : "";

    if ($providerId <= 0) {
        $error = "Invalid service provider.";
    } elseif ($emService == "") {
        $error = "Please select an emergency service.";
    } elseif ($emergencyType == "") {
        $error = "Please select an emergency type.";
    } elseif ($people == "" || $people < 1) {
        $error = "Please enter the number of people.";
    } elseif ($vehicles == "" || $vehicles < 1) {
        $error = "Please enter the number of vehicles.";
    } elseif ($emergencyLocation == "") {
        $error = "Please enter the emergency location.";
    } else {

        $_SESSION["emergency_request"] = [
            "provider_id" => $providerId,
            "emService" => $emService,
            "emergencyType" => $emergencyType,
            "people" => $people,
            "vehicles" => $vehicles,
            "emergencyLocation" => $emergencyLocation,
            "details" => $details
        ];

        header("Location: wheelchair.php");
        exit();
    }
}

require_once __DIR__ . "/../../view/citizen/emergency-request.php";
?>