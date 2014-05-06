<?php
include_once 'includes/db_connect.php';
include_once 'includes/auth.php';
sec_session_start();

if(isset($_GET["id"])){

    $id = $_GET["id"];
    if (login_check($mysqli) == true && can_edit($mysqli, $id)) {

        if ($stmt = $mysqli->prepare("DELETE FROM usuarios WHERE id = ?")) {
            $stmt->bind_param('i', $id);
            $stmt->execute();

            $_SESSION['success'] = 'Successful deletion of user with id: ' . $id;
            header("Location: ./main.php");
            exit();
        } else {
            $_SESSION['error'] = 'Error deleting user';
            header("Location: ./main.php");
            exit();
        }
    } else {
        $_SESSION['error'] = 'You don\'t have permissions for this action';
        header('Location: ./main.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'Error deleting user. Params';
    header("Location: ./main.php");
    exit();
}