<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Emergency Request</title>

<link rel="stylesheet" href="../../assets/css/citizen.css">
</head>

<body class="servicesHub">

<header class="navbar">

<h2 class="early">
Emergency Help Hub
</h2>

<nav class="serviceNav">

<a href="../../controller/citizen/dashboard.php">
Dashboard
</a>

<a href="../../controller/citizen/services.php">
Services
</a>

<a href="../../controller/citizen/request-status.php">
My Requests
</a>

<a href="../../controller/citizen/profile.php">
Profile
</a>

<a href="../../controller/citizen/logout.php">
Logout
</a>

</nav>

</header>


<main class="containers">


<form method="POST" action="../../controller/citizen/emergency-request.php" id="requestForm">


<input type="hidden" name="service" value="<?= htmlspecialchars($emService) ?>">


<h2>
Emergency Request
</h2>


<?php if(!empty($error)): ?>

<p>
<?= htmlspecialchars($error) ?>
</p>

<?php endif; ?>



<div class="field">

<label>
Emergency Service
</label>

<input
type="text"
name="emService"
value="<?= htmlspecialchars($emService) ?>"
readonly>

</div>



<div class="field">

<label>
Emergency Type
</label>

<select name="emergencyType" required>

<option value="">
Select Emergency Type
</option>

<option value="Accident"
<?= ($emergencyType=="Accident") ? "selected" : "" ?>>
Accident
</option>

<option value="Medical Emergency"
<?= ($emergencyType=="Medical Emergency") ? "selected" : "" ?>>
Medical Emergency
</option>

<option value="Fire"
<?= ($emergencyType=="Fire") ? "selected" : "" ?>>
Fire
</option>

<option value="Other"
<?= ($emergencyType=="Other") ? "selected" : "" ?>>
Other
</option>

</select>

</div>



<div class="field">

<label>
Number of People
</label>

<input
type="number"
name="people"
min="1"
value="<?= htmlspecialchars($people) ?>"
required>

</div>



<div class="field">

<label>
Number of Vehicles
</label>

<input
type="number"
name="vehicles"
min="1"
value="<?= htmlspecialchars($vehicles) ?>"
required>

</div>



<div class="field">

<label>
Emergency Location
</label>

<input
type="text"
name="emergencyLocation"
value="<?= htmlspecialchars($emergencyLocation) ?>"
required>

</div>



<div class="field">

<label>
Additional Details
</label>

<textarea name="details"><?= htmlspecialchars($details) ?></textarea>

</div>



<button type="submit" class="primary-btn">
Send Emergency Request
</button>


</form>


</main>


<script src="../../assets/js/script.js"></script>

</body>

</html>