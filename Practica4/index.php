<?php
   include_once 'includes/db_connect.php';
   include_once 'includes/auth.php';

   sec_session_start();

   if (login_check($mysqli) == true) {
       header("Location: ./main.php");
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
          <a class="navbar-brand" href="#">Practica 4 - Login</a>
        </div>
        <div class="navbar-collapse collapse">
          <form method="post" action="includes/process_login.php" class="navbar-form navbar-right" role="form">
            <div class="form-group">
              <input id="username" name="username" type="text" placeholder="Username" class="form-control">
            </div>
            <div class="form-group">
              <input id="password" name="password" type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <?php
           if (isset($_SESSION['login_error'])) {
           echo '<div id="failure" class="alert alert-danger fade in">';
           echo '<h4>Oh no! There was an error!</h4>';
           echo '<ul class="alert_messages">';
           echo '<li>' . $_SESSION['login_error'] . '</li>';
           echo '</ul>';
           echo '</div>';
           unset($_SESSION['login_error']);
           }
           ?>

        <h1>Bienvenido</h1>
        <p>Este es el sistema require credenciales para ser
          usados. Por favor de ingresar su usuario y contraseña en la
          parte superior.</p>
      </div>
    </div>

    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
