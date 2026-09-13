<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Injury Information</title>

<link rel="stylesheet" href="../../assets/css/citizen.css">

</head>


<body class="WheelchairHub">


<h2 class="early">
Emergency Help Hub
</h2>



<main class="cntrs">


<h1>
Injury Information
</h1>



<?php if(isset($error) && $error != ""): ?>

<p style="color:red;">
<?= htmlspecialchars($error); ?>
</p>

<?php endif; ?>




<form method="POST" 
action="../../controller/citizen/injury.php"
id="injuryForm">





<p class="form-title">
Is there any injury?
</p>




<input 
type="radio"
id="injuryNo"
name="injury"
value="No"
onclick="hideInjury()"
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
onclick="showInjury()"
<?= ($injury == "Yes") ? "checked" : ""; ?>
>


<label for="injuryYes">
Yes
</label>






<div 
id="injuryBox"
class="injury-details-box"
style="<?= ($injury=="Yes") ? 'display:block;' : 'display:none;' ?>">





<label for="injuryLevel">
Injury Level
</label>



<select id="injuryLevel" name="injuryLevel">


<option value="">
Select Injury Level
</option>



<option value="Minor"
<?= ($injuryLevel=="Minor") ? "selected" : ""; ?>>
Minor
</option>



<option value="Moderate"
<?= ($injuryLevel=="Moderate") ? "selected" : ""; ?>>
Moderate
</option>



<option value="Severe"
<?= ($injuryLevel=="Severe") ? "selected" : ""; ?>>
Severe
</option>



<option value="Critical"
<?= ($injuryLevel=="Critical") ? "selected" : ""; ?>>
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


function showInjury()
{

    document.getElementById("injuryBox").style.display="block";

}



function hideInjury()
{

    document.getElementById("injuryBox").style.display="none";

}



</script>




</body>

</html>