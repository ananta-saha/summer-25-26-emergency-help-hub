<?php

session_start();

require_once __DIR__ . "/../../model/citizen/CitizenModel.php";

$location = $serviceType = "";
$services = array();
$searched = false;
$dbErr = "";

if (!isset($_SESSION["citizen_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searched = true;

    if (isset($_POST["location"])) {
        $location = trim($_POST["location"]);
    }
    if (isset($_POST["serviceType"])) {
        $serviceType = trim($_POST["serviceType"]);
    }
    if ($location == "") {
        $dbErr = "Please enter your location.";
    }elseif ($serviceType == "") {
        $dbErr = "Please select a service.";
    }else {
        $searchResult = searchEmergencyServices($serviceType, $location);
        if ($searchResult["success"]) {
            $services = $searchResult["services"];
        } else {
            $dbErr = $searchResult["error"];
        }
    }
}
require_once __DIR__ . "/../../view/citizen/services.php";
?>