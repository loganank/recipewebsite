<?php

session_start();
require_once('KLogger.php');
require_once 'Dao.php';

$logger = new KLogger("log.txt", KLogger::WARN);
if (!empty($_SESSION) || !empty($_SESSION['user_id'])) {
  if (isset($_GET['id'])) {
    $recipe_id = $_GET['id'];
    $dao = new Dao();

    $recipe = $dao->removeSavedRecipe($_SESSION['user_id'], $recipe_id);
  } else {
    $logger->LogWarn("User [{$_SESSION['user_id']}] tried to remove saved recipe without recipe id");
  }
} else {
  $logger->LogWarn("User not signed in, tried to remove saved recipe");
}

header('Location: '.'index.php');
die();      

?>
