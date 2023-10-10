<?php
  session_start();
  require_once 'Dao.php';

  $username = $_POST["username"];
  $password = $_POST["password"];

  $dao = new Dao();

  $connection = $dao->getConnection();

  # check if user exists
  $sql = 'SELECT COUNT(*) FROM user WHERE username = :username';

  $stmt = $connection->prepare($sql);

  $stmt->bindParam(':username', $username);

  $stmt->execute();

  $result = $stmt->fetchColumn();

  if ($result >= 0) {
    # check if password input matches
    $sql = 'SELECT password FROM user WHERE username = :username';

    $stmt = $connection->prepare($sql);

    $stmt->bindParam(':username', $username);

    $stmt->execute();

    $stored_password = $stmt->fetchColumn();

    if (password_verify($password, $stored_password)) {
      # correct password
      print('correct password');
      $_SESSION['user'] = $_POST['username']; # set session username so you can check if user is logged in
    } else {
      # TODO display that the password was incorrect
      print('incorrect password');
    }
  } else {
    # TODO display that account doesn't exist
  }

  $connection = null;
  header('Location: '.'index.php');
?>

