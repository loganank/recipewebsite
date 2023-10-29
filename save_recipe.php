<?php
  session_start();
  require_once 'Dao.php';
      
  $recipe_id = $_GET["id"];
  require_once 'Dao.php';
  if (!empty($_SESSION) || !empty($_SESSION['user_id'])) {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      // Query the database to fetch the recipe details using $recipeId
      // Display the recipe details here
      $dao = new Dao();

      // check if it has been saved before
      $result = $dao->getSavedRecipe($recipe_id);
      if (empty($result)) {
        $recipe = $dao->saveRecipe($_SESSION['user_id'], $recipe_id);
      } else {
        echo 'User already saved recipe';
      }
    } else {
      echo "Recipe ID not provided.";
    }
  } else {
    echo 'User not signed in';
  }
  
  header('Location: '.'index.php');
  die();      
?>          

