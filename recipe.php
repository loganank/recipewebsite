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
          <h1>Delicious Soup</h1>  
	</li>
      </ul>
      <ul>
	<ul class="container vertical-flexbox">
	  <li>
	  <img id="recipe_img" src="recipe_images/recipe_1.jpg"/>
	  </li>
	  <ul>
	    <li>
	      <button id="prev_img">Prev</button>
	    </li>
	    <li>
	      <button id="next_img">Next</button>
	    </li>
	  </ul>
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
          <button>Save</button>
	</li>
      </ul>
    </div>
  </body>
</html>
