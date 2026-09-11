<?php
session_start();
if (!isset($_SESSION["citizen_id"])) {
    header("Location: login.php");
    exit();
}
require_once __DIR__ . "/../../view/citizen/dashboard.php";
?>