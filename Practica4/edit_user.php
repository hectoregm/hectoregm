<?php
include_once 'includes/db_connect.php';
include_once 'includes/auth.php';
sec_session_start();

if(isset($_POST["id"])){

    $id = $_POST["id"];
    if (login_check($mysqli) == true && can_edit($mysqli, $id)) {

        $username = $_POST["username"];
        $firstname = $_POST["first_name"];
        $parentname = $_POST["parent_name"];
        $mothername = $_POST["mother_name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $gender = $_POST["gender"];
        $birthday = $_POST["birthday"];


        if ($stmt = $mysqli->prepare("UPDATE usuarios SET username = ?,
            pass = ?, email = ?, nombre = ?, a_paterno = ?, a_materno = ?, sexo = ?, f_nacimiento = ? WHERE id = ?")) {
            $stmt->bind_param('ssssssisi',
                              $username,
                              $password,
                              $email,
                              $firstname,
                              $parentname,
                              $mothername,
                              $gender,
                              $birthday,
                              $id);
            $stmt->execute();
            $_SESSION['success'] = 'Update successful for user: ' . $username;
            header("Location: ./main.php");
            exit();
        } else {

        }
    } else {
        $_SESSION['error'] = 'You don\'t have permissions for this action';
        header('Location: ./main.php');
        exit();
    }
} else {
    $_SESSION['edit_error'] = 'Error updating user. Params';
    header("Location: ./edit_user_form.php");
    exit();
}