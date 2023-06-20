<?php
  include 'inc/header.php';

  Session::CheckSession();

  $logMsg = Session::get('logMsg');
  if (isset($logMsg)) {
    echo $logMsg;
  }
  $msg = Session::get('msg');
  if (isset($msg)) {
    echo $msg;
  }
  Session::set("msg", NULL);
  Session::set("logMsg", NULL);
  ?>
  <?php

  if (isset($_GET['Email']) && isset($_GET['num'])) {
    $Num = preg_replace('/[^a-zA-Z0-9]/', '', (int)$_GET['num']);
    $Nom = preg_replace('/[^a-zA-Z0-9_@.]/', '', $_GET['Email']);
    $removeUser = $users->deleteUserByNumeroModule($Num,$Nom);
  }

  if (isset($removeUser)) {
    echo $removeUser;
  }
  ?>
