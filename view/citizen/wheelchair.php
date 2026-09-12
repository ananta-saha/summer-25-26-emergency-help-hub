<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Wheelchair Requirement</title>
<link rel="stylesheet" href="../../assets/css/citizen.css">
</head>

<body class="WheelchairHub">

<header>
<h2 class="early">Emergency Help Hub</h2>
</header>

<main class="cntrs">

<h1>Wheelchair Requirement</h1>

<?php if(!empty($error)): ?>
<p style="color:red;"><?= htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="POST" action="../../controller/citizen/wheelchair.php">

<p>Does the patient need a wheelchair?</p>

<input type="radio" id="wheelchairNo" name="wheelchair" value="No" class="toggle-no" <?= ($wheelchair=="No") ? "checked" : ""; ?>>
<label for="wheelchairNo" class="radio-label">No</label>

<input type="radio" id="wheelchairYes" name="wheelchair" value="Yes" class="toggle-yes" <?= ($wheelchair=="Yes") ? "checked" : ""; ?>>
<label for="wheelchairYes" class="radio-label">Yes</label>

<div class="wheelchair-count-box">

<label for="wheelchairNumber">Number of Wheelchairs</label>

<input 
type="number" 
id="wheelchairNumber" 
name="wheelchairNumber" 
min="1" 
placeholder="Enter quantity"
value="<?= htmlspecialchars($wheelchairNumber); ?>"
>

</div>

<div class="btnss">

<button type="submit" class="primary-btn">
Continue
</button>

<a href="../../controller/citizen/dashboard.php">
<button type="button" class="secondary-btn">
Dashboard
</button>
</a>

</div>

</form>

</main>

<footer>
<p>© 2026 Emergency Finder - Citizen Portal.</p>
</footer>

</body>
</html>