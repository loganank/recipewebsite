<?php
  #error_reporting(E_ALL);
  #ini_set('display_errors', 1);
  require_once 'Dao.php';

  $username = $_POST["username"];
  $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

  $dao = new Dao();

  $connection = $dao->getConnection();

  # check if user already exists
  $sql = 'SELECT COUNT(*) FROM user WHERE username = :username';

  $stmt = $connection->prepare($sql);

  $stmt->bindParam(':username', $username);

  $stmt->execute();

  $result = $stmt->fetchColumn();

  if ($result == 0) {
    # create user because it doesn't exist
    $sql = 'INSERT INTO user (username, password)
       	    VALUES (:username, :password);';

    $stmt = $connection->prepare($sql);

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
  
    $stmt->execute();
  } else {
    # TODO display that user already exists
  }
  # close connection
  $connection = null;
  header('Location: '.'login.php');
  die();
?>
