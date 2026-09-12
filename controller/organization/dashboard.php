<?php

session_start();

require_once __DIR__ . "/../../model/organization/OrganizationModel.php";


/* =========================================
   ORGANIZATION LOGIN CHECK
========================================= */
/*
if (!isset($_SESSION["organization_id"])) {

    header("Location: login.php");
    exit();

}
*/
$organizationId = isset($_SESSION["organization_id"])
    ? (int) $_SESSION["organization_id"]
    : 2;


/* =========================================
   DEFAULT VARIABLES
========================================= */

$error = "";
$success = "";

$services = [];
$providers = [];
$donations = [];
$reviews = [];

$averageRating = 0;
$totalReviews = 0;

$totalFund = 0;
$receivedFund = 0;
$allocatedFund = 0;

$report = [];


/* =========================================
   ADD EMERGENCY SERVICE
========================================= */

if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && isset($_POST["action"])
    && $_POST["action"] === "add_service"
) {

    $serviceName = trim(
        $_POST["service_name"] ?? ""
    );

    $serviceType = trim(
        $_POST["service_type"] ?? ""
    );

    $hotline = trim(
        $_POST["hotline"] ?? ""
    );

    $coverageArea = trim(
        $_POST["coverage_area"] ?? ""
    );


    if ($serviceName === "") {

        $error = "Please enter service name.";

    } elseif ($serviceType === "") {

        $error = "Please enter service type.";

    } elseif ($hotline === "") {

        $error = "Please enter hotline number.";

    } elseif ($coverageArea === "") {

        $error = "Please enter coverage area.";

    } else {

        $result = addOrganizationService(
            $organizationId,
            $serviceName,
            $serviceType,
            $hotline,
            $coverageArea
        );


        if ($result) {

            header(
                "Location: dashboard.php?service=added"
            );

            exit();

        } else {

            $error =
                "Service could not be added.";

        }

    }

}


/* =========================================
   DELETE EMERGENCY SERVICE
========================================= */

if (
    isset($_GET["action"])
    && $_GET["action"] === "delete_service"
    && isset($_GET["service_id"])
) {

    $serviceId = (int) $_GET["service_id"];


    if ($serviceId > 0) {

        $result = deleteOrganizationService(
            $serviceId,
            $organizationId
        );


        if ($result) {

            header(
                "Location: dashboard.php?service=deleted"
            );

            exit();

        } else {

            $error =
                "Service could not be deleted.";

        }

    }

}


/* =========================================
   ADD ORGANIZATION PROVIDER
========================================= */

if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && isset($_POST["action"])
    && $_POST["action"] === "add_provider"
) {

    $providerName = trim(
        $_POST["provider_name"] ?? ""
    );

    $providerEmail = trim(
        $_POST["provider_email"] ?? ""
    );

    $providerContact = trim(
        $_POST["provider_contact"] ?? ""
    );

    $username = trim(
        $_POST["username"] ?? ""
    );

    $password = trim(
        $_POST["password"] ?? ""
    );

    $providerType = trim(
        $_POST["provider_type"] ?? ""
    );


    if ($providerName === "") {

        $error =
            "Please enter provider name.";

    } elseif ($providerEmail === "") {

        $error =
            "Please enter provider email.";

    } elseif (
        !filter_var(
            $providerEmail,
            FILTER_VALIDATE_EMAIL
        )
    ) {

        $error =
            "Please enter a valid provider email.";

    } elseif ($providerContact === "") {

        $error =
            "Please enter provider contact number.";

    } elseif ($username === "") {

        $error =
            "Please enter username.";

    } elseif ($password === "") {

        $error =
            "Please enter password.";

    } elseif ($providerType === "") {

        $error =
            "Please select provider type.";

    } elseif (providerUsernameExists($username)) {

    $error = "This username is already taken. Please use another username.";

} else {

    $result = addOrganizationProvider(
        $organizationId,
        $providerName,
        $providerEmail,
        $providerContact,
        $username,
        $password,
        $providerType
    );

    if ($result) {

        header(
            "Location: dashboard.php?provider=added"
        );

        exit();

    } else {

        $error = "Provider could not be added.";
    }
}

}


/* =========================================
   DELETE ORGANIZATION PROVIDER
========================================= */

