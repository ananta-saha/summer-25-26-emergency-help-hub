<?php

session_start();

require_once __DIR__ . "/../../model/citizen/CitizenModel.php";


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



$wheelchair = "No";
$wheelchairNumber = 0;
$error = "";



/*
|--------------------------------------------------------------------------
| Handle Submit
|--------------------------------------------------------------------------
*/

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $wheelchair = $_POST["wheelchair"] ?? "No";

    $wheelchairNumber = $_POST["wheelchairNumber"] ?? 0;



    /*
    |--------------------------------------------------------------------------
    | Yes
    |--------------------------------------------------------------------------
    */

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


            header(
                "Location: /summer-25-26-emergency-help-hub/controller/citizen/injury.php"
            );

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


        header(
            "Location: /summer-25-26-emergency-help-hub/controller/citizen/injury.php"
        );

        exit();

    }

}



require_once __DIR__ . "/../../view/citizen/wheelchair.php";

?>