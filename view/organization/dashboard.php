<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Organization Dashboard
    </title>


    <link
        rel="stylesheet"
        href="../../assets/css/style.css"
    >


    <link
        rel="stylesheet"
        href="../../assets/css/organization.css"
    >

</head>


<body>


<div class="organization-dashboard">


<!-- =========================
     HEADER / LOGOUT
========================= -->

<div class="org-header">

    <h2>
        🚑 Emergency Help Hub
    </h2>


    <a href="../../controller/organization/logout.php">
        Logout
    </a>


</div>



<!-- =========================
     WELCOME
========================= -->


<div class="org-welcome">


    <h1>

        Welcome,

        <?php

        echo htmlspecialchars(
            $_SESSION["organization_name"] ?? "Organization"
        );

        ?>

    </h1>



    <p>

        Manage your organization,
        providers,
        emergency services,
        funds,
        reviews and reports
        from one place.

    </p>


</div>





<!-- =========================
     QUICK NAVIGATION
========================= -->


<div class="quick-nav">


    <h3>
        Quick Navigation
    </h3>



    <a href="#services">
        Emergency Services
    </a>



    <a href="#providers">
        Manage Providers
    </a>



    <a href="#funds">
        Fund / Donation
    </a>



    <a href="#reviews">
        Ratings & Reviews
    </a>



    <a href="#report">
        Organization Report
    </a>



