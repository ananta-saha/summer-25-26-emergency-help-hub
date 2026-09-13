<?php

require_once __DIR__ . "/../../config/db.php";


// Get all citizens

function getAllCitizens()
{
    global $conn;

    $query = "SELECT * FROM citizens";

    $result = mysqli_query($conn, $query);

    $citizens = [];

    while($row = mysqli_fetch_assoc($result))
    {
        $citizens[] = $row;
    }

    return $citizens;
}


?>