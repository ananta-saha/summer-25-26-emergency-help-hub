<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Provider Dashboard</title>

<link rel="stylesheet" href="../../assets/css/provider.css">
</head>

<body>

<header>

<h2>🚑 Emergency Help Hub</h2>

<nav>
<a href="../../controller/provider/dashboard.php">Dashboard</a>
<a href="../../controller/provider/requests.php">Requests</a>
<a href="../../controller/provider/logout.php">Logout</a>
</nav>

</header>


<main class="dashboard-container">

<h1>
Welcome, <?= htmlspecialchars($provider["provider_name"]) ?>
</h1>

<h2>
Emergency Service Provider Dashboard
</h2>


<div class="dashboard-cards">

<div class="dashboard-card">
<h2><?= $totalRequests ?></h2>
<p>Total Requests</p>
</div>

<div class="dashboard-card">
<h2><?= $pendingRequests ?></h2>
<p>Pending Requests</p>
</div>

<div class="dashboard-card">
<h2><?= $acceptedRequests ?></h2>
<p>Accepted Requests</p>
</div>

<div class="dashboard-card">
<h2><?= $completedRequests ?></h2>
<p>Completed Requests</p>
</div>

</div>


<div class="request-card">

<h2>
Provider Information
</h2>

<p>
<strong>Name:</strong>
<?= htmlspecialchars($provider["provider_name"]) ?>
</p>

<p>
<strong>Email:</strong>
<?= htmlspecialchars($provider["email"]) ?>
</p>

<p>
<strong>Service Type:</strong>
<?= htmlspecialchars($provider["service_type"]) ?>
</p>

<p>
<strong>Phone:</strong>
<?= htmlspecialchars($provider["phone"]) ?>
</p>

<p>
<strong>Address:</strong>
<?= htmlspecialchars($provider["address"]) ?>
</p>

<p>
<strong>Status:</strong>

<span class="status Accepted">
<?= htmlspecialchars($provider["status"]) ?>
</span>

</p>


<p>
<strong>Availability:</strong>
<?= htmlspecialchars($provider["availability_status"]) ?>
</p>


</div>


<div class="actions">

<a href="../../controller/provider/requests.php">
<button type="button">
View Emergency Requests
</button>
</a>


<a href="../../controller/provider/availability.php">
<button type="button">
Update Availability
</button>
</a>

</div>


</main>


<footer>

<p>
© 2026 Emergency Help Hub - Provider Portal
</p>

</footer>


</body>
</html>