</div>



    <!-- =========================
         ERROR MESSAGE
    ========================= -->

    <?php if (!empty($error)): ?>

        <div class="error-message">

            <?php
            echo htmlspecialchars($error);
            ?>

        </div>

    <?php endif; ?>



    <!-- =========================
         SUCCESS MESSAGE
    ========================= -->

    <?php if (!empty($success)): ?>

        <div class="success-message">

            <?php
            echo htmlspecialchars($success);
            ?>

        </div>

    <?php endif; ?>



    <!-- =========================
         DASHBOARD STATISTICS
    ========================= -->

    <div class="org-section">


        <h2>
            Dashboard Statistics
        </h2>


        <div class="org-statistics">


            <!-- TOTAL FUND -->

            <div class="org-stat-card">

                <h3>
                    Total Fund
                </h3>


                <p>

                    <?php

                    echo htmlspecialchars(
                        $totalFund ?? 0
                    );

                    ?>

                </p>

            </div>



            <!-- RECEIVED FUND -->

            <div class="org-stat-card">

                <h3>
                    Received Fund
                </h3>


                <p>

                    <?php

                    echo htmlspecialchars(
                        $receivedFund ?? 0
                    );

                    ?>

                </p>

            </div>



            <!-- ALLOCATED FUND -->

            <div class="org-stat-card">

                <h3>
                    Allocated Fund
                </h3>


                <p>

                    <?php

                    echo htmlspecialchars(
                        $allocatedFund ?? 0
                    );

                    ?>

                </p>

            </div>


        </div>


    </div>



    <!-- =========================
         EMERGENCY SERVICES
    ========================= -->

    <div
        class="org-section"
        id="services"
    >


        <h2>
            Emergency Services
        </h2>


        <!-- ADD SERVICE -->

        <h3>
            Add Emergency Service
        </h3>


        <form method="POST">


            <input
                type="hidden"
                name="action"
                value="add_service"
            >


            <label>
                Service Name
            </label>


            <input
                type="text"
                name="service_name"
                required
            >



            <label>
                Service Type
            </label>


            <input
                type="text"
                name="service_type"
                required
            >



            <label>
                Hotline
            </label>


            <input
                type="text"
                name="hotline"
                required
            >



            <label>
                Coverage Area
            </label>


            <input
                type="text"
                name="coverage_area"
                required
            >



            <button
                type="submit"
                class="org-btn"
            >

                Add Service

            </button>


        </form>



        <!-- SERVICE LIST -->

        <h3>
            Emergency Service List
        </h3>


        <?php if (empty($services)): ?>


            <p>
                No service found.
            </p>


        <?php else: ?>


            <table class="org-table">


                <tr>

                    <th>
                        ID
                    </th>

                    <th>
                        Service Name
                    </th>

                    <th>
                        Type
                    </th>

                    <th>
                        Hotline
                    </th>

                    <th>
                        Coverage Area
                    </th>

                    <th>
                        Action
                    </th>

                </tr>



                <?php foreach ($services as $service): ?>


                    <tr>


                        <td>

                            <?php

                            echo htmlspecialchars(
                                $service["service_id"]
                            );

                            ?>

                        </td>



                        <td>

                            <?php

                            echo htmlspecialchars(
                                $service["service_name"]
                            );

                            ?>

                        </td>



                        <td>

                            <?php

                            echo htmlspecialchars(
                                $service["service_type"]
                            );

                            ?>

                        </td>



                        <td>

                            <?php

                            echo htmlspecialchars(
                                $service["hotline"]
                            );

                            ?>

                        </td>



                        <td>

                            <?php

                            echo htmlspecialchars(
                                $service["coverage_area"]
                            );

                            ?>

                        </td>



                        <td>


                            <a
                                class="org-delete-btn"
                                href="dashboard.php?action=delete_service&service_id=<?php echo $service['service_id']; ?>"
                                onclick="return confirm('Delete this service?');"
                            >

                                Delete

                            </a>


                        </td>


                    </tr>


                <?php endforeach; ?>


            </table>


        <?php endif; ?>


    </div>



    <!-- =========================
         PROVIDER MANAGEMENT
    ========================= -->

    <div
        class="org-section"
        id="providers"
    >


        <h2>
            Provider Management
        </h2>



        <!-- =========================
             ADD PROVIDER
        ========================= -->

        <h3>
            Add Provider
        </h3>


        <form method="POST">


            <input
                type="hidden"
                name="action"
                value="add_provider"
            >



            <label>
                Provider Name
            </label>


            <input
                type="text"
                name="provider_name"
                required
            >



            <label>
                Provider Email
            </label>


            <input
                type="email"
                name="provider_email"
                required
            >



            <label>
                Provider Contact
            </label>


            <input
                type="text"
                name="provider_contact"
                required
            >



            <label>
                Username
            </label>


            <input
                type="text"
                name="username"
                required
            >



            <label>
                Password
            </label>


            <input
                type="password"
                name="password"
                required
            >



            <label>
                Provider Type
            </label>


            <select
                name="provider_type"
                required
            >


                <option value="">
                    Select Provider Type
                </option>


                <option value="Ambulance">
                    Ambulance
                </option>


                <option value="Fire Service">
                    Fire Service
                </option>


                <option value="Police">
                    Police
                </option>


                <option value="Rescue">
                    Rescue
                </option>


                <option value="Medical">
                    Medical
                </option>


                <option value="Other">
                    Other
                </option>


            </select>



            <button
                type="submit"
                class="org-btn"
            >

                Add Provider

            </button>


        </form>



        <!-- =========================
             PROVIDER LIST
        ========================= -->

        <h3>
            Provider List
        </h3>


        <?php if (empty($providers)): ?>


            <p>
                No provider found.
            </p>


        <?php else: ?>


            <table class="org-table">


                <tr>


                    <th>
                        ID
                    </th>


                    <th>
                        Provider Name
                    </th>


                    <th>
                        Email
                    </th>


                    <th>
                        Contact
                    </th>


                    <th>
                        Username
                    </th>


                    <th>
                        Provider Type
                    </th>


                    <th>
                        Action
                    </th>


                </tr>



                <?php foreach ($providers as $provider): ?>


                    <tr>


                        <td>

                            <?php

                            echo htmlspecialchars(
                                $provider[
                                    "organization_provider_id"
                                ]
                            );

                            ?>

                        </td>



                        <td>

                            <?php

                            echo htmlspecialchars(
                                $provider[
                                    "provider_name"
                                ]
                            );

                            ?>

                        </td>



                        <td>

                            <?php

                            echo htmlspecialchars(
                                $provider[
                                    "provider_email"
                                ]
                            );

                            ?>

                        </td>



                        <td>

                            <?php

                            echo htmlspecialchars(
                                $provider[
                                    "provider_contact"
                                ]
                            );

                            ?>

                        </td>



                        <td>

                            <?php

                            echo htmlspecialchars(
                                $provider[
                                    "username"
                                ]
                            );

                            ?>

                        </td>



                        <td>

                            <?php

                            echo htmlspecialchars(
                                $provider[
                                    "provider_type"
                                ]
                            );

                            ?>

                        </td>



                        <td>


                            <a
                                class="org-delete-btn"
                                href="dashboard.php?action=delete_provider&provider_id=<?php echo $provider['organization_provider_id']; ?>"
                                onclick="return confirm('Delete this provider?');"
                            >

                                Delete

                            </a>


                        </td>


                    </tr>


                <?php endforeach; ?>


            </table>


        <?php endif; ?>


    </div>



    <!-- =========================
         FUND / DONATION
    ========================= -->

    <div
        class="org-section"
        id="funds"
    >


        <h2>
            Fund / Donation Management
        </h2>



        <!-- ADD FUND -->

        <h3>
            Add Fund / Donation
        </h3>


        <form method="POST">


            <input
                type="hidden"
                name="action"
                value="add_donation"
            >



            <label>
                Donor Name
            </label>


            <input
                type="text"
                name="donor_name"
                required
            >



            <label>
                Amount
            </label>


            <input
                type="number"
                step="0.01"
                name="amount"
                required
            >



            <label>
                Purpose
            </label>


            <input
                type="text"
                name="purpose"
                required
            >



            <label>
                Received Date
            </label>


            <input
                type="date"
                name="received_at"
                required
            >



            <button
                type="submit"
                class="org-btn"
            >

                Add Fund

            </button>


        </form>



        <!-- DONATION LIST -->

        <h3>
            Donation List
        </h3>


        <?php if (empty($donations)): ?>


            <p>
                No donation found.
            </p>


        <?php else: ?>


            <table class="org-table">


                <tr>

                    <th>
                        Donor
                    </th>

                    <th>
                        Amount
                    </th>

                    <th>
                        Purpose
                    </th>

                    <th>
                        Date
                    </th>

                    <th>
                        Status
                    </th>

                </tr>



                <?php foreach ($donations as $donation): ?>


                    <tr>


                        <td>

                            <?php

                            echo htmlspecialchars(
                                $donation["donor_name"]
                            );

                            ?>

                        </td>



                        <td>

                            <?php

                            echo htmlspecialchars(
                                $donation["amount"]
                            );

                            ?>

                        </td>



                        <td>

                            <?php

                            echo htmlspecialchars(
                                $donation["purpose"]
                            );

                            ?>

                        </td>



                        <td>

                            <?php

                            echo htmlspecialchars(
                                $donation["received_at"]
                            );

                            ?>

                        </td>



                        <td>

                            <?php

                            echo htmlspecialchars(
                                $donation["status"]
                            );

                            ?>

                        </td>


                    </tr>


                <?php endforeach; ?>


            </table>


        <?php endif; ?>


    </div>



    <!-- =========================
         RATINGS & REVIEWS
    ========================= -->

    <div
        class="org-section"
        id="reviews"
    >


        <h2>
            Ratings & Reviews
        </h2>


        <div class="org-review-summary">


            <!-- AVERAGE RATING -->

            <div class="org-review-card">


                <h3>
                    Average Rating
                </h3>


                <p>

                    ⭐

                    <?php

                    echo htmlspecialchars(
                        $averageRating ?? 0
                    );

                    ?>

                    / 5

                </p>


            </div>



            <!-- TOTAL REVIEWS -->

            <div class="org-review-card">


                <h3>
                    Total Reviews
                </h3>


                <p>

                    <?php

                    echo htmlspecialchars(
                        $totalReviews ?? 0
                    );

                    ?>

                </p>


            </div>


        </div>



        <!-- REVIEW LIST -->

        <h3>
            Review List
        </h3>


        <?php if (empty($reviews)): ?>


            <p>
                No reviews found.
            </p>


        <?php else: ?>


            <table class="org-table">


                <tr>

                    <th>
                        Provider
                    </th>

                    <th>
                        Citizen Name
                    </th>

                    <th>
                        Rating
                    </th>

                    <th>
                        Review
                    </th>

                    <th>
                        Date
                    </th>

                </tr>



                <?php foreach ($reviews as $review): ?>


                    <tr>


                        <td>

                            <?php

                            echo htmlspecialchars(

                                !empty(
                                    $review["provider_name"]
                                )

                                ? $review["provider_name"]

                                : "Organization"

                            );

                            ?>

                        </td>



                        <td>

                            <?php

                            echo htmlspecialchars(
                                $review["citizen_name"]
                            );

                            ?>

                        </td>



                        <td>

                            ⭐

                            <?php

                            echo htmlspecialchars(
                                $review["rating"]
                            );

                            ?>

                            / 5

                        </td>



                        <td>

                            <?php

                            echo htmlspecialchars(
                                $review["review"]
                            );

                            ?>

                        </td>



                        <td>

                            <?php

                            echo htmlspecialchars(
                                $review["created_at"]
                            );

                            ?>

                        </td>


                    </tr>


                <?php endforeach; ?>


            </table>


        <?php endif; ?>


    </div>



    <!-- =========================
         ORGANIZATION REPORT
    ========================= -->

    <div
        class="org-section"
        id="report"
    >


        <h2>
            Organization Report
        </h2>


        <div class="org-report-box">


            <!-- TOTAL SERVICES -->

            <p>

                <strong>
                    Total Services:
                </strong>


                <?php

                echo isset(
                    $report["total_services"]
                )

                ? $report["total_services"]

                : 0;

                ?>

            </p>



            <!-- TOTAL PROVIDERS -->

            <p>

                <strong>
                    Total Providers:
                </strong>


                <?php

                echo isset(
                    $report["total_providers"]
                )

                ? $report["total_providers"]

                : 0;

                ?>

            </p>



            <!-- TOTAL DONATIONS -->

            <p>

                <strong>
                    Total Donations:
                </strong>


                <?php

                echo isset(
                    $report["total_donations"]
                )

                ? $report["total_donations"]

                : 0;

                ?>

            </p>



            <!-- TOTAL FUND -->

            <p>

                <strong>
                    Total Fund:
                </strong>


                <?php

                echo isset(
                    $report["total_fund"]
                )

                ? $report["total_fund"]

                : 0;

                ?>

            </p>



            <!-- AVERAGE RATING -->

            <p>

                <strong>
                    Average Rating:
                </strong>


                ⭐


                <?php

                echo htmlspecialchars(
                    $averageRating ?? 0
                );

                ?>


                / 5


            </p>


        </div>


    </div>


</div>


</body>

</html>