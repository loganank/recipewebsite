<?php
  session_start();
  require_once 'Dao.php';

  $username = $_POST["username"];
  $password = $_POST["password"];

  $dao = new Dao();

  $result = $dao->loginUser($username, $password);

  header('Location: '.'index.php');
  die();
?>
