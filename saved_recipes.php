<?php include 'nav.php'; ?>
<div>
    <ul id="recipes" class="vertical-flexbox">
        <li>
            <h1>Saved Recipes</h1>
        </li>
    </ul>
    <script src="unsaveRecipeAjax.js" defer></script>
    <?php
    session_start();
    require_once 'Dao.php';

    $userId = $_SESSION['user_id'];
    $limNum = 10;
    $offNum = 0;

    $dao = new Dao();
    $savedIds = $dao->getSavedRecipes($limNum, $offNum, $userId);
    foreach ($savedIds as $savedId) {
        if (!empty($savedId)) {
            // get recipe id
            $savedId = $savedId['recipe_id'];
        }

        $recipe = $dao->getRecipe($savedId);
        echo '<div id="' . $savedId . '">';
        echo '<ul><ul class="container vertical-flexbox"';
        echo '<li><h2>' . htmlspecialchars($recipe['name'], ENT_QUOTES, 'UTF-8') . '</h2></li>';
        echo '<li><img src="' . $recipe['image_folder_path'] . '/' . $recipe['id'] . '.' . $recipe['extension'] . '"/></li>';
        echo '</ul><ul id="description_container" class="container vertical-flexbox">';
        echo '<li><h3>Description</h3></li>';
        echo '<li>' . htmlspecialchars($recipe['description'], ENT_QUOTES, 'UTF-8') . '</li>';
        echo '</ul><ul id="ingredients_container" class="container vertical-flexbox">';
        echo '<li><h3>Ingredients</h3></li>';
        echo '<li>' . htmlspecialchars($recipe['ingredients'], ENT_QUOTES, 'UTF-8') . '</li></ul></ul>';
        echo '<ul><li><button class="spaced_button"><a href="recipe.php?id=' . $recipe['id'] . '">View</a></button>';
        echo '<button id="remove_button" data-recipe-id="' . $savedId . '" class="spaced_button">Unsave</button></li></ul>';
        echo '</div>';
    }
    ?>
</div>
</body>
</html>