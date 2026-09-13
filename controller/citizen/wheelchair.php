<?php

session_start();

require_once __DIR__ . "/../../model/citizen/CitizenModel.php";


if(!isset($_SESSION["citizen_id"]))
{
    header("Location: ../auth/login.php");
    exit();
}


/*
|--------------------------------------------------------------------------
| Check if coming from Emergency Request
|--------------------------------------------------------------------------
*/

$fromEmergency = isset($_SESSION["emergency_request"]);



$wheelchair = "No";
$wheelchairNumber = 0;
$error = "";



if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $wheelchair = $_POST["wheelchair"] ?? "No";

    $wheelchairNumber = $_POST["wheelchairNumber"] ?? 0;



    if($wheelchair == "Yes")
    {

        if($wheelchairNumber == "" || $wheelchairNumber < 1)
        {
            $error = "Please enter the number of wheelchairs.";
        }

        else
        {

            $_SESSION["wheelchair"] = "Yes";

            $_SESSION["wheelchairNumber"] = $wheelchairNumber;



            if($fromEmergency)
            {
                // Continue emergency request process
                header("Location: injury.php");
            }
            else
            {
                // Direct wheelchair dashboard
                header("Location: wheelchair-dashboard.php");
            }

            exit();

        }

    }


    else
    {

        $_SESSION["wheelchair"] = "No";

        $_SESSION["wheelchairNumber"] = 0;



        if($fromEmergency)
        {
            header("Location: injury.php");
        }
        else
        {
            header("Location: wheelchair-dashboard.php");
        }


        exit();

    }

}



require_once __DIR__ . "/../../view/citizen/wheelchair.php";

?>