<?php

require_once('KLogger.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);


class Dao {
	/* heroku */
  private $host = "l6glqt8gsx37y4hs.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
  private $db = "x3366brxqizsdue9";
  private $user = "gco2ghmulrf1jwvu";
  private $pass = "pn2zqsqy0gq0lr1p";

  public function getConnection () {
    return
      new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
  }

  public function createUser ($username, $password) {
    $logger = new KLogger("log.txt", KLogger::WARN);

    # check if user already exists
    $sql = 'SELECT COUNT(*) FROM user WHERE username = :username';
    $connection = $this->getConnection();
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
      $stmt->bindparam(':password', $password);
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
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetchColumn();

    if ($result > 0) {
      # check if password input matches
      $sql = 'SELECT password FROM user WHERE username = :username';
      $stmt = $connection->prepare($sql);
      $stmt->bindParam(':username', $username);
      $stmt->execute();
      $stored_password = $stmt->fetchColumn();
 
      if (password_verify($password, $stored_password)) {
        # correct password
        $_SESSION['user'] = $_POST['username']; # set session username so you can check if user is logged in
	$sql = 'SELECT id FROM user WHERE username = :username';
	$stmt = $connection->prepare($sql);
        $stmt->bindParam(':username', $username);
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

    $connection = $this->getConnection();
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':ingredients', $ingredients);
    $stmt->bindParam(':visibility', $visibility, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':image_folder_path', $image_folder_path);
    $stmt->bindParam(':extension', $extension);
    $stmt->execute();

    $recipeId = $connection->lastInsertId();

    $logger->LogWarn("Recipe [{$recipeId}] was successfully created by user [{$user_id}]");

    return $recipeId; # no problem
  }

  public function removeRecipe($id) {
    $logger = new KLogger("log.txt", KLogger::WARN);
    $connection = $this->getConnection();

    # check if user exists
    $sql = 'DELETE FROM recipe
            WHERE id=:id;';
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $logger->LogWarn("Removed recipe {$id}");
    return 0; # no problem
  }

  public function getRecipes($limNum, $offNum) {
    $logger = new KLogger("log.txt", KLogger::WARN);
    $connection = $this->getConnection();

    # check if user exists
    $sql = 'SELECT id, name, description, ingredients, visibility, user_id, image_folder_path, extension 
	    FROM recipe
	    ORDER BY id
	    LIMIT :limNum
	    OFFSET :offNum;';
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':limNum', $limNum, PDO::PARAM_INT);
    $stmt->bindParam(':offNum', $offNum, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if (empty($_SESSION) || empty($_SESSION['user_id'])) {
      $logger->LogWarn("Anonymous user loaded ten recipes");
    } else {
      $logger->LogWarn("User [{$_SESSION['user_id']}] loaded ten recipes");
    }
    return $result; # no problem
  }

  public function getRecipeCount() {
    $connection = $this->getConnection();

    # check if user exists
    $sql = 'SELECT COUNT(*)
            FROM recipe;';
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchColumn();

    return $result; # no problem
  }

  public function getRecipe($id) {
    $logger = new KLogger("log.txt", KLogger::WARN);
    $connection = $this->getConnection();

    # check if user exists
    $sql = 'SELECT id, name, description, ingredients, visibility, user_id, image_folder_path, extension
            FROM recipe
            WHERE id = :id;';
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($_SESSION) || empty($_SESSION['user_id'])) {
      $logger->LogWarn("Anonymous user loaded recipe {$id}");
    } else {
      $logger->LogWarn("User [{$_SESSION['user_id']}] loaded recipe {$id}");
    }
    return $result; # no problem
  }

  public function saveRecipe($user_id, $recipe_id) {
    $logger = new KLogger("log.txt", KLogger::WARN);
    $connection = $this->getConnection();

    # check if user exists
    $sql = 'INSERT INTO saved_recipe (user_id, recipe_id)
            VALUES (:user_id, :recipe_id);';
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':recipe_id', $recipe_id, PDO::PARAM_INT);
    $stmt->execute();

    $logger->LogWarn("User [{$user_id}] saved recipe {$recipe_id}");
    return 0; # no problem
  }

  public function removeSavedRecipe($user_id, $recipe_id) {
    $logger = new KLogger("log.txt", KLogger::WARN);
    $connection = $this->getConnection();

    # check if user exists
    $sql = 'DELETE FROM saved_recipe
	    WHERE user_id=:user_id
            AND recipe_id=:recipe_id;';
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':recipe_id', $recipe_id, PDO::PARAM_INT);
    $stmt->execute();

    $logger->LogWarn("User [{$user_id}] removed saved recipe {$recipe_id}");
    return 0; # no problem
  }

  public function getSavedRecipe($user_id, $recipe_id) {
    $logger = new KLogger("log.txt", KLogger::WARN);
    $connection = $this->getConnection();
          
    # check if user exists
    $sql = 'SELECT id, user_id, recipe_id
            FROM saved_recipe
	    WHERE recipe_id = :recipe_id
            AND user_id = :user_id;';
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':recipe_id', $recipe_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result; # no problem
  }

    public function getSavedRecipes($limNum, $offNum, $userId)
    {
      $logger = new KLogger("log.txt", KLogger::WARN);
      $connection = $this->getConnection();

      # check if user exists
      $sql =
          'SELECT recipe_id
	       FROM saved_recipe
	       WHERE user_id = :user_id
	       ORDER BY id
	       LIMIT :limNum
	       OFFSET :offNum;';
      $stmt = $connection->prepare($sql);
      $stmt->bindParam(':limNum', $limNum, PDO::PARAM_INT);
      $stmt->bindParam(':offNum', $offNum, PDO::PARAM_INT);
      $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetchAll();

      if (empty($_SESSION) || empty($_SESSION['user_id'])) {
        $logger->LogWarn("Anonymous user loaded ten saved recipes");
      } else {
        $logger->LogWarn("User [{$_SESSION['user_id']}] loaded ten saved recipes");
      }
      return $result; # no problem
    }
}
?>
