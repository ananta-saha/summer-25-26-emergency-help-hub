<?php

require_once "../../model/admin/OrganizationManagementModel.php";


// ADD

if(isset($_POST["add_organization"]))
{


addOrganization(

$_POST["name"],
$_POST["email"],
$_POST["phone"],
$_POST["address"],
$_POST["type"]

);


header("Location: ../../view/admin/organizations.php");

exit();

}




// UPDATE

if(isset($_POST["update_organization"]))
{


updateOrganization(

$_POST["id"],
$_POST["name"],
$_POST["email"],
$_POST["phone"],
$_POST["address"],
$_POST["type"]

);


header("Location: ../../view/admin/organizations.php");

exit();

}




// DELETE

if(isset($_GET["delete"]))
{


deleteOrganization($_GET["delete"]);


header("Location: ../../view/admin/organizations.php");

exit();

}

// APPROVE / REJECT


if(isset($_GET["status"]))
{


updateOrganizationStatus(
    $_GET["id"],
    $_GET["status"]
);



header(
"Location: ../../view/admin/organizations.php"
);


exit();


}


?>