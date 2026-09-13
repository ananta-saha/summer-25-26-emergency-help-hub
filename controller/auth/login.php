<?php

session_start();

require_once __DIR__ . "/../../model/auth/AuthModel.php";


$error = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $email = trim($_POST["email"]);

    $password = $_POST["password"];

    $role = $_POST["role"];



    $user = findUserByRole($email, $role);



    if ($user) {


        if (password_verify($password, $user["password"])) {



            $_SESSION["role"] = $role;



            if ($role == "citizen") {


                $_SESSION["citizen_id"] = $user["id"];

                $_SESSION["name"] = $user["name"];


                header("Location: ../citizen/dashboard.php");

                exit();

            }



            else if ($role == "provider") {


                $_SESSION["provider_id"] = $user["id"];

                $_SESSION["name"] = $user["name"];


                header("Location: ../provider/dashboard.php");

                exit();

            }



            else if ($role == "admin") {


                $_SESSION["admin_id"] = $user["id"];

                $_SESSION["name"] = $user["name"];


                header("Location: ../../view/admin/dashboard.php");

                exit();

            }



            else if ($role == "organization") {


                $_SESSION["organization_id"] = $user["id"];

                $_SESSION["name"] = $user["name"];


                header("Location: ../organization/dashboard.php");

                exit();

            }


        }

        else {

            $error = "Incorrect Password";

        }


    }

    else {

        $error = "User not found";

    }


}




require_once __DIR__ . "/../../view/auth/login.php";


?>