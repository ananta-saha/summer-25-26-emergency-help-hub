<?php


require_once "../../config/db.php";




// Get all funds

function getAllFunds()
{

    global $conn;


    $sql = "
    SELECT *
    FROM funds
    ORDER BY id DESC
    ";


    return mysqli_query($conn,$sql);

}







// Update fund status

function updateFundStatus($id,$status)
{

    global $conn;


    $sql = "
    UPDATE funds

    SET status='$status'

    WHERE id=$id
    ";


    return mysqli_query($conn,$sql);

}








// Delete fund

function deleteFund($id)
{

    global $conn;


    $sql = "
    DELETE FROM funds

    WHERE id=$id
    ";


    return mysqli_query($conn,$sql);

}



?>