if (
    isset($_GET["action"])
    && $_GET["action"] === "delete_provider"
    && isset($_GET["provider_id"])
) {

    $providerId = (int) $_GET["provider_id"];


    if ($providerId > 0) {

        $result = deleteOrganizationProvider(
            $providerId,
            $organizationId
        );


        if ($result) {

            header(
                "Location: dashboard.php?provider=deleted"
            );

            exit();

        } else {

            $error =
                "Provider could not be deleted.";

        }

    }

}


/* =========================================
   UPDATE PROVIDER STATUS
========================================= */

if (
    isset($_GET["action"])
    && $_GET["action"] === "update_provider_status"
    && isset($_GET["provider_id"])
    && isset($_GET["status"])
) {

    $providerId = (int) $_GET["provider_id"];

    $status = trim(
        $_GET["status"]
    );


    if (
        $providerId > 0
        && (
            $status === "Active"
            || $status === "Inactive"
        )
    ) {

        $result = updateOrganizationProviderStatus(
            $providerId,
            $organizationId,
            $status
        );


        if ($result) {

            header(
                "Location: dashboard.php?provider=status_updated"
            );

            exit();

        } else {

            $error =
                "Provider status could not be updated.";

        }

    } else {

        $error =
            "Invalid provider status.";

    }

}


/* =========================================
   ADD FUND / DONATION
========================================= */

if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && isset($_POST["action"])
    && $_POST["action"] === "add_donation"
) {

    $donorName = trim(
        $_POST["donor_name"] ?? ""
    );

    $amount = isset($_POST["amount"])
        ? (float) $_POST["amount"]
        : 0;

    $purpose = trim(
        $_POST["purpose"] ?? ""
    );

    $receivedAt = trim(
        $_POST["received_at"] ?? ""
    );


    if ($donorName === "") {

        $error =
            "Please enter donor name.";

    } elseif ($amount <= 0) {

        $error =
            "Please enter a valid amount.";

    } elseif ($purpose === "") {

        $error =
            "Please enter fund purpose.";

    } elseif ($receivedAt === "") {

        $error =
            "Please select received date.";

    } else {

        $result = addOrganizationDonation(
            $organizationId,
            $donorName,
            $amount,
            $purpose,
            $receivedAt
        );


        if ($result) {

            header(
                "Location: dashboard.php?fund=added"
            );

            exit();

        } else {

            $error =
                "Fund could not be added.";

        }

    }

}


/* =========================================
   SUCCESS MESSAGE
========================================= */

if (isset($_GET["service"])) {

    if ($_GET["service"] === "added") {

        $success =
            "Emergency service added successfully.";

    } elseif ($_GET["service"] === "deleted") {

        $success =
            "Emergency service deleted successfully.";

    }

}


if (isset($_GET["provider"])) {

    if ($_GET["provider"] === "added") {

        $success =
            "Provider added successfully.";

    } elseif ($_GET["provider"] === "deleted") {

        $success =
            "Provider deleted successfully.";

    } elseif (
        $_GET["provider"] === "status_updated"
    ) {

        $success =
            "Provider status updated successfully.";

    }

}


if (
    isset($_GET["fund"])
    && $_GET["fund"] === "added"
) {

    $success =
        "Fund added successfully.";

}


/* =========================================
   GET EMERGENCY SERVICES
========================================= */

$services = getOrganizationServices(
    $organizationId
);


/* =========================================
   GET PROVIDERS
========================================= */

$providers = getOrganizationProviders(
    $organizationId
);


/* =========================================
   GET REVIEWS
========================================= */

$reviews = getOrganizationReviews(
    $organizationId
);


$averageRating = getOrganizationAverageRating(
    $organizationId
);


$totalReviews = getOrganizationTotalReviews(
    $organizationId
);


/* =========================================
   GET DONATIONS
========================================= */

$donations = getOrganizationDonations(
    $organizationId
);


/* =========================================
   GET FUND STATISTICS
========================================= */

$totalFund = getOrganizationTotalFund(
    $organizationId
);


$receivedFund = getOrganizationReceivedFund(
    $organizationId
);


$allocatedFund = getOrganizationAllocatedFund(
    $organizationId
);


/* =========================================
   GET ORGANIZATION REPORT
========================================= */

$report = getOrganizationReport(
    $organizationId
);


/* =========================================
   LOAD DASHBOARD VIEW
========================================= */

require_once __DIR__
    . "/../../view/organization/dashboard.php";

?>