<?php

session_start();

require_once __DIR__ . "/../../model/citizen/CitizenModel.php";



if(!isset($_SESSION["citizen_id"]))
{
    header("Location: ../auth/login.php");
    exit();
}



if(!isset($_SESSION["emergency_request"]))
{
    header("Location: emergency-request.php");
    exit();
}


$error = "";

$injury = "No";
$injuryLevel = "";
$injuryDescription = "";


<<<<<<< HEAD


=======
>>>>>>> origin/main
if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $injury = $_POST["injury"] ?? "No";

    $injuryLevel = $_POST["injuryLevel"] ?? "";

    $injuryDescription = $_POST["injuryDescription"] ?? "";


    $request = $_SESSION["emergency_request"];


    /*
        If injury is Yes, injury level is required
    */


    if($injury == "Yes" && $injuryLevel == "")
    {

<<<<<<< HEAD
        $error = "Please select injury level.";

    }

    else
    {


        /*
        |--------------------------------------------------------------------------
        | Wheelchair Information
        |--------------------------------------------------------------------------
        */


=======
    else
    {

>>>>>>> origin/main
        $wheelchairRequired = 0;

        $wheelchairCount = 0;


        if(
            isset($_SESSION["wheelchair"]) &&
            $_SESSION["wheelchair"] == "Yes"
        )
        {

            $wheelchairRequired = 1;

            $wheelchairCount = $_SESSION["wheelchairNumber"];

        }


<<<<<<< HEAD


=======
        $injuryPresent = 0;
>>>>>>> origin/main

        /*
        |--------------------------------------------------------------------------
        | Injury Information
        |--------------------------------------------------------------------------
        */


        $injuryPresent = 0;

        if($injury == "Yes")
        {
            $injuryPresent = 1;
        }


<<<<<<< HEAD



=======
>>>>>>> origin/main
        /*
        |--------------------------------------------------------------------------
        | Save Emergency Request
        |--------------------------------------------------------------------------
        */

<<<<<<< HEAD

        $saveResult = saveEmergencyRequest(
=======
        $saveSuccess = false;
>>>>>>> origin/main

            $_SESSION["citizen_id"],

            $request["provider_id"],

            $request["service_type"],

            $request["emergency_type"],

            $request["people_count"],

            $request["vehicles_requested"],

            $request["location"],

            $request["latitude"],

            $request["longitude"],

            $request["details"],

            $wheelchairRequired,

            $wheelchairCount,

            $injuryPresent,

            $injuryLevel,

            $injuryDescription

        );


<<<<<<< HEAD




        if($saveResult["success"])
        {


            $_SESSION["request_id"] = $saveResult["request_id"];
=======
        foreach($request["providers"] ?? [] as $provider)
        {

            $saveResult = saveEmergencyRequest(

                $_SESSION["citizen_id"],

                $provider["provider_id"],

                $request["service_type"],

                $request["emergency_type"],

                $request["people_count"],

                $request["vehicles_requested"],

                $request["location"],

                $request["latitude"],

                $request["longitude"],

                $request["details"],

                $wheelchairRequired,

                $wheelchairCount,

                $injuryPresent,

                $injuryLevel,

                $injuryDescription

            );


            if($saveResult["success"])
            {

                $saveSuccess = true;


                if($firstRequestId == null)
                {
                    $firstRequestId = $saveResult["request_id"];
                }

            }

        }


        if($saveSuccess)
        {

            $_SESSION["request_id"] = $firstRequestId;
>>>>>>> origin/main


            unset($_SESSION["emergency_request"]);

            unset($_SESSION["wheelchair"]);

            unset($_SESSION["wheelchairNumber"]);


<<<<<<< HEAD



=======
>>>>>>> origin/main
            header("Location: request-status.php");

            exit();


<<<<<<< HEAD
        }

=======
>>>>>>> origin/main
        else
        {

            $error = $saveResult["error"];

        }



    }

}


<<<<<<< HEAD



=======
>>>>>>> origin/main
require_once __DIR__ . "/../../view/citizen/injury.php";


?>