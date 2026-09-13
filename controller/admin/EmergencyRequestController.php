<?php


session_start();


if(!isset($_SESSION["admin_id"]))
{
    header("Location: ../../view/auth/login.php");
    exit();
}



require_once __DIR__ . "/../../model/admin/EmergencyRequestModel.php";





// Update Status

if(isset($_GET["id"]) && isset($_GET["status"]))
{

    $id = $_GET["id"];

    $status = $_GET["status"];



    updateRequestStatus(
        $id,
        $status
    );



    header(
        "Location: ../../view/admin/emergency_requests.php"
    );

    exit();

}






// Delete Request

if(isset($_GET["delete"]))
{

    $id = $_GET["delete"];



    deleteEmergencyRequest($id);



    header(
        "Location: ../../view/admin/emergency_requests.php"
    );


    exit();

}



?>