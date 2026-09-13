<?php

require_once __DIR__ . "/../../config/db.php";



function getProviderProfile($providerId)
{
    global $conn;


    $stmt = mysqli_prepare(
        $conn,

        "SELECT
            provider_id,
            provider_name,
            email,
            service_type,
            phone,
            address,
            status,
            availability_status

        FROM service_providers

        WHERE provider_id = ?

        LIMIT 1"
    );


    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $providerId
    );


    mysqli_stmt_execute($stmt);


    $result = mysqli_stmt_get_result($stmt);


    $provider = mysqli_fetch_assoc($result);


    mysqli_stmt_close($stmt);


    return $provider;
}




function getProviderEmergencyRequests($providerId)
{
    global $conn;


    $stmt = mysqli_prepare(
        $conn,

        "SELECT

            request_id,
            citizen_id,
            provider_id,

            service_type,
            emergency_type,

            people_count,
            vehicles_requested,

            location,
            details,

            wheelchair_required,
            wheelchair_count,

            injury_present,
            injury_level,
            injury_description,

            status,

            request_time,
            accepted_at,
            completed_at,
            updated_at


        FROM emergency_requests


        WHERE provider_id = ?


        ORDER BY request_time DESC"
    );


    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $providerId
    );


    mysqli_stmt_execute($stmt);


    $result = mysqli_stmt_get_result($stmt);


    $requests = [];


    while($row = mysqli_fetch_assoc($result))
    {
        $requests[] = $row;
    }


    mysqli_stmt_close($stmt);


    return $requests;
}


function updateRequestStatus($requestId, $status, $providerId)
{
    global $conn;


    if($status == "Accepted")
    {

        $query =

        "UPDATE emergency_requests

        SET

            status = ?,

            accepted_at = NOW(),

            updated_at = NOW()

        WHERE request_id = ?

        AND provider_id = ?

        AND status = 'Pending'";
    }


    elseif($status == "Completed")
    {

        $query =

        "UPDATE emergency_requests

        SET

            status = ?,

            completed_at = NOW(),

            updated_at = NOW()

        WHERE request_id = ?

        AND provider_id = ?";
    }


    else
    {

        $query =

        "UPDATE emergency_requests

        SET

            status = ?,

            updated_at = NOW()

        WHERE request_id = ?

        AND provider_id = ?";
    }



    $stmt = mysqli_prepare(
        $conn,
        $query
    );


    mysqli_stmt_bind_param(
        $stmt,
        "sii",
        $status,
        $requestId,
        $providerId
    );



    $result = mysqli_stmt_execute($stmt);



    mysqli_stmt_close($stmt);



    return $result;
}







function updateProviderAvailability($providerId, $availability)
{
    global $conn;


    $stmt = mysqli_prepare(
        $conn,

        "UPDATE service_providers

        SET
            availability_status = ?,
            updated_at = NOW()

        WHERE provider_id = ?"
    );


    mysqli_stmt_bind_param(
        $stmt,
        "si",
        $availability,
        $providerId
    );


    $result = mysqli_stmt_execute($stmt);


    mysqli_stmt_close($stmt);


    return $result;
}
function getProviderRequestCount($providerId)
{
    global $conn;


    $stmt = mysqli_prepare(
        $conn,

        "SELECT COUNT(*) AS total

        FROM emergency_requests

        WHERE provider_id = ?"
    );


    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $providerId
    );


    mysqli_stmt_execute($stmt);


    $result = mysqli_stmt_get_result($stmt);


    $data = mysqli_fetch_assoc($result);


    mysqli_stmt_close($stmt);


    return $data["total"];
}







function getProviderStatusCount($providerId, $status)
{
    global $conn;


    $stmt = mysqli_prepare(
        $conn,

        "SELECT COUNT(*) AS total

        FROM emergency_requests

        WHERE provider_id = ?

        AND status = ?"
    );


    mysqli_stmt_bind_param(
        $stmt,
        "is",
        $providerId,
        $status
    );


    mysqli_stmt_execute($stmt);


    $result = mysqli_stmt_get_result($stmt);


    $data = mysqli_fetch_assoc($result);


    mysqli_stmt_close($stmt);


    return $data["total"];
}



?>