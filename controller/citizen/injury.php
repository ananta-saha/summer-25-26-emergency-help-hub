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



if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $injury = $_POST["injury"] ?? "No";

    $injuryLevel = $_POST["injuryLevel"] ?? "";

    $injuryDescription = $_POST["injuryDescription"] ?? "";



    $request = $_SESSION["emergency_request"];



    if($injury == "Yes" && $injuryLevel == "")
    {
        $error = "Please select injury level.";
    }


    else
    {


        $wheelchairRequired = 0;

        $wheelchairCount = 0;



        if(
            isset($_SESSION["wheelchair"]) 
            && 
            $_SESSION["wheelchair"] == "Yes"
        )
        {

            $wheelchairRequired = 1;

            $wheelchairCount = $_SESSION["wheelchairNumber"];

        }




        $injuryPresent = 0;



        if($injury == "Yes")
        {

            $injuryPresent = 1;

        }




        /*
            Save request for all available providers
        */


        $saveSuccess = false;

        $firstRequestId = null;



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



            unset($_SESSION["emergency_request"]);

            unset($_SESSION["wheelchair"]);

            unset($_SESSION["wheelchairNumber"]);




            header("Location: request-status.php");

            exit();

        }


        else
        {

            $error = "Failed to create emergency request.";

        }

    }

}



require_once __DIR__ . "/../../view/citizen/injury.php";


?>