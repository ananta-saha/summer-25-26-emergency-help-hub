<?php

session_start();


if(!isset($_SESSION["admin_id"]))
{
    header("Location: ../auth/login.php");
    exit();
}


?>


<!DOCTYPE html>

<html>


<head>

<title>
Add Service Provider
</title>


<link rel="stylesheet" href="../../assets/css/admin.css">


</head>



<body>



<div class="admin-container">



<h1>
Add Service Provider
</h1>




<form method="POST" 
action="../../controller/admin/ProviderController.php">



<label>
Provider Name
</label>

<br>


<input 
type="text"
name="name"
placeholder="Enter provider name"
required>



<br><br>




<label>
Email
</label>

<br>


<input 
type="email"
name="email"
placeholder="Enter email"
required>



<br><br>




<label>
Phone
</label>

<br>


<input 
type="text"
name="phone"
placeholder="Enter phone number"
required>



<br><br>




<label>
Service Type
</label>

<br>


<input 
type="text"
name="service_type"
placeholder="Ambulance / Hospital / Fire Service"
required>



<br><br>




<label>
Location
</label>

<br>


<input 
type="text"
name="location"
placeholder="Enter location"
required>



<br><br>





<button 
type="submit"
name="add">

Add Provider

</button>



</form>



<br>


<a href="providers.php">

Back

</a>



</div>




</body>


</html>