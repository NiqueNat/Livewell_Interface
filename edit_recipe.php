<?php
include("./php/db.php");

if (isset($_GET["id"])) {
    $recipe_id = $_GET["id"];
    // Query to retrieve a single recipe by ID
    $stmt = $conn->prepare("SELECT * FROM recipes WHERE id = ?");
    $stmt->bind_param("i", $recipe_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $instructions = $_POST["instructions"];
    $ingredients = $_POST["ingredients"];
    // Update data in the 'recipes' table (you can add validation and error handling)
    $stmt = $conn->prepare("UPDATE recipes SET title = ?, description = ?, instructions = ?, ingredients = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $title, $description, $instructions, $ingredients, $recipe_id);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/recipes.css">
    <title>Edit Recipe</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    
            <li class="nav-item"><a href="save_recipe.php">Meal Ideas</a></li>
            <li class="nav-item"><a href="add_recipe.php">Add New Recipe</a></li>
            <li class="nav-item"><a href="https://myrna67.web582.com/dynamic/livewell_interface-1/logout.html">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Banner -->
<div class="jumbotron text-white text-center">
    <h1 class="display-4">Welcome</h1>
</div>

    <h1>Edit Recipe</h1>

    <form method="POST" action="edit_recipe.php?id=<?= $recipe_id ?>">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?= $row["title"] ?>" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?= $row["description"] ?></textarea>

        <label for="instructions">Instructions:</label>
        <textarea id="instructions" name="instructions" required><?= $row["instructions"] ?></textarea>

        <label for="ingredients">Ingredients:</label>
        <textarea id="ingredients" name="ingredients" required><?= $row["ingredients"] ?></textarea>

        <button type="submit">Update Recipe</button>
    </form>

    <a href="index.php">Back to Recipe List</a>

    <script src="./js/index.js"></script>
</body>
</html>
