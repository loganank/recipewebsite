    <?php include 'nav.php'; ?>
    <div>
      <?php
          require_once 'Dao.php';

	  if (isset($_GET['id'])) {
              $id = $_GET['id'];
              // Query the database to fetch the recipe details using $recipeId
              // Display the recipe details here
	      $dao = new Dao();
              $recipe = $dao->getRecipe($id);
	      echo '<ul class="vertical-flexbox" id="recipe_info"><li><h1>' . htmlspecialchars($recipe['name'], ENT_QUOTES, 'UTF-8') . '</h1></li></ul>';
              echo '<ul><ul class="container vertical-flexbox">';
              echo '<li><img src="' . $recipe['image_folder_path'] . '/' . $recipe['id'] . '.' . $recipe['extension'] . '"/></li>';
              echo '</ul><ul id="ingredients_container" class="container vertical-flexbox">';
              echo '<li><h3>Ingredients</h3></li>';
              echo '<li>' . htmlspecialchars($recipe['ingredients'], ENT_QUOTES, 'UTF-8') . '</li></ul></ul>';
              echo '<ul><li><button><a href="save_recipe.php?id=' . $recipe['id'] . '">Save</a></button></li></ul>';
            } else {
              echo '<ul class="vertical-flexbox error" id="recipe_info"><li><h4>Recipe ID not provided.</h4></li></ul>';
            }
        ?>
    </div>
  </body>
</html>
