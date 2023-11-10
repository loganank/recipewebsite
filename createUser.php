<?php
session_start();
require_once 'Dao.php';
require_once 'KLogger.php';

$logger = new KLogger("log.txt", KLogger::WARN);

$username = trim($_POST["username"]);
$password = password_hash(trim($_POST["password"]) . "thisismyhash123random", PASSWORD_BCRYPT);

$errors = array();

if (strlen($username) <= 0) {
  array_push($errors, "The provided username is invalid"); 
}	

if (strlen(trim($_POST['password'])) < 6) {
  array_push($errors, "The provided password is too short. Please provide a password with over 6 characters"); 
}

$logger->LogWarn("Before");

if (!empty($errors)) {
  header('HTTP/1.1 500 Internal Server Error');
  header('Content-Type: application/json; charset=UTF-8');
  $json_msg = json_encode($errors);
  $logger->LogWarn("{$json_msg}"); 
  die($json_msg);
}

$dao = new Dao();

$dao->createUser($username, $password);
?>
