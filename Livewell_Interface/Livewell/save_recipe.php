
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save Recipe</title>
    <link rel="stylesheet" href="./css/recipes.css">
</head>
<body>

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

    
    <!-- Form for searching recipes -->
    <form id="search-form" method="GET">
    <h2>Search For Recipe</h2>
    <h3>Not sure what to make? Review some of our most viewed recipes below.</h3> 
    <br>
    <label for="searchQuery">Main-Ingredient:</label>
    <input type="text" id="searchQuery" name="searchQuery" required>
    <br>
    <button type="submit">Search</button>
    </form>

<!-- Display search results here -->
<div id="search-results">
</div>

<div id="message"></div>
<script src="./js/api.js"></script>
</body>
</html>

<?php
include("./php/db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Receive the JSON data sent from the frontend
    $json_data = file_get_contents('php://input');
    $recipe = json_decode($json_data, true);

    // Check if the request contains selectedRecipe
    if (isset($recipe['selectedRecipe'])) {
        // Handle saving the selected recipe here
        $selectedRecipe = $recipe['selectedRecipe'];

        // Extract data from the selected recipe
        $title = $selectedRecipe['title'];
        $ingredients = $selectedRecipe['ingredients'];
        $instructions = $selectedRecipe['instructions'];

        // Add validation and error handling as needed
        $stmt = $conn->prepare("INSERT INTO api_recipes (title, ingredients, instructions) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $ingredients, $instructions);
        $stmt->execute();

        // Get the auto-generated recipe_id value
        $recipe_id = $stmt->insert_id;

        $stmt->close();

        // Respond with a success status and the recipe_id value
        $response = array('status' => 'success', 'recipe_id' => $recipe_id);
        echo json_encode($response);

        // Respond with a success status
        http_response_code(200);
    } else {
        // Respond with an error status for an invalid request
        http_response_code(400);
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Check if the request contains a search query
    if (isset($_GET['searchQuery'])) {
        // Handle searching for recipes in the API here
        $searchQuery = $_GET['searchQuery'];
    } else {
        // Retrieve saved recipes from the database
        $sql = "SELECT * FROM api_recipes";
        $result = $conn->query($sql);

// Display the results in an HTML table
if ($result->num_rows > 0) {
    echo "<table><tr><th>Title</th><th>Description</th><th>Ingredients</th><th>Instructions</th><th>Read More</th></tr>";
    while ($row = $result->fetch_assoc()) {
        // Display a fixed number of words for the description, ingredients, and instructions
        $description = $row["description"];
        $words = explode(" ", $description);
        $short_description = implode(" ", array_slice($words, 0, 20));

        $ingredients = $row["ingredients"];
        $words = explode(" ", $ingredients);
        $short_ingredients = implode(" ", array_slice($words, 0, 20));

        $instructions = $row["instructions"];
        $words = explode(" ", $instructions);
        $short_instructions = implode(" ", array_slice($words, 0, 20));

        echo "<tr><td>" . $row["title"] . "</td><td class='description-cell'>" . (strlen($description) > 100 ? substr($short_description, 0, 100) . "..." : $short_description) . "</td><td class='ingredients-cell'>" . (strlen($ingredients) > 100 ? substr($short_ingredients, 0, 100) . "..." : $short_ingredients) . "</td><td class='instructions-cell'>" . (strlen($instructions) > 100 ? substr($short_instructions, 0, 100) . "..." : $short_instructions) . "</td><td><a href='recipe.php?Id=" . $row["Id"] . "'>Read More</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
    }
} else {
    // Respond with a method not allowed status
    http_response_code(405);
}
?>

