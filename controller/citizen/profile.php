<?php

session_start();

require_once __DIR__ . "/../../model/citizen/CitizenModel.php";


$fnameErr = $emailErr = $phoneErr = $addressErr = "";

$dbErr = "";
$successMsg = "";

$fname = "";
$email = "";
$phone = "";
$address = "";



if (!isset($_SESSION["citizen_id"]))
{
    header("Location: ../auth/login.php");
    exit();
}



$citizenId = $_SESSION["citizen_id"];



function cleanInput($data)
{
    return htmlspecialchars(
        stripslashes(
            trim($data)
        )
    );
}




/*
|--------------------------------------------------------------------------
| Update Profile
|--------------------------------------------------------------------------
*/

if($_SERVER["REQUEST_METHOD"] == "POST")
{


    // Full Name

    if(empty($_POST["fname"]))
    {
        $fnameErr = "Enter your full name";
    }
    else
    {
        $fname = cleanInput($_POST["fname"]);

        if(!preg_match("/^[a-zA-Z-' ]+$/",$fname))
        {
            $fnameErr = "Invalid name format";
        }
    }



    // Email

    if(empty($_POST["email"]))
    {
        $emailErr = "Enter your email";
    }
    else
    {
        $email = cleanInput($_POST["email"]);

        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $emailErr = "Invalid email";
        }
    }




    // Phone

    if(empty($_POST["phone"]))
    {
        $phoneErr = "Enter phone number";
    }
    else
    {
        $phone = cleanInput($_POST["phone"]);

        if(!preg_match("/^01[0-9]{9}$/",$phone))
        {
            $phoneErr = "Invalid phone number";
        }
    }





    // Address

    if(empty($_POST["address"]))
    {
        $addressErr = "Enter address";
    }
    else
    {
        $address = cleanInput($_POST["address"]);

        if(strlen($address)<8)
        {
            $addressErr = "Address too short";
        }
    }





    $valid =
    !$fnameErr &&
    !$emailErr &&
    !$phoneErr &&
    !$addressErr;




    if($valid)
    {

        $updateResult = updateCitizenProfile(
            $citizenId,
            $fname,
            $email,
            $phone,
            $address
        );



        if($updateResult["success"])
        {

            $successMsg =
            "Profile updated successfully";


            $_SESSION["citizen_name"] = $fname;
            $_SESSION["citizen_email"] = $email;

        }
        else
        {

            $dbErr = $updateResult["error"];

        }

    }

}







/*
|--------------------------------------------------------------------------
| Load Profile Data
|--------------------------------------------------------------------------
*/


$citizen = findCitizenProfile($citizenId);



if($citizen)
{

    // Database column is "name"

    $fname = $citizen["name"];

    $email = $citizen["email"];

    $phone = $citizen["phone"];

    $address = $citizen["address"];

}
else
{

    $dbErr = "Citizen profile not found.";

}







require_once __DIR__ . "/../../view/citizen/profile.php";


?>