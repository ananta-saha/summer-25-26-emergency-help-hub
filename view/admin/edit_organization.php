<?php

session_start();

require_once "../../model/admin/OrganizationManagementModel.php";


if(!isset($_SESSION["admin_id"]))
{
    header("Location: ../auth/login.php");
    exit();
}



if(!isset($_GET["id"]))
{
    header("Location: organizations.php");
    exit();
}



$id = $_GET["id"];


$organization = getOrganizationById($id);



?>


<!DOCTYPE html>
<html>

<head>

<title>Edit Organization</title>

<link rel="stylesheet" href="../../assets/css/admin.css">

</head>


<body>


<div class="admin-container">


<h1>
Edit Organization
</h1>



<form method="POST"
action="../../controller/admin/OrganizationController.php">


<input 
type="hidden"
name="id"
value="<?= $organization["id"] ?>">



<label>
Organization Name
</label>

<br>


<input
type="text"
name="name"
value="<?= $organization["name"] ?>"
required>


<br><br>



<label>
Email
</label>

<br>


<input
type="email"
name="email"
value="<?= $organization["email"] ?>"
required>


<br><br>




<label>
Phone
</label>

<br>


<input
type="text"
name="phone"
value="<?= $organization["phone"] ?>">


<br><br>




<label>
Address
</label>

<br>


<input
type="text"
name="address"
value="<?= $organization["address"] ?>">


<br><br>




<label>
Type
</label>

<br>


<input
type="text"
name="type"
value="<?= $organization["type"] ?>">



<br><br>



<button name="update_organization">

Update Organization

</button>



</form>



</div>


</body>

</html>