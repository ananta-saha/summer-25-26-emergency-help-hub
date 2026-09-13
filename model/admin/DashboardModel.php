<?php

require_once __DIR__ . "/../../config/db.php";



// count citizens

function countCitizens()
{
    global $conn;

    $result = mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total FROM citizens"
    );

    return mysqli_fetch_assoc($result)["total"];
}




// count providers

function countProviders()
{
    global $conn;

    $result = mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total FROM service_providers"
    );

    return mysqli_fetch_assoc($result)["total"];
}





// count organizations

function countOrganizations()
{
    global $conn;

    $result = mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total FROM organizations"
    );

    return mysqli_fetch_assoc($result)["total"];
}





// pending emergency requests

function countPendingRequests()
{
    global $conn;

    $result = mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total 
         FROM emergency_requests 
         WHERE status='Pending'"
    );

    return mysqli_fetch_assoc($result)["total"];
}



?>