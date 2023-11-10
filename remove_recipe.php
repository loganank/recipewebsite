<?php

session_start();
require_once('KLogger.php');
require_once 'Dao.php';

$logger = new KLogger("log.txt", KLogger::WARN);
if (!empty($_SESSION) || !empty($_SESSION['user_id'])) {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $dao = new Dao();

    $recipe = $dao->getRecipe($id);
    if ($recipe) {
      if ($recipe['user_id'] === $_SESSION['user_id']) {
        $dao->removeRecipe($id);
      } else {
        $logger->LogWarn("User [{$_SESSION['user_id']}] tried to remove recipe they didn't create");
      } 
    } else {
      $logger->LogWarn("User [{$_SESSION['user_id']}] tried to remove recipe that doesn't exist");
    }
  } else {
    $logger->LogWarn("User [{$_SESSION['user_id']}] tried to remove recipe without recipe id");
  }
} else {
  $logger->LogWarn("User not signed in, tried to remove recipe");
}

header('Location: '.'index.php');
die();      

?>
