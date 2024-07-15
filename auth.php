<?php

require_once ('config.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['email'];
    $password = md5($_POST['password']);

    // Fetch user by username
    $stmt = $conn->prepare("SELECT * FROM lp_users WHERE email = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        if ($user['password'] == $password) {
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_level'] = $user['level'];

            header('Location: index.php');
        } else {
            header("location:index.php?pass=invalid");
        }
    } else {
        header("location:index.php?username=invalid");
    }

    $stmt->close();
}
?>