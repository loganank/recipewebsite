    <?php include 'nav.php'; ?>
    <div>
       <script src="registerAjax.js" defer></script>
       <form id="registerUser" action="createUser.php">
	<ul class="vertical-flexbox">
          <li>
            <h2 "register_title">Create Account</h2>
	  </li>
	  <li>
            <label for="username">Select a Username:</label>
	    <input id="username" name="username" required>
	  </li>
	  <li>
            <label for="password">Select a Password:</label>
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
