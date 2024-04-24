<?php
session_start();
include("./php/db.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goal Tracker</title>
    <link rel="stylesheet" href="./css/recipes.css">
</head>
<body>
<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto"> 
                <button class="btn pg-2"><li class="nav-item"><a href="./index.php">Home</a></li></button>
                <button class="btn pg-2"><li class="nav-item"><a href="./add_recipe.php">Add Recipes</a></li></button>
                <button class="btn pg-2"><li class="nav-item"><a href="./save_recipe.php">Find Recipes</a></li></button>
                <button class="btn pg-2"><li class="nav-item"><a href="https://myrna67.web582.com//testfile/logout.html">Logout</a></li></button>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="grid-child user">
    <div class="user-data-section">
        <?php
        // Get the user data from the database
        $query = "SELECT * FROM user_data ORDER BY id DESC";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            // Display all the entries
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='user-data-entry'>";
                echo "<h5>" . $row["created_date"] . "</h5>";
                echo "<p><strong>Starting Weight:</strong> " . $row['starting_weight'] . "</p>";
                echo "<p><strong>Current Weight:</strong> " . $row['current_weight'] . "</p>";
                echo "<p><strong>Goal Weight:</strong> " . $row['goal_weight'] . "</p>";
                echo "<p><strong>Water Intake:</strong> " . $row['water_intake'] . "</p>";
                echo "<p><strong>Notes:</strong> " . $row['notes'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No user data found.</p>";
        }
        ?>
    </div>
</div>

<?php
// Close the database connection
mysqli_close($conn);
?> 
</body>
</html>
