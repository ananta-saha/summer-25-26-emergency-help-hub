<?php

require_once "../../config/db.php";


// Get all funds/donations

function getAllFunds()
{
    global $conn;

    $sql = "
    SELECT *
    FROM organization_donations
    ORDER BY donation_id DESC
    ";

    return mysqli_query($conn,$sql);
}




// Update donation status

function updateFundStatus($id,$status)
{
    global $conn;

    $sql = "
    UPDATE organization_donations

    SET status='$status'

    WHERE donation_id=$id
    ";

    return mysqli_query($conn,$sql);
}




// Delete donation

function deleteFund($id)
{
    global $conn;

    $sql = "
    DELETE FROM organization_donations

    WHERE donation_id=$id
    ";

    return mysqli_query($conn,$sql);
}


?>