<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="index.css">
    <title>ShaRecipe</title>
  </head>
  <body>
    <?php include 'nav.php'; ?>
    <div>
      <form action="loginUser.php" method="post">
	<ul class="vertical-flexbox">
          <li>
            <h2 "login_title">Sign In</h2>
	  </li>
	  <li>
            <label for="username">Username:</label>
	    <input id="username" name="username" required>
	  </li>
	  <li>   
            <label for="password">Password:</label>
	    <input id="password" type="password" name="password" required>
	  </li>
	  <li>
	    <input class="button" id="login_button" type="submit" value="Login"></input>
	  </li>
        </ul>
      </form>
    </div>
  </body>
</html>

