<?php
   include_once 'includes/db_connect.php';
   include_once 'includes/auth.php';

   sec_session_start();

   if (isset($_GET["id"])) {
       $id = $_GET["id"];
       if (login_check($mysqli) == false || can_edit($mysqli, $id)) {
           $obj = $mysqli->query("SELECT * FROM usuarios WHERE id = '" . $id . "'")->fetch_object();
       } else {
           $_SESSION['error'] = 'You don\'t have permissions for this action';
           header('Location: ./main.php');
           exit();
       }
   } else {
     header('Location: ./main.php');
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
          <a class="navbar-brand" href="main.php">Practica 4 - Edit User</a>
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
      <h2 class="sub-header">Edit User</h2>
      <div class="row">
        <div class="col-md-4">
          <div id="failure" class="<?= $_SESSION['edit_error'] ?
                                             '' : 'hidden' ?> alert alert-danger fade in">
            <h4>Oh no! There are errors!</h4>
            <ul class="alert_messages">
              <?php
                 if (isset($_SESSION['edit_error'])) {
                 echo '<li>' . $_SESSION['edit_error'] . '</li>';
                 unset($_SESSION['edit_error']);
                 }
                 ?>
            </ul>
          </div>

          <form method="post" action="edit_user.php" role="form" id="user_form">
            <input type="hidden" name="id" value="<?= $obj->id ?>">
            <div class="form-group">
              <label for="username">Username</label>
              <input name="username" type="text" class="form-control"
                     id="username" placeholder="Username"
                     value="<?= $obj->username ?>">
            </div>
            <div class="form-group">
              <label for="first_name">First Name</label>
              <input name="first_name" type="text"
                     class="form-control" id="first_name"
                     placeholder="Name" value="<?= $obj->nombre ?>">
            </div>
            <div class="form-group">
              <label for="parent_name">Parent Name</label>
              <input name="parent_name" type="text" class="form-control" id="parent_name"
                     placeholder="Parent Name" value="<?= $obj->a_paterno ?>">
            </div>
            <div class="form-group">
              <label for="mother_name">Mother Name</label>
              <input name="mother_name" type="text"
                     class="form-control" id="mother_name"
                     placeholder="Name" value="<?= $obj->a_materno ?>">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input name="email" type="email" class="form-control"
                     id="email" placeholder="Email" value="<?= $obj->email ?>">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input name="password" type="text"
                     class="form-control" id="password"
                     placeholder="Password" value="<?= $obj->pass ?>">
            </div>

            <div class="form-group">
              <label class="radio-inline">
                <input name="gender" type="radio" id="gender1"
                value="0" <?= $obj->sexo == 0 ? 'checked' : '' ?>> Female
              </label>
              <label class="radio-inline">
                <input name="gender" type="radio" id="gender2"
                value="1" <?= $obj->sexo == 1 ? 'checked' : '' ?>> Male
              </label>
            </div>

            <div class="form-group">
              <label for="birthday">Birthday</label>
              <input name="birthday" type="date"
                     onkeypress="return false" id="birthday" value="<?= $obj->f_nacimiento ?>">
            </div>


            <button class="submit btn btn-lg btn-primary btn-block"
            type="submit" id="edit_submit">Edit User</button>
          </form>
        </div>
      </div>
    </div>

    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
