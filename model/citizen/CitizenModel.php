<?php

require_once __DIR__ . "/../../config/db.php";



/*
|--------------------------------------------------------------------------
| Search Available Emergency Services
|--------------------------------------------------------------------------
*/

function searchEmergencyServices($serviceType, $latitude, $longitude)
{
    global $conn;


    $stmt = mysqli_prepare(
        $conn,

        "SELECT

            provider_id,
            provider_name,
            service_type,
            phone,
            address,
            availability_status,


            (
                6371 * ACOS(

                    COS(RADIANS(?))

                    *
                    COS(RADIANS(latitude))

                    *
                    COS(
                        RADIANS(longitude)
                        -
                        RADIANS(?)
                    )

                    +

                    SIN(RADIANS(?))

                    *
                    SIN(RADIANS(latitude))

                )

            ) AS distance


        FROM service_providers


        WHERE TRIM(service_type)=TRIM(?)

        AND status='Verified'

        AND availability_status='Available'


        ORDER BY distance ASC"
    );



    mysqli_stmt_bind_param(

        $stmt,

        "ddds",

        $latitude,

        $longitude,

        $latitude,

        $serviceType

    );



    mysqli_stmt_execute($stmt);



    $result = mysqli_stmt_get_result($stmt);



    $services = [];



    while($row = mysqli_fetch_assoc($result))
    {

        $services[] = $row;

    }



    mysqli_stmt_close($stmt);



    if(count($services)>0)
    {

        return [

            "success"=>true,

            "services"=>$services,

            "error"=>""

        ];

    }



    return [

        "success"=>false,

        "services"=>[],

        "error"=>"No available service provider found."

    ];
}





/*
|--------------------------------------------------------------------------
| Find Available Provider Automatically
|--------------------------------------------------------------------------
*/

function findNearestProvider($serviceType)
{
    global $conn;

    $stmt = mysqli_prepare(
        $conn,
        "SELECT
            provider_id
        FROM service_providers
        WHERE TRIM(service_type)=TRIM(?)
        AND status='Verified'
        AND availability_status='Available'
        LIMIT 1"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $serviceType
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $provider = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    if($provider)
    {
        return $provider["provider_id"];
    }

    return false;
}

/*
|--------------------------------------------------------------------------
| Save Emergency Request
|--------------------------------------------------------------------------
*/

function saveEmergencyRequest(
    $citizenId,
    $providerId,
    $serviceType,
    $emergencyType,
    $peopleCount,
    $vehiclesRequested,
    $location,
    $details,
    $wheelchairRequired,
    $wheelchairCount,
    $injuryPresent,
    $injuryLevel,
    $injuryDescription
)
{

    global $conn;



    $stmt = mysqli_prepare(
        $conn,

        "INSERT INTO emergency_requests

        (
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
        status
        )

        VALUES
        (?,?,?,?,?,?,?,?,?,?,?,?,?,'Pending')"
    );



    mysqli_stmt_bind_param(
        $stmt,

        "iissiissiiiss",

        $citizenId,
        $providerId,
        $serviceType,
        $emergencyType,
        $peopleCount,
        $vehiclesRequested,
        $location,
        $details,
        $wheelchairRequired,
        $wheelchairCount,
        $injuryPresent,
        $injuryLevel,
        $injuryDescription
    );



    if(mysqli_stmt_execute($stmt))
    {

        $requestId = mysqli_insert_id($conn);


        mysqli_stmt_close($stmt);



        return [

            "success" => true,

            "request_id" => $requestId

        ];

    }



    $error = mysqli_error($conn);



    mysqli_stmt_close($stmt);



    return [

        "success" => false,

        "error" => $error

    ];

}





/*
|--------------------------------------------------------------------------
| Get Citizen Emergency Request
|--------------------------------------------------------------------------
*/

function getCitizenEmergencyRequest($citizenId)
{
    global $conn;



    $stmt = mysqli_prepare(
        $conn,


        "SELECT

            request_id,
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
            updated_at

        FROM emergency_requests

        WHERE citizen_id = ?

        ORDER BY request_time DESC

        LIMIT 1"
    );



    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $citizenId
    );



    mysqli_stmt_execute($stmt);



    $result = mysqli_stmt_get_result($stmt);



    $request = mysqli_fetch_assoc($result);



    mysqli_stmt_close($stmt);



    return $request;
}





/*
|--------------------------------------------------------------------------
| Cancel Emergency Request
|--------------------------------------------------------------------------
*/

function cancelEmergencyRequest($requestId, $citizenId)
{
    global $conn;


    $stmt = mysqli_prepare(
        $conn,

        "UPDATE emergency_requests

        SET status = 'Cancelled'

        WHERE request_id = ?

        AND citizen_id = ?"
    );


    mysqli_stmt_bind_param(
        $stmt,
        "ii",
        $requestId,
        $citizenId
    );


    $result = mysqli_stmt_execute($stmt);


    mysqli_stmt_close($stmt);


    return $result;
}


?>