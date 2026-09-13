<?php

session_start();


if(!isset($_SESSION["admin_id"]))
{
    header("Location: ../auth/login.php");
    exit();
}


require_once "../../model/admin/DashboardModel.php";


$citizens = countCitizens();

$providers = countProviders();

$organizations = countOrganizations();

$requests = countPendingRequests();


?>


<!DOCTYPE html>
<html>

<head>

<title>Admin Dashboard</title>

<link rel="stylesheet" href="../../assets/css/admin.css">

</head>


<body>


<div class="admin-container">



<h1>
🚑 Emergency Help Hub
</h1>



<h2>
Welcome, <?php echo $_SESSION["name"]; ?>
</h2>





<!-- Statistics -->

<div class="stats">


<div class="card">

<h2>
<?= $citizens ?>
</h2>

<p>
Total Citizens
</p>

</div>




<div class="card">

<h2>
<?= $providers ?>
</h2>

<p>
Total Service Providers
</p>

</div>





<div class="card">

<h2>
<?= $organizations ?>
</h2>

<p>
Total Organizations
</p>

</div>





<div class="card">

<h2>
<?= $requests ?>
</h2>

<p>
Pending Requests
</p>

</div>



</div>







<br><br>







<!-- Management Cards -->


<div class="cards">





<div class="card">

<h3>
Citizens
</h3>


<p>
Manage registered citizens
</p>


<a href="citizens.php">
View
</a>


</div>







<div class="card">

<h3>
Service Providers
</h3>


<p>
Manage emergency providers
</p>


<a href="providers.php">
View
</a>


</div>







<div class="card">

<h3>
Organizations
</h3>


<p>
Manage organizations
</p>


<a href="organizations.php">
View
</a>


</div>







<div class="card">

<h3>
Emergency Requests
</h3>


<p>
Manage emergency requests
</p>


<a href="emergency_requests.php">
View
</a>


</div>







<div class="card">

<h3>
Funds
</h3>


<p>
Manage donations and funds
</p>


<a href="funds.php">
View
</a>


</div>







<div class="card">

<h3>
Notifications
</h3>


<p>
Send announcements
</p>


<a href="notifications.php">
View
</a>


</div>





</div>




</div>



</body>


</html>