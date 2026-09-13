<?php

session_start();

session_destroy();

header("Location: ../../view/auth/login.php");

exit();

?>