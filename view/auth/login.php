<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
Emergency Help Hub - Login
</title>


<link rel="stylesheet" href="../../assets/css/login.css">

</head>



<body>


<div class="login-container">


<div class="login-card">


<h1>
🚑 Emergency Help Hub
</h1>


<h2>
Login
</h2>



<?php if(isset($error) && $error!=""): ?>

<p class="error">
<?= htmlspecialchars($error); ?>
</p>

<?php endif; ?>



<form action="../../controller/auth/login.php" method="POST">



<label>
Email
</label>


<input
type="email"
name="email"
placeholder="Enter email"
required
>



<label>
Password
</label>


<input
type="password"
name="password"
placeholder="Enter password"
required
>



<label>
Select Role
</label>


<select name="role" required>


<option value="">
Select Role
</option>


<option value="citizen">
Citizen
</option>


<option value="provider">
Emergency Service Provider
</option>


<option value="admin">
Admin
</option>


<option value="organization">
Organization
</option>


</select>




<button type="submit">
Login
</button>



</form>



<!-- Signup Section -->

<div class="signup-link">

<p>
Don't have an account?
</p>

<a href="../../controller/auth/register.php">
Create Account
</a>

</div>



</div>


</div>


</body>

</html>