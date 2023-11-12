    <?php include 'nav.php'; ?> 
    <div>
      <script src="recipeAjax.js" defer></script>
      <form id="createRecipe" action="createRecipe.php">
        <ul class="vertical-flexbox">
          <li>	
            <h2>Create New Recipe</h2>
       	  </li>
	  <li>
            <label for="recipe_name">Name Recipe:</label>
	    <input id="recipe_name" name="recipe_name" required/>
	  </li>
 	  <li>
            <label for="recipe_desc">Recipe Description:</label>
	    <input id="recipe_desc" name="recipe_desc" required/>
	  </li>
	  <li>
	    <label for="ingredients">Ingredients:</label>
	    <textarea id="ingredients" name="ingredients" required></textarea>
	  </li>
	  <li>
            <label for="recipe_img_upload">Upload Recipe Images:</label>
	    <input id="recipe_img_upload" name="recipe_img_upload" type="file" required/>
	  </li>
	  <li>
	    <input class="button" id="create_button" type="submit" value="Create"></input>
	  </li>
        </ul>
      </form>
    </div>
  </body>
</html>
