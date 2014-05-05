<?php
include_once 'includes/db_connect.php';
include_once 'includes/auth.php';
sec_session_start();

if (login_check($mysqli) == false) {
    $_SESSION['login_error'] = 'Please login first to access this area.';
    header('Location: ./index.php');
    exit();
}

if(isset($_POST["username"])){

    $username = $_POST["username"];
    $firstname = $_POST["first_name"];
    $parentname = $_POST["parent_name"];
    $mothername = $_POST["mother_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $gender = $_POST["gender"];
    $birthday = $_POST["birthday"];

    if ($stmt = $mysqli->prepare("SELECT id
                                  FROM usuarios
                                  WHERE username = ? LIMIT 1")) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        $stmt->bind_result($user_id);
        $stmt->fetch();
        if ($stmt->num_rows > 0) {
            $_SESSION['add_error'] = 'Username is already in use.';
            header("Location: ./add_user_form.php");
            exit();
        } else {
        }
    } else {
        $_SESSION['add_error'] = 'Error adding user.';
        header("Location: ./add_user_form.php");
        exit();
    }
    
    $admin = 0;

    if ($stmt = $mysqli->prepare("INSERT INTO usuarios (username, pass, admin, email, nombre, a_paterno, a_materno, sexo, f_nacimiento)
                                  VALUES(?,?,?,?,?,?,?,?,?)")) {
        $stmt->bind_param('ssissssis',
                          $username,
                          $password,
                          $admin,
                          $email,
                          $firstname,
                          $parentname,
                          $mothername,
                          $gender,
                          $birthday);
        $stmt->execute();
        $_SESSION['add_success'] = 'Registration successful for user: ' . $username;
        header("Location: ./main.php");
        exit();
    } else {
        $_SESSION['add_error'] = 'Error adding user. Insertion';
        header("Location: ./add_user_form.php");
        exit();
    }
}
