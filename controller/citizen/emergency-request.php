<?php

session_start();

require_once __DIR__ . "/../../model/citizen/CitizenModel.php";


if(!isset($_SESSION["citizen_id"]))
{
    header("Location: login.php");
    exit();
}


$emService = "";
$emergencyType = "";
$people = "";
$vehicles = "";
$emergencyLocation = "";
$details = "";

$latitude = "";
$longitude = "";

$error = "";



if(isset($_GET["service"]))
{
    $emService = trim($_GET["service"]);
}



if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $emService = trim($_POST["emService"] ?? "");

    $emergencyType = trim($_POST["emergencyType"] ?? "");

    $people = trim($_POST["people"] ?? "");

    $vehicles = trim($_POST["vehicles"] ?? "");

    $emergencyLocation = trim($_POST["emergencyLocation"] ?? "");

    $details = trim($_POST["details"] ?? "");


    $latitude = trim($_POST["latitude"] ?? "");

    $longitude = trim($_POST["longitude"] ?? "");



    if($emService == "")
    {
        $error = "Please select an emergency service.";
    }

    elseif($emergencyType == "")
    {
        $error = "Please select emergency type.";
    }

    elseif($people < 1)
    {
        $error = "Invalid number of people.";
    }

    elseif($vehicles < 1)
    {
        $error = "Invalid number of vehicles.";
    }

    elseif($emergencyLocation == "")
    {
        $error = "Please enter emergency location.";
    }

    elseif($latitude == "" || $longitude == "")
    {
        $error = "Please allow location access.";
    }


    else
    {


        /*
        Find ALL available providers
        */

        $providers = findAvailableProviders(
            $emService,
            $latitude,
            $longitude
        );



        if(count($providers)==0)
        {
            $error = "No available provider found within your area.";
        }


        else
        {


            /*
            Save provider IDs temporarily
            */

            $_SESSION["emergency_request"] = [

                "providers" => $providers,

                "service_type" => $emService,

                "emergency_type" => $emergencyType,

                "people_count" => $people,

                "vehicles_requested" => $vehicles,

                "location" => $emergencyLocation,

                "latitude" => $latitude,

                "longitude" => $longitude,

                "details" => $details,


                "wheelchair_required" => 0,

                "wheelchair_count" => 0,


                "injury_present" => 0,

                "injury_level" => "",

                "injury_description" => ""

            ];



            header("Location: wheelchair.php");

            exit();

        }

    }

}



require_once __DIR__ . "/../../view/citizen/emergency-request.php";

?>