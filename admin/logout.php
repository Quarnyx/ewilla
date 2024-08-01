<?php
session_start();

session_destroy();
if (isset($_COOKIE['rememberme'])) {
    setcookie('rememberme', '', time() - 3600, '/'); // Set the cookie to expire in the past
}
header("location:login.php");


?>