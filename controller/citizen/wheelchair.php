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


            header("Location: injury.php");

            exit();

        }

    }


    else
    {

        $_SESSION["wheelchair"] = "No";

        $_SESSION["wheelchairNumber"] = 0;


        header("Location: injury.php");

        exit();

    }

}


require_once __DIR__ . "/../../view/citizen/wheelchair.php";

?>