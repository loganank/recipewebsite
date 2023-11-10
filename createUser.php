<?php
  require_once 'Dao.php';

  $username = $_POST["username"];
  $password = password_hash($_POST["password"] . "thisismyhash123random", PASSWORD_BCRYPT);

  $dao = new Dao();

  $dao->createUser($username, $password);
?>
