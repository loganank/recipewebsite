    <?php include 'nav.php'; ?>
    <div>
       <form action="createUser.php" method="post">
	<ul class="vertical-flexbox">
          <li>
            <h2 "register_title">Create Account</h2>
	  </li>
	  <li>
            <label for="username">Select a Username:</label>
	    <input id="username" name="username" required>
	  </li>
	  <li>
            <label for="username">Select a Password:</label>
	    <input id="password" type="password" name="password" required>
	  </li>
	  <li>
	    <input class="button" id="register_button" type="submit" value="Create">
	  </li>
        </ul>
      </form>
    </div>
  </body>
</html>
