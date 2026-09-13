<?php

require_once "../../config/db.php";


// Get all organizations

function getAllOrganizations()
{
    global $conn;

    $sql = "SELECT * FROM organizations ORDER BY organization_id DESC";

    return mysqli_query($conn,$sql);
}


// Get single organization

function getOrganizationById($id)
{
    global $conn;

    $stmt=mysqli_prepare(
        $conn,
        "SELECT * FROM organizations WHERE organization_id=?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $id
    );

    mysqli_stmt_execute($stmt);

    $result=mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($result);

}


// Add organization

function addOrganization($name,$email,$phone,$address,$type)
{
    global $conn;

    $stmt=mysqli_prepare(
        $conn,

        "INSERT INTO organizations
        (organization_name,email,phone,address,status)

        VALUES
        (?,?,?,?, 'Pending')"
    );


    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $name,
        $email,
        $phone,
        $address
    );


    return mysqli_stmt_execute($stmt);

}




// Update organization

function updateOrganization($id,$name,$email,$phone,$address,$type)
{
    global $conn;


    $stmt=mysqli_prepare(
        $conn,

        "UPDATE organizations SET

        organization_name=?,
        email=?,
        phone=?,
        address=?

        WHERE organization_id=?"

    );


    mysqli_stmt_bind_param(
        $stmt,
        "ssssi",

        $name,
        $email,
        $phone,
        $address,
        $id
    );


    return mysqli_stmt_execute($stmt);

}




// Delete organization

function deleteOrganization($id)
{
    global $conn;


    $stmt=mysqli_prepare(
        $conn,
        "DELETE FROM organizations WHERE organization_id=?"
    );


    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $id
    );


    return mysqli_stmt_execute($stmt);

}


// Update organization status

function updateOrganizationStatus($id,$status)
{
    global $conn;


    $stmt=mysqli_prepare(
        $conn,

        "UPDATE organizations
         SET status=?
         WHERE organization_id=?"
    );


    mysqli_stmt_bind_param(
        $stmt,
        "si",
        $status,
        $id
    );


    return mysqli_stmt_execute($stmt);

}

?>