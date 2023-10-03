<?php
include("./php/db.php");
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $instructions = $_POST["instructions"];
    $ingredients = $_POST["ingredients"];

    // Get the userID from the session
    session_start();
    $userID = $_SESSION['userID'];

    // Insert data into the 'recipes' table
    $stmt = $conn->prepare("INSERT INTO recipes (title, description, instructions, ingredients, userID) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $title, $description, $instructions, $ingredients, $userID);
    $stmt->execute();
    $stmt->close();

    // Redirect the user to the index.php file
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/recipes.css">
    <title>Add Recipe</title>
</head>
<body>
<!-- Add a header section here -->
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <button class="btn pg-2"><li class="nav-item"><a href="./index.php">Home</a></li></button>
                <button class="btn pg-2"><li class="nav-item"><a href="./save_recipe.php">Find Recipes</a></li></button>
                    <button class="btn pg-2"><li class="nav-item"><a href="https://myrna67.web582.com//testfile/logout.html">Logout</a></li></button>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Banner -->
<div class="jumbotron text-white text-center">
    <h1 class="display-4">Livewell Interface</h1>
</div>

<h1>Add Recipe</h1>
<!-- Form Section -->
<section class="container my-5">
    <form class="form rounded" method="POST" action="add_recipe.php">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="instructions">Instructions:</label>
        <textarea id="instructions" name="instructions" required></textarea>

        <label for="ingredients">Ingredients:</label>
        <textarea id="ingredients" name="ingredients" required></textarea>

        <button type="submit">Add Recipe</button>
    </form>
</section>

<!-- Enclose the button in a container -->
<div>
    <button><a href="index.php">Back to Recipe List</a></button>
</div>

<!-- ... (script section and body closing tag) ... -->
<script src="./js/index.js"></script>
</body>
</html>