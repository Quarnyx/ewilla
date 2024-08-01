<?php
require_once ('config.php');

if (isset($_COOKIE['rememberme'])) {
    $username = $_COOKIE['rememberme'];
    $stmt = $conn->prepare("SELECT * FROM lp_users WHERE email = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_level'] = $user['level'];
    header('Location: app.php?page=dashboard');

} else {
    header('location:login.php');
}
?>