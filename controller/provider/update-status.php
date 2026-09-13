<?php

session_start();

require_once __DIR__ . "/../../model/provider/ProviderModel.php";


if(!isset($_SESSION["provider_id"]))
{
    header("Location: ../auth/login.php");
    exit();
}


if(!isset($_GET["id"]) || !isset($_GET["status"]))
{
    echo "Missing request information";
    exit();
}



$providerId = $_SESSION["provider_id"];

$requestId = (int)$_GET["id"];

$status = trim($_GET["status"]);



$allowedStatus = [

    "Accepted",
    "Rejected",
    "Completed"

];



if(!in_array($status,$allowedStatus))
{
    echo "Invalid status";
    exit();
}




$result = updateRequestStatus(
    $requestId,
    $status,
    $providerId
);



if(!$result)
{
    echo "Failed to update request status";
    exit();
}




if($status == "Accepted")
{

    updateProviderAvailability(
        $providerId,
        "Busy"
    );

}




if($status == "Completed")
{

    updateProviderAvailability(
        $providerId,
        "Available"
    );

}




header(
    "Location: requests.php"
);

exit();

?>