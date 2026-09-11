<?php

session_start();

require_once __DIR__ . "/../../model/citizen/CitizenModel.php";


if (!isset($_SESSION["citizen_id"])) {
    header("Location: login.php");
    exit();
}
if (!isset($_SESSION["emergency_request"])) {
    header("Location: emergency-request.php");
    exit();
}


$injury = "No";
$injuryLevel = $injuryDescription = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $injury = isset($_POST["injury"])
        ? trim($_POST["injury"])
        : "No";

    $injuryLevel = isset($_POST["injuryLevel"])
        ? trim($_POST["injuryLevel"])
        : "";

    $injuryDescription = isset($_POST["injuryDescription"])
        ? trim($_POST["injuryDescription"])
        : "";

    if ($injury == "Yes") {
        if ($injuryLevel == "") {
            $error = "Please select the injury level.";
        } else {
            $_SESSION["injury"] = "Yes";
            $_SESSION["injuryLevel"] = $injuryLevel;
            $_SESSION["injuryDescription"] = $injuryDescription;

            $request = $_SESSION["emergency_request"];
            $wheelchair = isset($_SESSION["wheelchair"])
                ? $_SESSION["wheelchair"]
                : "No";

            $wheelchairNumber = isset($_SESSION["wheelchairNumber"])
                ? $_SESSION["wheelchairNumber"]
                : 0;

            $saveResult = saveEmergencyRequest(
                $_SESSION["citizen_id"],
                $request["provider_id"],
                $request["emService"],
                $request["emergencyType"],
                $request["people"],
                $request["vehicles"],
                $request["emergencyLocation"],
                $request["details"],
                $wheelchair,
                $wheelchairNumber,
                "Yes",
                $injuryLevel,
                $injuryDescription
            );

            if ($saveResult["success"]) {
                $_SESSION["request_id"] = $saveResult["request_id"];
                header("Location: request-status.php");
                exit();
            } else {
                $error = $saveResult["error"];
            }
        }
    } else {
        $_SESSION["injury"] = "No";
        $_SESSION["injuryLevel"] = "";
        $_SESSION["injuryDescription"] = "";
        $request = $_SESSION["emergency_request"];

        $wheelchair = isset($_SESSION["wheelchair"])
            ? $_SESSION["wheelchair"]
            : "No";

        $wheelchairNumber = isset($_SESSION["wheelchairNumber"])
            ? $_SESSION["wheelchairNumber"]
            : 0;

        $saveResult = saveEmergencyRequest(
            $_SESSION["citizen_id"],
            $request["provider_id"],
            $request["emService"],
            $request["emergencyType"],
            $request["people"],
            $request["vehicles"],
            $request["emergencyLocation"],
            $request["details"],
            $wheelchair,
            $wheelchairNumber,
            "No",
            "",
            ""
        );

        if ($saveResult["success"]) {
            $_SESSION["request_id"] = $saveResult["request_id"];
            header("Location: request-status.php");
            exit();
        } else {
            $error = $saveResult["error"];
        }
    }
}

require_once __DIR__ . "/../../view/citizen/injury.php";
?>