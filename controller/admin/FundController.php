<?php


session_start();


require_once "../../model/admin/FundModel.php";



if(!isset($_SESSION["admin_id"]))
{

    header("Location: ../../view/auth/login.php");

    exit();

}





// Delete

if(isset($_GET["delete"]))
{


    deleteFund($_GET["delete"]);


    header("Location: ../../view/admin/funds.php");

    exit();

}






// Approve Reject

if(isset($_GET["status"]))
{


    updateFundStatus(

        $_GET["id"],

        $_GET["status"]

    );



    header("Location: ../../view/admin/funds.php");

    exit();

}



?>