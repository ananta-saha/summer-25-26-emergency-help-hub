<?php

session_start();

require_once __DIR__ . "/../../model/provider/ProviderModel.php";


if(!isset($_SESSION["provider_id"]))
{
    header("Location: ../auth/login.php");
    exit();
}


$providerId = $_SESSION["provider_id"];


$provider = getProviderProfile($providerId);


/* Dashboard Statistics */

$totalRequests = getProviderRequestCount($providerId);

$pendingRequests = getProviderStatusCount(
    $providerId,
    "Pending"
);


$acceptedRequests = getProviderStatusCount(
    $providerId,
    "Accepted"
);


$completedRequests = getProviderStatusCount(
    $providerId,
    "Completed"
);



require_once __DIR__ . "/../../view/provider/dashboard.php";

?>