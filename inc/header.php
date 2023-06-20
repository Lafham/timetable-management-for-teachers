 <?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . "/../lib/Session.php";
Session::init();



spl_autoload_register(function ($classes) {

  include 'classes/' . $classes . ".php";
});


$users = new Users();

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Charge Horaire</title>
  <link rel="stylesheet" href="assets/style.css">
  <link rel="stylesheet" href="assets/bootstrap.min.css">
  <link href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/dataTables.bootstrap4.min.css">
</head>

<body>


  <?php


  if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    Session::set('logout', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success !</strong> You are Logged Out Successfully !</div>');
    Session::destroy();
  }



  ?>


  <div>

    <nav  class="navbar navbar-expand-md navbar-dark bg-dark card-header mw-100">
      <a class="navbar-brand" href="index.php"><img src="inc/fssm1.png" alt="fssm1" width="150" ></a>
        <!-- <i class="fas fa-home mr-2"></i>Depatement Info</a> -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">



          <?php if (Session::get('id') == TRUE) { ?>
            <?php if (Session::get('roleid') == '1') { ?>
              <li class="nav-item">
                <a class="nav-link" href="index.php"><i class="fas fa-users mr-2"></i>Charge Horaire</span></a>
              </li>
               <li class="nav-item

              <?php

              $path = $_SERVER['SCRIPT_FILENAME'];
              $current = basename($path, '.php');
              if ($current == 'addUser') {
                echo " active ";
              }

              ?>
                         ">

                <a class="nav-link" href="utilisateurs.php"><i class="fas fa-user-plus mr-2"></i>Espace Utilisateur</span></a>

              </li> 

              <li>
                <a class="nav-link" href="enseignant.php"><i class="fas fa-user mr-2"></i>Liste Enseignants </span></a>
              </li>
            <?php  } elseif(Session::get('roleid') == '2') { ?>
              <li class="nav-item">

              <a class="nav-link" href="index.php"><i class="fas fa-users mr-2"></i>Charge Horaire</span></a>
            </li>
            <li>
                <a class="nav-link" href="enseignant.php"><i class="fas fa-user mr-2"></i>Liste Enseignants </span></a>
              </li>
              <?php } else{?> <li class="nav-item">

                <a class="nav-link" href="index.php"><i class="fas fa-users mr-2"></i>Charge Horaire</span></a>
                 </li>
                <li>
                <a class="nav-link" href="enseignant.php"><i class="fas fa-user mr-2"></i>Liste Enseignants </span></a>
                </li>

              <?php }?>
            <li class="nav-item
            <?php

            $path = $_SERVER['SCRIPT_FILENAME'];
            $current = basename($path, '.php');
            if ($current == 'profile') {
              echo "active ";
            }

            ?>

            ">

              <a class="nav-link" href="profile.php?id=<?php echo Session::get("id"); ?>"><i class="fab fa-500px mr-2"></i>Profile <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="?action=logout"><i class="fas fa-sign-out-alt mr-2"></i>Deconnexion</a>
            </li>
          <?php } else { ?>
            <li class="nav-item
                <?php

                $path = $_SERVER['SCRIPT_FILENAME'];
                $current = basename($path, '.php');
                if ($current == 'login') {
                  echo " active ";
                }

                ?>">
              <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt mr-2"></i>Login</a>
            </li>

          <?php } ?>


        </ul>

      </div>
    </nav>
  </div>