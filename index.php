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
	    echo '<li><img src="' . $recipe['image_folder_path'] . '/' . $recipe['id'] . '.' . $recipe['extension'] . '"/></li>';
            echo '</ul><ul id="ingredients_container" class="container vertical-flexbox">';
            echo '<li><h2>Ingredients</h2></li>';
	    echo '<li>' . $recipe['ingredients'] . '</li></ul></ul>'; 
	    echo '<ul><li><button "view_recipe"><a href="recipe.php">View</a></button></li></ul>';
	  }
	?>
    </div>
  </body>
</html>
