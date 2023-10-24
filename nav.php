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
      <ul id="navbar_list">
        <li id="explore_li">
          <a class="link" id="explore" href="index.php">Explore</a>
        </li>
        <li id="search_li">
          <textarea id="search" placeholder="Search"></textarea>
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