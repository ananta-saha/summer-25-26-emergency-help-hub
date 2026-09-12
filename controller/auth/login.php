<?php

session_start();

require_once __DIR__ . "/../../model/auth/AuthModel.php";


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


        }

        else {

            echo "Incorrect Password";

        }


    }

    else {

        echo "User not found";

    }


}

?>