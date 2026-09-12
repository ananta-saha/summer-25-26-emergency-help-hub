<?php

require_once __DIR__ . "/../../config/db.php";


/* =========================================
   ADD ORGANIZATION SERVICE
========================================= */

function addOrganizationService(
    $organizationId,
    $name,
    $type,
    $hotline,
    $area
) {
    global $conn;

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO organization_services
        (
            organization_id,
            service_name,
            service_type,
            hotline,
            coverage_area
        )
        VALUES (?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "issss",
        $organizationId,
        $name,
        $type,
        $hotline,
        $area
    );

    $success = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $success;
}


/* =========================================
   GET ORGANIZATION SERVICES
========================================= */

function getOrganizationServices($organizationId)
{
    global $conn;

    $stmt = mysqli_prepare(
        $conn,
        "SELECT *
         FROM organization_services
         WHERE organization_id = ?
         ORDER BY service_id DESC"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $organizationId
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $services = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $services[] = $row;
    }

    mysqli_stmt_close($stmt);

    return $services;
}


/* =========================================
   DELETE ORGANIZATION SERVICE
========================================= */

function deleteOrganizationService(
    $serviceId,
    $organizationId
) {
    global $conn;

    $stmt = mysqli_prepare(
        $conn,
        "DELETE FROM organization_services
         WHERE service_id = ?
         AND organization_id = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ii",
        $serviceId,
        $organizationId
    );

    $success = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $success;
}


/* =========================================
   ADD DONATION / FUND
========================================= */

function addOrganizationDonation(
    $organizationId,
    $donorName,
    $amount,
    $purpose,
    $receivedAt
) {
    global $conn;

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO organization_donations
        (
            organization_id,
            donor_name,
            amount,
            purpose,
            received_at,
            status
        )
        VALUES (?, ?, ?, ?, ?, 'Received')"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "isdss",
        $organizationId,
        $donorName,
        $amount,
        $purpose,
        $receivedAt
    );

    $success = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $success;
}


/* =========================================
   GET DONATIONS
========================================= */

function getOrganizationDonations($organizationId)
{
    global $conn;

    $stmt = mysqli_prepare(
        $conn,
        "SELECT *
         FROM organization_donations
         WHERE organization_id = ?
         ORDER BY donation_id DESC"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $organizationId
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $donations = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $donations[] = $row;
    }

    mysqli_stmt_close($stmt);

    return $donations;
}


/* =========================================
   TOTAL FUND
========================================= */

