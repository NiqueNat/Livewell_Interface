<?php
include("./php/db.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Check if the request contains a recipe ID
    if (isset($_GET['Id'])) {
        // Retrieve the recipe from the database
        $id = $_GET['Id'];
        $sql = "SELECT * FROM api_recipes WHERE Id = $id";
        $result = $conn->query($sql);

        // Display the recipe details
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<h1>" . $row["title"] . "</h1>";
            echo "<p>" . $row["ingredients"] . "</p>";
            echo "<p>" . $row["instructions"] . "</p>";
        } else {
            echo "Recipe not found";
        }
        if (isset($_GET['Id'])) {
            $id = $_GET['Id'];
            echo "Recipe ID: " . $id;
    } else {
        echo "Recipe ID not specified";
    }
} else {
    // Respond with a method not allowed status
    http_response_code(405);
}
}
?>

<!--handles the read more for the api recipes-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/recipes.css">
</head>
<body class="container ">
    
<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
<button class="btn pg-2"><li class="nav-item"><a href="./index.php">Home</a></li></button>
                <button class="btn pg-2"><li class="nav-item"><a href="./save_recipe.php">Find Recipes</a></li></button>                
                <button class="btn pg-2"><li class="nav-item"><a href="https://myrna67.web582.com/testfile/logout.html">Logout</a></li></button>
                </ul>
            </div>
        </div>
    </nav>
</header>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="./js/index.js"></script>
</body>
</html>
