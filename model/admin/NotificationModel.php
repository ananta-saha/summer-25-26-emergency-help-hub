<?php


require_once __DIR__ . "/../../config/db.php";




// Get all notifications

function getAllNotifications()
{

    global $conn;


    $sql = "SELECT * FROM notifications ORDER BY id DESC";


    $result = mysqli_query($conn,$sql);


    return $result;

}







// Add notification

function addNotification($receiver,$subject,$message)
{

    global $conn;



    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO notifications
        (receiver,subject,message)
        VALUES (?,?,?)"
    );



    mysqli_stmt_bind_param(
        $stmt,
        "sss",
        $receiver,
        $subject,
        $message
    );



    return mysqli_stmt_execute($stmt);


}







// Delete notification

function deleteNotification($id)
{

    global $conn;



    $stmt = mysqli_prepare(
        $conn,
        "DELETE FROM notifications WHERE id=?"
    );



    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $id
    );



    return mysqli_stmt_execute($stmt);


}



?>