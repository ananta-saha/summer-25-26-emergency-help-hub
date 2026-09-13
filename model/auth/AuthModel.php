<?php

require_once __DIR__ . "/../../config/db.php";


function findUserByRole($email, $role)
{
    global $conn;


    if ($role == "citizen") {

        $stmt = mysqli_prepare(
            $conn,
            "SELECT
                citizen_id AS id,
                name,
                email,
                password,
                status
             FROM citizens
             WHERE email = ?"
        );

    }


    else if ($role == "provider") {

        $stmt = mysqli_prepare(
            $conn,
            "SELECT
                provider_id AS id,
                provider_name AS name,
                email,
                password,
                status
             FROM service_providers
             WHERE email = ?"
        );

    }


    else if ($role == "admin") {

        $stmt = mysqli_prepare(
            $conn,
            "SELECT
                id,
                name,
                email,
                password
             FROM admins
             WHERE email = ?"
        );

    }


    else if ($role == "organization") {

        $stmt = mysqli_prepare(
            $conn,
            "SELECT
                organization_id AS id,
                organization_name AS name,
                email,
                password,
                status
             FROM organizations
             WHERE email = ?"
        );

    }


    else {

        return null;

    }


    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $email
    );


    mysqli_stmt_execute($stmt);


    $result = mysqli_stmt_get_result($stmt);


    $user = mysqli_fetch_assoc($result);


    mysqli_stmt_close($stmt);


    return $user;
}




function registerUser(
    $name,
    $email,
    $password,
    $phone,
    $address,
    $role
)
{

    global $conn;


    if($role=="citizen")
    {

        $stmt=mysqli_prepare(
            $conn,

            "INSERT INTO citizens
            (name,email,password,phone,address)
            VALUES(?,?,?,?,?)"
        );


        mysqli_stmt_bind_param(
            $stmt,
            "sssss",
            $name,
            $email,
            $password,
            $phone,
            $address
        );

    }



    else if($role=="provider")
    {

        $stmt=mysqli_prepare(
            $conn,

            "INSERT INTO service_providers
            (provider_name,email,password,service_type,phone,address,status)
            VALUES(?,?,?,?,?,?, 'Pending')"
        );


        $service="Ambulance";


        mysqli_stmt_bind_param(
            $stmt,
            "ssssss",
            $name,
            $email,
            $password,
            $service,
            $phone,
            $address
        );

    }



    else if($role=="organization")
    {

        $stmt=mysqli_prepare(
            $conn,

            "INSERT INTO organizations
            (organization_name,email,password,phone,address,status)
            VALUES(?,?,?,?,?, 'Pending')"
        );


        mysqli_stmt_bind_param(
            $stmt,
            "sssss",
            $name,
            $email,
            $password,
            $phone,
            $address
        );

    }



    else
    {

        return false;

    }



    return mysqli_stmt_execute($stmt);

}

?>