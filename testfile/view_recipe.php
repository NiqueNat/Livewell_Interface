<?php
include("./php/db.php");

if (isset($_GET["id"])) {
    $recipe_id = $_GET["id"];
    // Query to retrieve a single recipe by ID
    $stmt = $conn->prepare("SELECT * FROM recipes WHERE id = ?");
    $stmt->bind_param("i", $recipe_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $recipe = $result->fetch_assoc();

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/recipes.css">
    <title>Edit Recipe</title>
</head>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php">My Saved Recipes</a></li>
            <li><a href="save_recipe.php">Meal Ideas</a></li>
            <li><a href="https://myrna67.web582.com/dynamic/livewell_interface-1/logout.html">Logout</a></li>
        </ul>
    </nav>
</header>
    <h1>View Recipe</h1>

    <section>
    <div class="container">
    <?php if (isset($recipe)): ?>
    <h2><?= $recipe["title"] ?></h2>
    <p><?= $recipe["description"] ?></p>
    <p><?= $recipe["instructions"] ?></p>
    <p><?= $recipe["ingredients"] ?></p>
    </div>
    </section>

    <!-- Add more HTML to display other recipe details, such as instructions, if needed -->

   <button> <a href="index.php">Back to Recipe List</a></button>

    <?php else: ?>
    <p>Recipe not found.</p>
    <a href="index.php">Back to Recipe List</a>
    <?php endif; ?>

    <!-- ... (script section and body closing tag) ... -->
    <script src="./js/index.php"></script>
</body>
</html>
