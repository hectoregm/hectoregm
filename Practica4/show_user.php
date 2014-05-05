<?php
   include_once 'includes/db_connect.php';
   include_once 'includes/auth.php';

   sec_session_start();

   if (login_check($mysqli) == false) {
   $_SESSION['login_error'] = 'Please login first to access this area.';
   header('Location: ./index.php');
   exit();
   }

   if (isset($_GET["id"])) {
     $id = $_GET["id"];
     $obj = $mysqli->query("SELECT * FROM usuarios WHERE id = '" . $id
     . "'")->fetch_object();
   } else {
     header('Location: ./index.php');
     exit();
   }
   ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Practica 4</title>
    <link href="http://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/common.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="main.php">Practica 4 - Show User</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Logged as: <?php echo
                                             $_SESSION['username'] ?></a></li>
            <li>
              <div class="navbar-collapse collapse">
                <form method="post" action="logout.php" class="navbar-form navbar-right" role="form">
                  <button type="submit" class="btn btn-success">Logout</button>
                </form>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container">
      <h2 class="sub-header">User Info: <?= $obj->username ?></h2>
      <div class="row">
        <div class="col-md-4">
          <div id="failure" class="<?= $_SESSION['add_error'] ?
                                             '' : 'hidden' ?> alert alert-danger fade in">
            <h4>Oh no! There are errors!</h4>
            <ul class="alert_messages">
              <?php
                 if (isset($_SESSION['add_error'])) {
                 echo '<li>' . $_SESSION['add_error'] . '</li>';
                 unset($_SESSION['add_error']);
                 }
                 ?>
            </ul>
          </div>
          <p>Username: <?= $obj->username ?></p>
          <p>Fullname: <?= $obj->nombre . ' ' . $obj->a_paterno . ' '
          . $obj->a_materno ?></p>
          <p>Username: <?= $obj->username ?></p>
          <p>Email: <?= $obj->email ?></p>
          <p>Password: <?= $obj->pass ?></p>
          <p>Admin: <?= $obj->admin == 1 ? 'Yes' : 'No' ?></p>
          <p>Gender: <?= $obj->sexo == 0 ? 'Female' : 'Male' ?></p>
          <p>Birthday: <?= $obj->f_nacimiento ?></p>
        </div>
      </div>
    </div>

    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
