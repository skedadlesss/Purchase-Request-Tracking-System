<?php

include 'connect.php';

if (!isset($_SESSION["username"])) {
    header("Location: login-user.php");
    exit;
}

?>