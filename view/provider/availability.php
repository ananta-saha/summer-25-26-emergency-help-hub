<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Provider Availability</title>

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



<main class="container">


<div class="request-card">


<h2>Update Availability</h2>


<form method="POST">


<p>
<strong>Select Availability Status</strong>
</p>


<select name="availability">

<option value="Available"
<?= (isset($availability) && $availability=="Available") ? "selected" : "" ?>>
Available
</option>

<option value="Busy"
<?= (isset($availability) && $availability=="Busy") ? "selected" : "" ?>>
Busy
</option>

<option value="Unavailable"
<?= (isset($availability) && $availability=="Unavailable") ? "selected" : "" ?>>
Unavailable
</option>

</select>


<br><br>


<div class="actions">

<button type="submit">
Save
</button>


<a href="../../controller/provider/dashboard.php">

<button type="button">
Dashboard
</button>

</a>


</div>


</form>


</div>


</main>



<footer>

<p>
© 2026 Emergency Help Hub - Provider Portal
</p>

</footer>


</body>

</html>