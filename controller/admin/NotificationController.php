<?php


session_start();


require_once __DIR__ . "/../../model/admin/NotificationModel.php";



if(!isset($_SESSION["admin_id"]))
{
    header("Location: ../../view/auth/login.php");
    exit();
}






// Add Notification

if(isset($_POST["add"]))
{

    $receiver = $_POST["receiver"];

    $subject = $_POST["subject"];

    $message = $_POST["message"];



    addNotification(
        $receiver,
        $subject,
        $message
    );



    header("Location: ../../view/admin/notifications.php");

    exit();

}








// Delete Notification

if(isset($_GET["delete"]))
{

    $id = $_GET["delete"];



    deleteNotification($id);



    header("Location: ../../view/admin/notifications.php");

    exit();

}



?>