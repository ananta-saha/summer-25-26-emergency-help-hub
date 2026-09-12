<?php

session_start();

require_once __DIR__ . "/../../model/citizen/CitizenModel.php";


$location = "";
$serviceType = "";
$latitude = "";
$longitude = "";

$services = [];
$searched = false;
$dbErr = "";


if (!isset($_SESSION["citizen_id"])) {
    header("Location: login.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $searched = true;

    $location = isset($_POST["location"])
        ? trim($_POST["location"])
        : "";

    $serviceType = isset($_POST["serviceType"])
        ? trim($_POST["serviceType"])
        : "";

    $latitude = isset($_POST["latitude"])
        ? trim($_POST["latitude"])
        : "";

    $longitude = isset($_POST["longitude"])
        ? trim($_POST["longitude"])
        : "";


    if ($latitude == "" || $longitude == "") {

        $dbErr = "Please allow GPS location.";

    } elseif ($serviceType == "") {

        $dbErr = "Please select a service.";

    } else {

        $searchResult = searchEmergencyServices(
            $serviceType,
            $latitude,
            $longitude
        );


        if ($searchResult["success"]) {

            $services = $searchResult["services"];

        } else {

            $dbErr = $searchResult["error"];

        }

    }
}


require_once __DIR__ . "/../../view/citizen/services.php";

?>