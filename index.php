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
      <ul>
	<ul class="container vertical-flexbox">
	  <li>
	  <img id="recipe_img" src="recipe_images/recipe_1.jpg"/>
	  </li>
	</ul>
        <ul id="ingredients_container" class="container vertical-flexbox">
	  <li>
	    <h2>Ingredients</h2>
	  </li>
	  <li>Potatoes</li>
	  <li>Tomatoes</li>
	  <li>Corn</li>
	</ul>
      </ul>
      <ul>
        <li>
	  <button "view_recipe">
	    <a href="recipe.php">View</a>
	  </button>
	</li>
      </ul>
      <ul>
	<ul class="container vertical-flexbox">
	  <li>
	  <img id="recipe_img" src="recipe_images/recipe_2.jpg"/>
	  </li>
	</ul>
        <ul id="ingredients_container" class="container vertical-flexbox">
	  <li>
	    <h2>Ingredients</h2>
	  </li>
	  <li>Potatoes</li>
	  <li>Tomatoes</li>
	  <li>Corn</li>
	</ul>
      </ul>
      <ul>
        <li>
	  <button "view_recipe">
	    <a href="recipe.php">View</a>
	  </button>
	</li>
      </ul>
    </div>
  </body>
</html>
