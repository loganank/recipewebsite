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
          if ($recipeNumber <= $recipesPerPage * $_GET['page'])  {
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
    </div>
    <button id="nextButton">Next</button>

    <script>
        // Get the current page from the URL parameter
        const urlParams = new URLSearchParams(window.location.search);
        let currentPage = parseInt(urlParams.get('page')) || 0;

        // Event listener for the "Next" button
        document.getElementById('nextButton').addEventListener('click', function() {
            // Increment the current page
            currentPage++;

            // Redirect to index.php with the updated page parameter
            window.location.href = `index.php?page=${currentPage}`;
        });
    </script>
  </body>
</html>
