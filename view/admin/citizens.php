<?php

session_start();

if(!isset($_SESSION["admin_id"]))
{
    header("Location: ../auth/login.php");
    exit();
}


require_once "../../controller/admin/AdminController.php";

?>


<!DOCTYPE html>
<html>

<head>

<title>Citizens</title>

<link rel="stylesheet" href="../../assets/css/admin.css">

</head>


<body>


<div class="admin-container">


<h1>Citizens Management</h1>


<table border="1" cellpadding="10">


<tr>

<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Status</th>

</tr>



<?php foreach($citizens as $citizen): ?>


<tr>


<td>
<?= $citizen["citizen_id"] ?>
</td>


<td>
<?= $citizen["name"] ?>
</td>


<td>
<?= $citizen["email"] ?>
</td>


<td>
<?= $citizen["phone"] ?>
</td>


<td>
<?= $citizen["status"] ?>
</td>


</tr>



<?php endforeach; ?>


</table>


<br>


<a href="dashboard.php">
Back Dashboard
</a>


</div>


</body>

</html>