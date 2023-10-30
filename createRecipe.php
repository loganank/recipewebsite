<?php

  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  session_start();

  require_once('KLogger.php');
  require_once 'Dao.php';

  $logger = new KLogger("log.txt", KLogger::WARN);

  $recipeName = $_POST["recipe_name"];
  $recipeDesc = $_POST["recipe_desc"];
  $ingredients = $_POST["ingredients"];
  $visibilityString = $_POST["visibility"];
  $visibility = ($visibilityString == 'public') ? 1 : 0;

  $target_dir = "recipe_images/" . $_SESSION['user_id'];
  $imageFileType = strtolower(pathinfo($_FILES["recipe_img_upload"]["name"], PATHINFO_EXTENSION));

  $dao = new Dao();
  $recipeId = $dao->createRecipe($recipeName, $recipeDesc, $ingredients, $visibility, $_SESSION['user_id'], $target_dir, $imageFileType);

  if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
  }

  $target_file = $target_dir . "/" . $recipeId . "." . $imageFileType;
  $logger->LogWarn("Target file: [{$target_file}]");

  $uploadOk = 1;

  // Check if image file is a actual image or fake image
  $check = getimagesize($_FILES["recipe_img_upload"]["tmp_name"]);
  if($check !== false) {
    $logger->LogWarn("File is an image - " . $check["mime"] . ".");
    $uploadOk = 1;
  } else {
    $logger->LogWarn("File is not an image.");
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["recipe_img_upload"]["size"] > 5000000) { # over 5mb
    $logger->LogWarn("Image failed to upload, it was larger than 5mb");
    $uploadOk = 0;
  }

  // Allow certain file formats
  if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    $logger->LogWarn("Image is not a JPG, JPEG, PNG & GIF, so it cannot be uploaded");
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["recipe_img_upload"]["tmp_name"], $target_file)) {
      $logger->LogWarn("The file ". htmlspecialchars( basename( $_FILES["recipe_img_upload"]["name"])) . " has been uploaded.");
    } else {
      $logger->LogWarn("Sorry, there was an error uploading your file.");
    }
  } 

  header('Location: '.'index.php');
  die();
?>
