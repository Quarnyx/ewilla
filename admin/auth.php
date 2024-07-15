<?php

require_once ('../config.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Fetch user by username
    $stmt = $conn->prepare("SELECT * FROM lp_users WHERE email = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Verify the password using wp_check_password
        if ($user['password'] == $password && $user['level'] == 'Admin') {
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_level'] = $user['level'];

            header('Location: app.php?page=dashboard');
            // Set session or cookies here if needed
        } else {
            header("location:login.php?pass=invalid");
        }
    } else {
        header("location:login.php?username=invalid");
    }

    $stmt->close();
}
?>