<?php
  session_start();
  require_once('KLogger.php');
  require_once 'Dao.php';

  $logger = new KLogger("log.txt", KLogger::WARN);
  $recipe_id = $_GET["id"];
  if (!empty($_SESSION) || !empty($_SESSION['user_id'])) {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      // Query the database to fetch the recipe details using $recipeId
      // Display the recipe details here
      $dao = new Dao();

      // check if it has been saved before
      $result = $dao->getSavedRecipe($_SESSION['user_id'], $recipe_id);
      if (empty($result)) {
        $recipe = $dao->saveRecipe($_SESSION['user_id'], $recipe_id);
      } else {
        $logger->LogWarn("User [{$_SESSION['user_id']}] tried to save already saved recipe {$recipe_id}");
      }
    } else {
      $logger->LogWarn("User [{$_SESSION['user_id']}] tried to view saved recipe without recipe id");
    }
  } else {
    $logger->LogWarn("User not signed in, tried to view saved recipe");
  }
  
  header('Location: index.php');
  die();      
?>          

