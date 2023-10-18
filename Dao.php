<?php

require_once('KLogger.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);


class Dao {
  /* local */	
  private $host = "localhost";
  private $db = "recipewebsite";
  private $user = "loganank";
  private $pass = "Y1y2sG3D4wn!";

  /* heroku
  private $host = "us-cdbr-east-04.cleardb.com";
  private $db = "heroku_f3d6b64b4b5dc57";
  private $user = "be7813156b6434";
  private $pass = "b7cb13a4"; */

  public function getConnection () {
    return
      new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
  }

  public function createUser ($username, $password) {
    $logger = new KLogger("log.txt", KLogger::WARN);

    # check if user already exists
    $sql = 'SELECT COUNT(*) FROM user WHERE username = :username';
    //$result = $this->executeSql($sql, array($username), array("username"));
    $connection = $this->getConnection();
    $stmt = $connection->prepare($sql);
    $stmt->bindParam('username', $username);
    $stmt->execute();
    $result = $stmt->fetchColumn();

    if ($result == 0) {
      # create user because it doesn't exist
      $sql = 'INSERT INTO user (username, password)
       	      VALUES (:username, :password);';
      $stmt = $connection->prepare($sql);
      $stmt->bindParam('username', $username);
      $stmt->bindparam('password', $password);
      $stmt->execute();
      $logger->LogWarn("User [{$username}] was successfully created");
      return 0; # no problem
    } else {
      # TODO display that user already exists
      $logger->LogWarn("User [{$username}] can't be created, as it already exists");
      return 1; # can't create
    }
  }

  public function loginUser($username, $password) {
    $logger = new KLogger("log.txt", KLogger::WARN);
    $connection = $this->getConnection();

    # check if user exists
    $sql = 'SELECT COUNT(*) FROM user WHERE username = :username';
    $connection = $this->getConnection();
    $stmt = $connection->prepare($sql);
    $stmt->bindParam('username', $username);
    $stmt->execute();
    $result = $stmt->fetchColumn();

    if ($result > 0) {
      # check if password input matches
      $sql = 'SELECT password FROM user WHERE username = :username';
      $stmt = $connection->prepare($sql);
      $stmt->bindParam('username', $username);
      $stmt->execute();
      $stored_password = $stmt->fetchColumn();
 
      if (password_verify($password, $stored_password)) {
        # correct password
        $_SESSION['user'] = $_POST['username']; # set session username so you can check if user is logged in
	$sql = 'SELECT id FROM user WHERE username = :username';
	$stmt = $connection->prepare($sql);
        $stmt->bindParam('username', $username);
	$stmt->execute();
        $_SESSION['user_id'] = $stmt->fetchColumn(); 
	$logger->LogWarn("User [{$_SESSION['user_id']}] successfully logged in");
	return 0; # no problem
      } else {
	$logger->LogWarn("User [{$username}] tried to login and input the wrong password");
	return 1;
      }
    } else {
      # TODO display that account doesn't exist
      $logger->LogWarn("User tried to login to [{$username}] but the username doesn't exist");
      return 2;
    }
  }

  public function createRecipe ($name, $description, $ingredients, $visibility, $user_id, $image_folder_path, $extension) {
    $logger = new KLogger("log.txt", KLogger::WARN);

    # create user because it doesn't exist
    $sql = 'INSERT INTO recipe (name, description, ingredients, visibility, user_id, image_folder_path, extension)
            VALUES (:name, :description, :ingredients, :visibility, :user_id, :image_folder_path, :extension);';

    //    PDO::PARAM_INT, // Use PDO::PARAM_INT for integer values
    //    PDO::PARAM_STR
    //$this->executeSql($sql, array($name, $description, $ingredients, (int) $visibility, (int) $user_id, $image_folder_path), array("name", "description", "ingredients", "visibility", "user_id", "image_folder_path"));
    $connection = $this->getConnection();
    $stmt = $connection->prepare($sql);
    $stmt->bindParam('name', $name);
    $stmt->bindParam('description', $description);
    $stmt->bindParam('ingredients', $ingredients);
    $stmt->bindParam('visibility', $visibility, PDO::PARAM_INT);
    $stmt->bindParam('user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam('image_folder_path', $image_folder_path);
    $stmt->bindParam('extension', $extension);
    $stmt->execute();

    $recipeId = $connection->lastInsertId();

    $logger->LogWarn("Recipe [{$recipeId}] was successfully created by user [{$user_id}]");

    # return recipe id
    $sql = 'SELECT id FROM user WHERE username = :username';

    return $recipeId; # no problem
  }
}
?>
