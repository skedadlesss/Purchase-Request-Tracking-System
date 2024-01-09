<?php
session_start();
session_unset();
session_destroy();
if (isset($_SESSION["username"])) {
    session_destroy();
    unset($_SESSION['username']);
}
header("Location: login-user.php");
exit;
?>