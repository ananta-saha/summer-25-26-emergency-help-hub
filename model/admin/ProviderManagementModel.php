<?php

require_once "../../config/db.php";



// Get all providers

function getAllProviders()
{

    global $conn;


    $sql = "SELECT * FROM service_providers ORDER BY id DESC";


    return mysqli_query($conn,$sql);

}






// Get single provider by ID

function getProviderById($id)
{

    global $conn;


    $sql = "
    SELECT * 
    FROM service_providers
    WHERE id=$id
    ";


    $result = mysqli_query($conn,$sql);


    return mysqli_fetch_assoc($result);

}






// Add provider

function addProvider($name,$email,$phone,$service_type,$location)
{

    global $conn;



    $sql = "
    INSERT INTO service_providers
    (
        name,
        email,
        phone,
        service_type,
        location,
        status
    )

    VALUES

    (
        '$name',
        '$email',
        '$phone',
        '$service_type',
        '$location',
        'Pending'
    )
    ";



    return mysqli_query($conn,$sql);

}







// Update provider

function updateProvider($id,$name,$email,$phone,$service_type,$location)
{

    global $conn;



    $sql = "
    UPDATE service_providers

    SET

    name='$name',
    email='$email',
    phone='$phone',
    service_type='$service_type',
    location='$location'


    WHERE id=$id
    ";



    return mysqli_query($conn,$sql);

}








// Delete provider

function deleteProvider($id)
{

    global $conn;


    $sql = "
    DELETE FROM service_providers
    WHERE id=$id
    ";


    return mysqli_query($conn,$sql);

}








// Approve / Reject provider

function updateProviderStatus($id,$status)
{

    global $conn;


    $sql = "
    UPDATE service_providers

    SET status='$status'

    WHERE id=$id
    ";


    return mysqli_query($conn,$sql);

}



?>