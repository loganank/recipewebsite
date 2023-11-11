<?php
  session_start();
  require_once 'Dao.php';

  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);

  $dao = new Dao();

  $result = $dao->loginUser($username, $password . "thisismyhash123random");

  $error = "";

  if ($result === 1) {
    $error = "Incorrect password. Try again";
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json; charset=UTF-8');
    $json_msg = json_encode($error);
    die($json_msg);
  } else if ($result === 2) {
    $error = "That username does not exist";
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json; charset=UTF-8');
    $json_msg = json_encode($error);
    die($json_msg);
  }



$logger->LogWarn("User [{$username}] ");
      $logger->LogWarn("User ");
  header('Location: '.'index.php');
  die();
?>

