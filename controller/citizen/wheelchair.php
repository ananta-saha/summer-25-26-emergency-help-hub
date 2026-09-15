<?php

session_start();

require_once __DIR__ . "/../../model/citizen/CitizenModel.php";


<<<<<<< HEAD
/*
|--------------------------------------------------------------------------
| Check Citizen Login
|--------------------------------------------------------------------------
*/

if(!isset($_SESSION["citizen_id"]))
{
    header("Location: /summer-25-26-emergency-help-hub/controller/auth/login.php");
    exit();
}

=======
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
>>>>>>> origin/main


$wheelchair = "No";
$wheelchairNumber = 0;
$error = "";


<<<<<<< HEAD

/*
|--------------------------------------------------------------------------
| Handle Submit
|--------------------------------------------------------------------------
*/

=======
>>>>>>> origin/main
if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $wheelchair = $_POST["wheelchair"] ?? "No";

    $wheelchairNumber = $_POST["wheelchairNumber"] ?? 0;


<<<<<<< HEAD

    /*
    |--------------------------------------------------------------------------
    | Yes
    |--------------------------------------------------------------------------
    */

=======
>>>>>>> origin/main
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


<<<<<<< HEAD
            header(
                "Location: /summer-25-26-emergency-help-hub/controller/citizen/injury.php"
            );
=======
            header("Location: injury.php");
>>>>>>> origin/main

            exit();

        }

    }



    /*
    |--------------------------------------------------------------------------
    | No
    |--------------------------------------------------------------------------
    */

    else
    {

        $_SESSION["wheelchair"] = "No";
        $_SESSION["wheelchairNumber"] = 0;


<<<<<<< HEAD
        header(
            "Location: /summer-25-26-emergency-help-hub/controller/citizen/injury.php"
        );
=======
        header("Location: injury.php");
>>>>>>> origin/main

        exit();

    }

}


require_once __DIR__ . "/../../view/citizen/wheelchair.php";

?>