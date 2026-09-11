<?php
require_once __DIR__ . "/../../Config/db.php";

function findCitizenByEmailOrPhone($emailOrPhone)
{
    global $conn;
    $stmt = mysqli_prepare(
        $conn,
        "SELECT citizen_id, name, email, password, phone, status
         FROM citizens
         WHERE email = ? OR phone = ?"
    );
    mysqli_stmt_bind_param(
        $stmt,
        "ss",
        $emailOrPhone,
        $emailOrPhone
    );
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $user;
}

function checkCitizenExists($email, $phone)
{
    global $conn;
    $stmt = mysqli_prepare(
        $conn,
        "SELECT email
         FROM citizens
         WHERE email = ? OR phone = ?"
    );
    mysqli_stmt_bind_param(
        $stmt,
        "ss",
        $email,
        $phone
    );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $exists = mysqli_stmt_num_rows($stmt) > 0;
    mysqli_stmt_close($stmt);
    return $exists;
}

function saveCitizen($fname, $email, $phone, $passwordHash, $address)
{
    global $conn;
    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO citizens
        (name, email, phone, password, address, status)
        VALUES (?, ?, ?, ?, ?, 'Active')"
    );
    mysqli_stmt_bind_param(
        $stmt,
        "sssss",
        $fname,
        $email,
        $phone,
        $passwordHash,
        $address
    );
    $success = mysqli_stmt_execute($stmt);
    $error = mysqli_stmt_error($stmt);
    mysqli_stmt_close($stmt);
    return [
        "success" => $success,
        "error" => $error
    ];
}
function findCitizenProfile($citizenId)
{
    global $conn;
    $stmt = mysqli_prepare(
        $conn,
        "SELECT name, email, phone, address
         FROM citizens
         WHERE citizen_id = ?
         LIMIT 1"
    );
    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $citizenId
    );
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $citizen = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $citizen;
}

function updateCitizenProfile(
    $citizenId,
    $fname,
    $email,
    $phone,
    $address
) {
    global $conn;
    $checkStmt = mysqli_prepare(
        $conn,
        "SELECT citizen_id
         FROM citizens
         WHERE (email = ? OR phone = ?)
         AND citizen_id != ?"
    );
    mysqli_stmt_bind_param(
        $checkStmt,
        "ssi",
        $email,
        $phone,
        $citizenId
    );
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_store_result($checkStmt);
    if (mysqli_stmt_num_rows($checkStmt) > 0) {
        mysqli_stmt_close($checkStmt);
        return [
            "success" => false,
            "error" => "Email or phone number is already used by another citizen."
        ];
    }
    mysqli_stmt_close($checkStmt);

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE citizens
         SET name = ?,
             email = ?,
             phone = ?,
             address = ?,
             updated_at = CURRENT_TIMESTAMP
         WHERE citizen_id = ?"
    );
    mysqli_stmt_bind_param(
        $stmt,
        "ssssi",
        $fname,
        $email,
        $phone,
        $address,
        $citizenId
    );
    $success = mysqli_stmt_execute($stmt);
    $error = mysqli_stmt_error($stmt);
    mysqli_stmt_close($stmt);
    return [
        "success" => $success,
        "error" => $error
    ];
}
function searchEmergencyServices($serviceType, $location)
{
    global $conn;
    $services = array();
    $stmt = mysqli_prepare(
        $conn,
        "SELECT
            sp.provider_id,
            sp.provider_name,
            sp.service_type,
            sp.phone,
            sp.address,
            pa.availability_status,
            sa.base_area,
            sa.service_range_km,
            sa.covered_areas

         FROM service_providers sp
         INNER JOIN provider_availability pa
            ON sp.provider_id = pa.provider_id

         INNER JOIN service_areas sa
            ON sp.provider_id = sa.provider_id
         WHERE LOWER(sp.service_type) = LOWER(?)

         AND (
                LOWER(sa.base_area) = LOWER(?)
                OR LOWER(sa.covered_areas) LIKE LOWER(?)
             )

         AND sp.status = 'Verified'"
    );
    if (!$stmt) {
        return [
            "success" => false,
            "services" => [],
            "error" => "Could not process search: " . mysqli_error($conn)
        ];
    }
    $locationSearch = "%" . $location . "%";
    mysqli_stmt_bind_param(
        $stmt,
        "sss",
        $serviceType,
        $location,
        $locationSearch
    );
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) { $services[] = $row;}

        mysqli_stmt_close($stmt);
        return [
            "success" => true,
            "services" => $services,
            "error" => ""
        ];
    } else {
        $error = mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
        return [
            "success" => false,
            "services" => [],
            "error" => "Could not search services: " . $error
        ];
    }
}
function saveEmergencyRequest(
    $citizenId,
    $providerId,
    $serviceType,
    $emergencyType,
    $people,
    $vehicles,
    $location,
    $details,
    $wheelchair,
    $wheelchairNumber,
    $injury,
    $injuryLevel,
    $injuryDescription
) {
    global $conn;
    $wheelchairRequired = ($wheelchair == "Yes") ? 1 : 0;
    $injuryPresent = ($injury == "Yes") ? 1 : 0;
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
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')"
    );

    if (!$stmt) {
        return [
            "success" => false,
            "error" => "Could not prepare request: " . mysqli_error($conn)
        ];
    }
    mysqli_stmt_bind_param(
        $stmt,
        "iisssissiiiss",
        $citizenId,
        $providerId,
        $serviceType,
        $emergencyType,
        $people,
        $vehicles,
        $location,
        $details,
        $wheelchairRequired,
        $wheelchairNumber,
        $injuryPresent,
        $injuryLevel,
        $injuryDescription
    );
    if (mysqli_stmt_execute($stmt)) {
        $requestId = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt);
        return [
            "success" => true,
            "request_id" => $requestId,
            "error" => ""
        ];
    } else {
        $error = mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
        return [
            "success" => false,
            "error" => $error
        ];
    }
}

function cancelEmergencyRequest($requestId, $citizenId)
{
    global $conn;
    $stmt = mysqli_prepare(
        $conn,
        "DELETE FROM emergency_requests
         WHERE request_id = ?
         AND citizen_id = ?"
    );
    mysqli_stmt_bind_param(
        $stmt,
        "ii",
        $requestId,
        $citizenId
    );
    $success = mysqli_stmt_execute($stmt);
    $error = mysqli_stmt_error($stmt);
    mysqli_stmt_close($stmt);
    return [
        "success" => $success,
        "error" => $error
    ];
}
function getCitizenEmergencyRequest($requestId, $citizenId)
{
    global $conn;
    $stmt = mysqli_prepare(
        $conn,
        "SELECT *
         FROM emergency_requests
         WHERE request_id = ?
         AND citizen_id = ?
         LIMIT 1"
    );
    mysqli_stmt_bind_param(
        $stmt,
        "ii",
        $requestId,
        $citizenId
    );
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $request = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $request;
}
?>