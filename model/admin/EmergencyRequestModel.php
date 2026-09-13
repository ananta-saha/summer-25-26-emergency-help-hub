<?php


require_once __DIR__ . "/../../config/db.php";




// Get all emergency requests

function getAllEmergencyRequests()
{

    global $conn;


    $sql = "
    SELECT 
        emergency_requests.*,
        citizens.name AS citizen_name

    FROM emergency_requests

    JOIN citizens

    ON emergency_requests.citizen_id = citizens.citizen_id

    ORDER BY request_id DESC
    ";


    return mysqli_query($conn,$sql);

}






// Update request status

function updateRequestStatus($request_id,$status)
{

    global $conn;


    $stmt = mysqli_prepare(
        $conn,
        "UPDATE emergency_requests 
         SET status=? 
         WHERE request_id=?"
    );


    mysqli_stmt_bind_param(
        $stmt,
        "si",
        $status,
        $request_id
    );


    return mysqli_stmt_execute($stmt);

}






// Delete request

function deleteEmergencyRequest($request_id)
{

    global $conn;


    $stmt = mysqli_prepare(
        $conn,
        "DELETE FROM emergency_requests 
         WHERE request_id=?"
    );


    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $request_id
    );


    return mysqli_stmt_execute($stmt);

}



?>