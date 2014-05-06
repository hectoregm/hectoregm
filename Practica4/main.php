<?php
   include_once 'includes/db_connect.php';
   include_once 'includes/auth.php';
   include_once 'includes/functions.php';

   sec_session_start();

   if (login_check($mysqli) == false) {
   $_SESSION['login_error'] = 'Please login first to access this area.';
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
          <a class="navbar-brand" href="main.php">Practica 4 - Users</a>
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
        <div id="failure" class="<?= $_SESSION['error'] ?
                                             '' : 'hidden' ?> alert alert-danger fade in">
          <?php
             if (isset($_SESSION['error'])) {
             echo '<h4>' . $_SESSION['error'] . '</h4>';
             unset($_SESSION['error']);
             }
             ?>
        </div>
        <div id="success" class="<?= $_SESSION['success'] ?
                                             '' : 'hidden' ?> alert
                                             alert-success fade in">
          <?php
             if (isset($_SESSION['success'])) {
             echo '<h4>' . $_SESSION['success'] . '</h4>';
             unset($_SESSION['success']);
             }
             ?>
        </div>
        <h2 class="sub-header">Users</h2>
        <a class="btn btn-lg btn-primary" href="add_user_form.php">Add User</a>
        <?php
           $sql = "SELECT * from usuarios";
           $query = mysqli_query($mysqli, $sql);
           ?>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Age</th
                           <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
                 while($filas = mysqli_fetch_array($query)){
                 echo "<tr>";
                 echo "<td>" . fullname($filas) . "</td>";
                 echo "<td>" . $filas['email'] . "</td>";
                 echo "<td>" . gender($filas) . "</td>";
                 echo "<td>" . age($filas) . "</td>";
                 echo "<td>" . '<a class="btn btn-xs btn-info"
                 href="show_user.php?id=' . $filas['id'] . '">Show</a>';
                 if (can_edit($mysqli, $filas['id'])) {
                 echo '<a class="btn btn-xs btn-warning"
                 href="edit_user_form.php?id=' . $filas['id'] . '">Edit</a>';
                 echo '<a class="btn btn-xs btn-danger delete_user"
                 href="delete_user.php?id=' . $filas['id'] . '">Delete</a>';
                 }
                 echo "</td>";
                 echo "</tr>";
                 }
                 ?>
            </tbody>
          </table>
        </div>
      </div>

      <script src="js/jquery-1.11.0.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/app.js"></script>
  </body>
</html>
