<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="index.css">
    <title>ShaRecipe</title>
  </head>
  <body>
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
	  $limNum = 10;
          $offNum = 0;

	  $dao = new Dao();
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
  </body>
</html>
