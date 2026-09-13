<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Injury Information</title>

<link rel="stylesheet" href="../../assets/css/citizen.css">

</head>


<body class="WheelchairHub">


<h2 class="early">Emergency Help Hub</h2>


<main class="cntrs">


<h1>Injury Information</h1>


<?php if($error != ""): ?>

<p style="color:red;">
<?= htmlspecialchars($error); ?>
</p>

<?php endif; ?>


<form method="POST" action="../../controller/citizen/injury.php" id="injuryForm">


<p class="form-title">
Is there any injury?
</p>


<input
type="radio"
id="injuryNo"
name="injury"
value="No"
<?= ($injury == "No") ? "checked" : ""; ?>
>

<label for="injuryNo">
No
</label>


<input
type="radio"
id="injuryYes"
name="injury"
value="Yes"
<?= ($injury == "Yes") ? "checked" : ""; ?>
>

<label for="injuryYes">
Yes
</label>



<div class="injury-details-box">


<label for="injuryLevel">
Injury Level
</label>


<select id="injuryLevel" name="injuryLevel">

<option value="" <?= ($injuryLevel == "") ? "selected" : ""; ?>>
Select Injury Level
</option>

<option value="Minor" <?= ($injuryLevel == "Minor") ? "selected" : ""; ?>>
Minor
</option>

<option value="Moderate" <?= ($injuryLevel == "Moderate") ? "selected" : ""; ?>>
Moderate
</option>

<option value="Severe" <?= ($injuryLevel == "Severe") ? "selected" : ""; ?>>
Severe
</option>

<option value="Critical" <?= ($injuryLevel == "Critical") ? "selected" : ""; ?>>
Critical
</option>

</select>



<label for="injuryDescription">
Injury Description
</label>


<textarea
id="injuryDescription"
name="injuryDescription"
placeholder="Describe the injury"><?= htmlspecialchars($injuryDescription); ?></textarea>


</div>



<div class="btnss">


<button type="submit" class="primary-btn">
Submit Information
</button>


</div>


</form>


</main>



<footer>

<p>
© 2026 Emergency Finder - Citizen Portal.
</p>

</footer>

<script>

const injuryYes = document.getElementById("injuryYes");
const injuryNo = document.getElementById("injuryNo");

const injuryDetails = document.querySelector(".injury-details-box");

function showInjuryDetails()
{
    if(injuryYes.checked)
    {
        injuryDetails.style.display = "block";
    }
    else
    {
        injuryDetails.style.display = "none";
    }
}

injuryYes.addEventListener("change", showInjuryDetails);

injuryNo.addEventListener("change", showInjuryDetails);

showInjuryDetails();

</script>
</body>

</html>