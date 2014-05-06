<?php

include_once 'db_connect.php';
include_once 'auth.php';

sec_session_start();

if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    //$email = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (login($username, $password, $mysqli) == true) {
        // Login success 
        $_SESSION['success'] = 'Welcome ' . $username . '!';
        header("Location: ../main.php");
        exit();
    } else {
        // Login failed 
        $_SESSION['login_error'] = 'Wrong username/password';
        header('Location: ../index.php');
        exit();
    }
} else {
    // The correct POST variables were not sent to this page. 
    header('Location: ../index.php?error=Could not process login.');
    exit();
}