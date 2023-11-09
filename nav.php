<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <title>ShaRecipe</title>
    <script src="jquery-3.7.1.min.js"></script>
  </head>
  <body>
<?php
session_start();

// Check if the user is logged in
$currentPage = basename($_SERVER['PHP_SELF']);
if ( ($currentPage != 'login.php' && $currentPage != 'register.php') && !isset($_SESSION['user_id'])) {
    //redirect
    header('Location: login.php');
    die();
}

?>
    <div>
      <ul>
        <li>
          <ul>
            <li>
              <img id="logo" src="logo.png"/>
            </li>
            <li>
              <h1 id="title">ShaRecipe</h1>
            </li>
          </ul>
        </li>
        <li id="space_li"></li>
        <ul>
        <li id="profile_li">
          <img id="profile_pic" src="profile_pic.png"/>
          <?php
            session_start();
	    if (empty($_SESSION['user'])) {
	      echo "<h3>Not signed in</h3>";
	    } else {
	      echo "<h3>Signed in as {$_SESSION['user']}</h3>";
	    }
          ?>
        </li>
      <ul>
    </div>
    <nav id="navbar_menu">
        <li id="explore_li">
          <a class="link" id="explore" href="index.php">Explore</a>
        </li>
      <ul id="navbar_list">
          <li id="saved_li">
              <a class="link" id="saved" href="saved_recipes.php">Saved Recipes</a>
          </li>
          <li id="login_li">
          <?php
	    session_start();
	    if (empty($_SESSION['user'])) {
              echo '<a class="link" id="login" href="login.php">Login</a>';
            } else {
	      echo '<a class="link" id="logout" href="logout.php">Logout</a>';
            }
          ?>
        </li>
        <li id="register_li">
          <a class="link" id="register" href="register.php">Register</a>
        </li> 
      </ul>
    </nav>
