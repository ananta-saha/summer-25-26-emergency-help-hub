<?php

session_start();


require_once "../../model/admin/ProviderManagementModel.php";



if(!isset($_SESSION["admin_id"]))
{
    header("Location: ../../view/auth/login.php");
    exit();
}




// Delete

if(isset($_GET["delete"]))
{

    deleteProvider($_GET["delete"]);


    header("Location: ../../view/admin/providers.php");

    exit();

}





// Approve Reject

if(isset($_GET["status"]))
{

    updateProviderStatus(
        $_GET["id"],
        $_GET["status"]
    );


    header("Location: ../../view/admin/providers.php");

    exit();

}





// Add provider

if(isset($_POST["add"]))
{


addProvider(

$_POST["name"],
$_POST["email"],
$_POST["phone"],
$_POST["service_type"],
$_POST["location"]

);



header("Location: ../../view/admin/providers.php");


exit();


}

if(isset($_POST["update"]))
{


updateProvider(

$_POST["id"],
$_POST["name"],
$_POST["email"],
$_POST["phone"],
$_POST["service_type"],
$_POST["location"]

);


header("Location: ../../view/admin/providers.php");

exit();

}

?>