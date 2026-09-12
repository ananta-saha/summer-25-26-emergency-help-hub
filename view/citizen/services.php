<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Emergency Services</title>

<link rel="stylesheet" href="../../assets/css/citizen.css">
</head>

<body class="servicesHub">

<header>
<h2 class="early">Emergency Help Hub</h2>

<nav class="serviceNav">
<a href="../../controller/citizen/dashboard.php">Dashboard</a>
<a href="../../controller/citizen/request-status.php">My Requests</a>
<a href="../../controller/citizen/profile.php">Profile</a>
<a href="../../controller/citizen/logout.php">Logout</a>
</nav>
</header>


<main class="container">

<h1>Find Emergency Services</h1>

<p>Select the emergency service you need.</p>


<div class="search-box">

<form method="POST" id="serviceForm">

<label>Your Location</label>

<input
type="text"
id="location"
name="location"
placeholder="Use GPS location"
value="<?= htmlspecialchars($location) ?>"
readonly
>

<input type="hidden" id="latitude" name="latitude">
<input type="hidden" id="longitude" name="longitude">


<button type="button" onclick="getLocation()">
Use My Location
</button>


<label>Emergency Service</label>

<select name="serviceType" id="serviceType">

<option value="" disabled <?= $serviceType == "" ? "selected" : "" ?>>
Select Service
</option>

<option value="Ambulance" <?= $serviceType=="Ambulance"?"selected":"" ?>>
Ambulance
</option>

<option value="Fire Service" <?= $serviceType=="Fire Service"?"selected":"" ?>>
Fire Service
</option>

<option value="Police" <?= $serviceType=="Police"?"selected":"" ?>>
Police
</option>

<option value="Hospital" <?= $serviceType=="Hospital"?"selected":"" ?>>
Hospital
</option>

</select>


<button type="submit">
Search
</button>


</form>

</div>


<?php if($dbErr!=""): ?>

<p>
<?= htmlspecialchars($dbErr) ?>
</p>

<?php endif; ?>



<div id="serviceResults">


<?php if($searched && count($services)>0): ?>


<?php foreach($services as $service): ?>


<div class="service-card">


<h3>
<?= htmlspecialchars($service["service_type"]) ?>
</h3>


<p>
Provider:
<?= htmlspecialchars($service["provider_name"]) ?>
</p>


<p>
Phone:
<?= htmlspecialchars($service["phone"]) ?>
</p>


<p>
Location:
<?= htmlspecialchars($service["address"]) ?>
</p>


<?php if(isset($service["distance"])): ?>

<p>
Distance:
<?= round($service["distance"],2) ?> KM
</p>

<?php endif; ?>


<p>
Status:
<strong>
<?= htmlspecialchars($service["availability_status"]) ?>
</strong>
</p>



<!-- REQUEST SERVICE BUTTON -->

<form method="GET" action="../../controller/citizen/emergency-request.php">

<input
type="hidden"
name="service"
value="<?= htmlspecialchars($service["service_type"]) ?>"
>


<button type="submit">
Request Service
</button>


</form>


</div>


<?php endforeach; ?>


<?php elseif($searched): ?>


<p>
No service provider found.
</p>


<?php endif; ?>


</div>


</main>



<footer>

<p>
© 2026 Emergency Finder - Citizen Portal.
</p>

</footer>



<script>

function getLocation()
{
    if(navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(
        function(position)
        {
            document.getElementById("latitude").value =
            position.coords.latitude;

            document.getElementById("longitude").value =
            position.coords.longitude;

            document.getElementById("location").value =
            "GPS Location";

            alert("Location detected successfully");
        },

        function()
        {
            alert("Location permission denied");
        });
    }
    else
    {
        alert("GPS is not supported");
    }
}

</script>


<script src="../../assets/js/script.js"></script>


</body>

</html>