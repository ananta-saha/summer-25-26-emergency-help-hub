<?php

session_start();

require_once __DIR__ . "/../../model/auth/AuthModel.php";


$error = "";


if($_SERVER["REQUEST_METHOD"]=="POST")
{


$name = trim($_POST["name"]);

$email = trim($_POST["email"]);

$password = $_POST["password"];

$phone = trim($_POST["phone"]);

$address = trim($_POST["address"]);

$role = $_POST["role"];





// Validation

if(
empty($name) ||
empty($email) ||
empty($password) ||
empty($phone) ||
empty($role)
)
{
    $error = "Please fill all required fields.";
}



else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
{
    $error = "Enter a valid email address.";
}



else if(strlen($password)<6)
{
    $error = "Password must be at least 6 characters.";
}



else if(!preg_match("/^[0-9]{11}$/",$phone))
{
    $error = "Enter a valid 11 digit phone number.";
}



else
{


$password = password_hash(
    $password,
    PASSWORD_DEFAULT
);



$result = registerUser(
    $name,
    $email,
    $password,
    $phone,
    $address,
    $role
);



if($result)
{

header("Location: login.php");

exit();

}

else
{

$error = "Email already exists or registration failed.";

}


}


}


require_once __DIR__ . "/../../view/auth/register.php";

?>