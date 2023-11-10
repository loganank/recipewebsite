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

      $recipeNumber = $dao->getRecipeCount();
      $recipesPerPage = 10;
      if (!isset($_GET['page'])) {
        $page = 0;
      } else {
        $page = $_GET['page'];	
        if ($page < 0 || $recipeNumber <= $recipesPerPage * $page) {
          header('Location: '.'index.php');
          die();
        }
      }
      $displayPrevButton = ($page > 0) ? '' : 'hidden';

      $displayNextButton = ($recipeNumber > $recipesPerPage * ($page + 1)) ? '' : 'hidden';


	  $result = $dao->getRecipes($recipesPerPage, $page * $recipesPerPage);
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
                <button id="prev_button" class="<?php echo $displayPrevButton; ?>">Prev</button>
                <button id="next_button" class="<?php echo $displayNextButton; ?>">Next</button>
            </li>
        </ul>
        <script src="page.js" defer></script>
    </div>
  </body>
</html>
