    <?php include 'nav.php'; ?> 
    <div>
      <ul class="vertical-flexbox" id="recipe_info">
	<li>
          <h1>Recommended Recipes</h1>  
	</li>
        <li>
          <a href="create_recipe.php">
            <button>Create Recipe</button>
          </a>
        </li>
      </ul>
        <?php
      require_once 'Dao.php';

      $dao = new Dao();

      $recipesPerPage = 10;

	  $limNum = $recipesPerPage;
      $recipeNumber = $dao->getRecipeCount();
      if (isset($_GET['page'])) {
          if ($_GET['page'] < 0 || $recipeNumber <= $recipesPerPage * $_GET['page'])  {
              header('Location: '.'index.php');
              die();
          }
          $offNum = $_GET['page'] * $recipesPerPage;
      } else {
          $offNum = 0;
      }

	  $result = $dao->getRecipes($limNum, $offNum);
	  //print_r($result);
	  foreach ($result as $recipe) {
	    echo '<ul><ul class="container vertical-flexbox">';
	    echo '<li><h2>' . htmlspecialchars($recipe['name'], ENT_QUOTES, 'UTF-8') . '</h2></li>';
	    echo '<li><img src="' . $recipe['image_folder_path'] . '/' . $recipe['id'] . '.' . $recipe['extension'] . '"/></li>';
            echo '</ul><ul id="ingredients_container" class="container vertical-flexbox">';
            echo '<li><h3>Ingredients</h3></li>';
	    echo '<li>' . htmlspecialchars($recipe['ingredients'], ENT_QUOTES, 'UTF-8') . '</li></ul></ul>'; 
	    echo '<ul><li><button><a href="recipe.php?id=' . $recipe['id'] . '">View</a></button></li></ul>';
	  }
	?>
        <ul>
            <li>
                <?php
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 0;
                }
                if ($page > 0) {
                    echo '<button id="prev_button">Prev</button>';
                }

                if ($recipeNumber > $recipesPerPage * ($page + 1)) {
                    echo '<button id="next_button">Next</button>';
                }
                ?>
            </li>
        </ul>
        <script src="page.js" defer></script>
    </div>
  </body>
</html>
