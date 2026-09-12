<?php

session_start();


require_once __DIR__ . "/../../model/provider/ProviderModel.php";


if(!isset($_SESSION["provider_id"]))
{
    header("Location: ../auth/login.php");
    exit();
}



$providerId = $_SESSION["provider_id"];



if($_SERVER["REQUEST_METHOD"]=="POST")
{

    $availability = $_POST["availability"];


    updateProviderAvailability(
        $providerId,
        $availability
    );


    header("Location: availability.php");

    exit();

}



require_once __DIR__ . "/../../view/provider/availability.php";

?>