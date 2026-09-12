<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Emergency Requests</title>
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


<h1>Emergency Requests</h1>


<?php if(count($requests) > 0): ?>


<?php foreach($requests as $request): ?>


<div class="request-card">


<h2>
🚨 Request ID: <?= htmlspecialchars($request["request_id"]) ?>
</h2>


<p>
<strong>Status:</strong>

<span class="status <?= htmlspecialchars($request["status"]) ?>">
<?= htmlspecialchars($request["status"]) ?>
</span>
</p>


<p>
<strong>Service:</strong>
<?= htmlspecialchars($request["service_type"]) ?>
</p>


<p>
<strong>Emergency Type:</strong>
<?= htmlspecialchars($request["emergency_type"]) ?>
</p>


<p>
<strong>Location:</strong>
📍 <?= htmlspecialchars($request["location"]) ?>
</p>


<p>
<strong>People Count:</strong>
👥 <?= htmlspecialchars($request["people_count"]) ?>
</p>


<p>
<strong>Vehicles Required:</strong>
🚑 <?= htmlspecialchars($request["vehicles_requested"]) ?>
</p>


<p>
<strong>Details:</strong>
<?= htmlspecialchars($request["details"]) ?>
</p>



<p>
<strong>Wheelchair:</strong>

<?php if($request["wheelchair_required"] == 1): ?>

Yes
(<?= htmlspecialchars($request["wheelchair_count"]) ?>)

<?php else: ?>

No

<?php endif; ?>

</p>



<p>
<strong>Injury:</strong>

<?= $request["injury_present"] == 1 ? "Yes" : "No" ?>

</p>



<?php if($request["injury_present"] == 1): ?>


<p>
<strong>Injury Level:</strong>

<?= htmlspecialchars($request["injury_level"]) ?>

</p>


<p>
<strong>Injury Description:</strong>

<?= htmlspecialchars($request["injury_description"]) ?>

</p>


<?php endif; ?>



<p>
<strong>Request Time:</strong>

<?= htmlspecialchars($request["request_time"]) ?>

</p>



<?php if(!empty($request["accepted_at"])): ?>

<p>
<strong>Accepted At:</strong>

<?= htmlspecialchars($request["accepted_at"]) ?>

</p>

<?php endif; ?>



<?php if(!empty($request["completed_at"])): ?>

<p>
<strong>Completed At:</strong>

<?= htmlspecialchars($request["completed_at"]) ?>

</p>

<?php endif; ?>




<div class="actions">


<?php if($request["status"] == "Pending"): ?>


<a href="../../controller/provider/update-status.php?id=<?= $request["request_id"] ?>&status=Accepted">

<button type="button">
Accept
</button>

</a>



<a href="../../controller/provider/update-status.php?id=<?= $request["request_id"] ?>&status=Rejected">

<button type="button">
Reject
</button>

</a>



<?php elseif($request["status"] == "Accepted"): ?>


<a href="../../controller/provider/update-status.php?id=<?= $request["request_id"] ?>&status=Completed">

<button type="button">
Complete
</button>

</a>



<?php elseif($request["status"] == "Rejected"): ?>


<p style="color:#dc2626;font-weight:bold;">
❌ Request Rejected
</p>



<?php elseif($request["status"] == "Completed"): ?>


<p style="color:#16a34a;font-weight:bold;">
✅ Request Completed
</p>



<?php endif; ?>


</div>


</div>


<?php endforeach; ?>


<?php else: ?>


<p>
No emergency requests available.
</p>


<?php endif; ?>


</main>



<footer>

<p>
© 2026 Emergency Help Hub - Provider Portal
</p>

</footer>


</body>

</html>