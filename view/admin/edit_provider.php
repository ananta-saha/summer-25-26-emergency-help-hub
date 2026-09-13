<?php

session_start();


require_once "../../model/admin/ProviderManagementModel.php";


if(!isset($_SESSION["admin_id"]))
{
    header("Location: ../auth/login.php");
    exit();
}



if(!isset($_GET["id"]))
{
    header("Location: providers.php");
    exit();
}



$id = $_GET["id"];



// এখন provider data আনতে হবে
// তাই model এ getProviderById function লাগবে


$provider = getProviderById($id);



?>


<!DOCTYPE html>

<html>


<head>

<title>
Edit Service Provider
</title>


<link rel="stylesheet" href="../../assets/css/admin.css">


</head>



<body>



<div class="admin-container">



<h1>
Edit Service Provider
</h1>




<form method="POST"
action="../../controller/admin/ProviderController.php">



<input 
type="hidden"
name="id"
value="<?= $provider["id"] ?>">





<label>
Provider Name
</label>

<br>


<input 
type="text"
name="name"
value="<?= $provider["name"] ?>"
required>


<br><br>




<label>
Email
</label>

<br>


<input 
type="email"
name="email"
value="<?= $provider["email"] ?>"
required>


<br><br>




<label>
Phone
</label>

<br>


<input 
type="text"
name="phone"
value="<?= $provider["phone"] ?>"
required>


<br><br>





<label>
Service Type
</label>

<br>


<input 
type="text"
name="service_type"
value="<?= $provider["service_type"] ?>"
required>


<br><br>





<label>
Location
</label>

<br>


<input 
type="text"
name="location"
value="<?= $provider["location"] ?>"
required>


<br><br>





<button 
type="submit"
name="update">

Update Provider

</button>



</form>



<br>


<a href="providers.php">

Back

</a>



</div>



</body>


</html>