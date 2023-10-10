<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="index.css">
    <title>ShaRecipe</title>
  </head>
  <body>
    <?php include 'nav.php'; ?> 
    <div>
      <ul class="vertical-flexbox">
        <li>	
          <h2>Create New Recipe</h2>
	</li>
	<li>
          <label for="recipe_name">Name Recipe:</label>
	  <input id="recipe_name"></textarea>
	</li>
	<li>
          <label for="recipe_desc">Recipe Description:</label>
	  <input id="recipe_desc"></textarea>
	</li>
	<li>
          <label for="recipe_img_upload">Upload Recipe Images:</label>
	  <input id="recipe_img_upload" type="file"></textarea>
	</li>
	<li>
	  <label for="add_ingredient">Upload Ingredients:</label>
	  <button id="add_ingredient">Add</button>
	</li>
	<li>
	   <label for="private_button">Visibility:</label>
	   <button id="private_button">Private</button>
           <button id="public_button">Public</button>
	<li>
	  <input class="button" id="create_button" type="submit" value="Create"></input>
	</li>
    </div>
  </body>
</html>