function getOrganizationTotalFund($organizationId)
{
    global $conn;

    $stmt = mysqli_prepare(
        $conn,
        "SELECT
            COALESCE(SUM(amount), 0) AS total_fund
         FROM organization_donations
         WHERE organization_id = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $organizationId
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return (float) $row["total_fund"];
}


/* =========================================
   RECEIVED FUND
========================================= */

function getOrganizationReceivedFund($organizationId)
{
    global $conn;

    $stmt = mysqli_prepare(
        $conn,
        "SELECT
            COALESCE(SUM(amount), 0) AS received_fund
         FROM organization_donations
         WHERE organization_id = ?
         AND status = 'Received'"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $organizationId
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return (float) $row["received_fund"];
}


/* =========================================
   ALLOCATED FUND
========================================= */

function getOrganizationAllocatedFund($organizationId)
{
    global $conn;

    $stmt = mysqli_prepare(
        $conn,
        "SELECT
            COALESCE(SUM(amount), 0) AS allocated_fund
         FROM organization_donations
         WHERE organization_id = ?
         AND status = 'Allocated'"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $organizationId
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return (float) $row["allocated_fund"];
}


/* =========================================
   ORGANIZATION REPORT
========================================= */

/* =========================================
   ORGANIZATION REPORT
========================================= */

function getOrganizationReport($organizationId)
{
    global $conn;

    $report = [];


    /* =========================================
       TOTAL SERVICES
    ========================================= */

    $stmt = mysqli_prepare(
        $conn,
        "SELECT COUNT(*) AS total_services
         FROM organization_services
         WHERE organization_id = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $organizationId
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($result);

    $report["total_services"] =
        (int) $row["total_services"];

    mysqli_stmt_close($stmt);


    /* =========================================
       TOTAL PROVIDERS
    ========================================= */

    $stmt = mysqli_prepare(
        $conn,
        "SELECT COUNT(*) AS total_providers
         FROM organization_providers
         WHERE organization_id = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $organizationId
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($result);

    $report["total_providers"] =
        (int) $row["total_providers"];

    mysqli_stmt_close($stmt);


    /* =========================================
       ACTIVE PROVIDERS
    ========================================= */

    $stmt = mysqli_prepare(
        $conn,
        "SELECT COUNT(*) AS active_providers
         FROM organization_providers
         WHERE organization_id = ?
         AND status = 'Active'"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $organizationId
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($result);

    $report["active_providers"] =
        (int) $row["active_providers"];

    mysqli_stmt_close($stmt);


    /* =========================================
       TOTAL DONATIONS
    ========================================= */

    $stmt = mysqli_prepare(
        $conn,
        "SELECT COUNT(*) AS total_donations
         FROM organization_donations
         WHERE organization_id = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $organizationId
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($result);

    $report["total_donations"] =
        (int) $row["total_donations"];

    mysqli_stmt_close($stmt);


    /* =========================================
       TOTAL FUND
    ========================================= */

    $report["total_fund"] =
        getOrganizationTotalFund($organizationId);


    return $report;
}

/* =========================================
   CHECK ORGANIZATION EXISTS
========================================= */

function organizationExists($email, $username)
{
    global $conn;

    $stmt = mysqli_prepare(
        $conn,
        "SELECT organization_id
         FROM organizations
         WHERE email = ?
         OR username = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ss",
        $email,
        $username
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $exists = mysqli_num_rows($result) > 0;

    mysqli_stmt_close($stmt);

    return $exists;
}


/* =========================================
   REGISTER ORGANIZATION
========================================= */

function registerOrganization(
    $name,
    $email,
    $username,
    $passwordHash,
    $phone,
    $address
) {
    global $conn;

    $status = "Active";

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO organizations
        (
            organization_name,
            email,
            username,
            password,
            phone,
            address,
            status
        )
        VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "sssssss",
        $name,
        $email,
        $username,
        $passwordHash,
        $phone,
        $address,
        $status
    );

    $success = mysqli_stmt_execute($stmt);

    $error = mysqli_stmt_error($stmt);

    mysqli_stmt_close($stmt);

    return [
        "success" => $success,
        "error" => $error
    ];
}

/* =========================================
   ADD ORGANIZATION PROVIDER
========================================= */

function addOrganizationProvider(
    $organizationId,
    $providerName,
    $providerEmail,
    $providerContact,
    $username,
    $password,
    $providerType
) {
    global $conn;

    $hashedPassword = password_hash(
        $password,
        PASSWORD_DEFAULT
    );

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO organization_providers
        (
            organization_id,
            provider_name,
            provider_email,
            provider_contact,
            username,
            password,
            provider_type,
            status
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, 'Active')"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "issssss",
        $organizationId,
        $providerName,
        $providerEmail,
        $providerContact,
        $username,
        $hashedPassword,
        $providerType
    );

    $success = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $success;
}

/* =========================================
   GET ORGANIZATION PROVIDERS
========================================= */

function getOrganizationProviders($organizationId)
{
    global $conn;

    $stmt = mysqli_prepare(
        $conn,
        "SELECT *
         FROM organization_providers
         WHERE organization_id = ?
         ORDER BY organization_provider_id DESC"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $organizationId
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $providers = [];

    while ($row = mysqli_fetch_assoc($result)) {

        $providers[] = $row;

    }

    mysqli_stmt_close($stmt);

    return $providers;
}


/* =========================================
   DELETE ORGANIZATION PROVIDER
========================================= */

function deleteOrganizationProvider(
    $providerId,
    $organizationId
) {
    global $conn;

    $stmt = mysqli_prepare(
        $conn,
        "DELETE FROM organization_providers
         WHERE organization_provider_id = ?
         AND organization_id = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ii",
        $providerId,
        $organizationId
    );

    $success = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $success;
}
/* =========================================
   CHECK PROVIDER USERNAME EXISTS
========================================= */

function providerUsernameExists($username)
{
    global $conn;

    $stmt = mysqli_prepare(
        $conn,
        "SELECT organization_provider_id
         FROM organization_providers
         WHERE username = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $username
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $exists = mysqli_num_rows($result) > 0;

    mysqli_stmt_close($stmt);

    return $exists;
}

/* =========================================
   UPDATE PROVIDER STATUS
========================================= */

function updateOrganizationProviderStatus(
    $providerId,
    $organizationId,
    $status
) {
    global $conn;

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE organization_providers
         SET status = ?
         WHERE organization_provider_id = ?
         AND organization_id = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "sii",
        $status,
        $providerId,
        $organizationId
    );

    $success = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $success;
}
/* =========================================
   GET ORGANIZATION REVIEWS
========================================= */

function getOrganizationReviews($organizationId)
{
    global $conn;

    $stmt = mysqli_prepare(
        $conn,
        "SELECT
            r.*,
            p.provider_name
         FROM organization_reviews r
         LEFT JOIN organization_providers p
            ON r.provider_id =
               p.organization_provider_id
         WHERE r.organization_id = ?
         ORDER BY r.review_id DESC"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $organizationId
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $reviews = [];

    while ($row = mysqli_fetch_assoc($result)) {

        $reviews[] = $row;
    }

    mysqli_stmt_close($stmt);

    return $reviews;
}


/* =========================================
   GET AVERAGE RATING
========================================= */

function getOrganizationAverageRating($organizationId)
{
    global $conn;

    $stmt = mysqli_prepare(
        $conn,
        "SELECT
            COALESCE(AVG(rating), 0) AS average_rating
         FROM organization_reviews
         WHERE organization_id = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $organizationId
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return round(
        (float) $row["average_rating"],
        2
    );
}


/* =========================================
   GET TOTAL REVIEWS
========================================= */

function getOrganizationTotalReviews($organizationId)
{
    global $conn;

    $stmt = mysqli_prepare(
        $conn,
        "SELECT COUNT(*) AS total_reviews
         FROM organization_reviews
         WHERE organization_id = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $organizationId
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return (int) $row["total_reviews"];
}
?>