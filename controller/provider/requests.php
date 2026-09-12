<?php

session_start();


require_once __DIR__ . "/../../model/provider/ProviderModel.php";


if(!isset($_SESSION["provider_id"]))
{
    header("Location: ../auth/login.php");
    exit();
}



$providerId = $_SESSION["provider_id"];



$requests = getProviderEmergencyRequests($providerId);



require_once __DIR__ . "/../../view/provider/requests.php";

?>