    <?php include 'nav.php'; ?> 
    <div>
      <form action="createRecipe.php" method="post" enctype="multipart/form-data">
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
	    <label for="visibility">Visibility:</label>
            <select id="visibility" name="visibility" required>
	      <option value="private">Private</option>
              <option value="public">Public</option>
            </select>
          </li>
	  <li>
	    <input class="button" id="create_button" type="submit" value="Create"></input>
	  </li>
        </ul>
      </form>
    </div>
  </body>
</html>
