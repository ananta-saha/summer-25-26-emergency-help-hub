<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
Emergency Help Hub - Signup
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
Create Account
</h2>



<?php if(isset($error) && $error!=""): ?>

<p class="error">
<?= htmlspecialchars($error); ?>
</p>

<?php endif; ?>





<form action="../../controller/auth/register.php" method="POST">



<label>
Name
</label>


<input
type="text"
name="name"
placeholder="Enter your name"
value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>"
required
>





<label>
Email
</label>


<input
type="email"
name="email"
placeholder="Enter email"
value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
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
Phone
</label>


<input
type="text"
name="phone"
placeholder="Enter phone number"
value="<?= isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '' ?>"
required
>





<label>
Address
</label>


<textarea
name="address"
placeholder="Enter address"
rows="3"
><?= isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '' ?></textarea>





<label>
Select Role
</label>


<select name="role" required>


<option value="">
Select Role
</option>



<option value="citizen"
<?= (isset($_POST['role']) && $_POST['role']=="citizen") ? "selected" : "" ?>>
Citizen
</option>



<option value="provider"
<?= (isset($_POST['role']) && $_POST['role']=="provider") ? "selected" : "" ?>>
Emergency Service Provider
</option>



<option value="organization"
<?= (isset($_POST['role']) && $_POST['role']=="organization") ? "selected" : "" ?>>
Organization
</option>



</select>





<button type="submit">
Signup
</button>





<div class="signup-link">

<p>
Already have an account?
</p>


<a href="../../controller/auth/login.php">
Login Here
</a>


</div>





</form>



</div>


</div>



</body>

</html>