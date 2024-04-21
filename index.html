<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include("./php/db.php");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_SESSION['userID'];
    $startingWeight = $_POST["starting-weight"];
    $currentWeight = $_POST["current-weight"];
    $goalWeight = $_POST["goal-weight"];
    $waterIntake = $_POST["water-intake"];
    $notes = $_POST["notes"];
    $created_date = date('Y-m-d H:i:s');

    // Insert the data into the user data table
    $sql = "INSERT INTO user_data (userID, starting_weight, current_weight, goal_weight, water_intake, notes, created_date) VALUES ('$userID', '$startingWeight', '$currentWeight', '$goalWeight', '$waterIntake', '$notes', '$created_date')";
    if ($conn->query($sql) === TRUE) {
        // Redirect to a new page to prevent form resubmission
        header("Location: index.php");
        exit;
    } else {
        echo "Error inserting data: " . $conn->error;
    }
}

// Retrieve saved recipes from the database for the current user
if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
    $recipe_sql = "SELECT * FROM recipes WHERE userID = $userID";
    $recipe_result = $conn->query($recipe_sql);
} else {
    // Handle the case when userID is not set in the session
    echo "User ID not found in the session.";
    exit;
}

// Retrieve all the user's data from the database
if (isset($_SESSION['userID'])) {
    $userData_sql = "SELECT * FROM user_data WHERE userID = $userID ORDER BY id DESC"; 
       $userData_result = $conn->query($userData_sql);
} else {
    // Handle the case when userID is not set in the session
    echo "User ID not found in the session.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/recipes.css">
    <title>Recipe Save</title>
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

<!-- Banner -->
<div class="jumbotron text-white text-center">
    <h1 class="display-4">Livewell User Interface</h1>
</div>

<!-- Goal box -->
<h1>Goal Tracker</h1>
<section class="grid-container">
        <div class="grid-child goal">
            <form method="post">
                <label for="starting-weight">Starting Weight:</label>
                <input type="number" id="starting-weight" name="starting-weight" required>

                <label for="current-weight">Current Weight:</label>
                <input type="number" id="current-weight" name="current-weight" required>

                <label for="goal-weight">Goal Weight:</label>
                <input type="number" id="goal-weight" name="goal-weight" required>

                <label for="water-intake">Water Intake:</label>
                <input type="number" id="water-intake" name="water-intake" required>

                <label for="notes">Notes:</label>
                <input type="text" id="notes" name="notes" required>
                        <br>
                <button type="submit">Save</button>
            </form>
        </div>          

<!-- User data section -->
<div class="grid-child user">
    <div class="user-data-section">
        <?php
        // Get the user data from the database
        $userData_sql = "SELECT * FROM user_data WHERE userID = $userID ORDER BY id DESC LIMIT 4"; // Add a LIMIT clause to limit the number of entries to 4
        $userData_result = $conn->query($userData_sql);
        if ($userData_result->num_rows > 0) {
            // Display all the entries
            while ($row = $userData_result->fetch_assoc()) {
                echo "<div class='user-data-entry'>";
                echo "<h3>" . $row['created_date'] . "</h3>";
                echo "<p><strong>Starting Weight:</strong> " . $row['starting_weight'] . "</p>";
                echo "<p><strong>Current Weight:</strong> " . $row['current_weight'] . "</p>";
                echo "<p><strong>Goal Weight:</strong> " . $row['goal_weight'] . "</p>";
                echo "<p><strong>Water Intake:</strong> " . $row['water_intake'] . "</p>";
                echo "<p><strong>Notes:</strong> " . $row['notes'] . "</p>";
                echo "</div>";
            }
            // Check if the user has more than 4 entries
            $userData_count_sql = "SELECT COUNT(*) AS count FROM user_data WHERE userID = $userID";
            $userData_count_result = $conn->query($userData_count_sql);
            $userData_count_row = $userData_count_result->fetch_assoc();
            $userData_count = $userData_count_row['count'];
            if ($userData_count > 4) {
                // Display the "View More" button
                echo "<div class='view-more'>";
                echo "<button><a href='user_data.php'>View More</a></button>";
                echo "</div>";
            }
        } else {
            echo "<p>No user data found.</p>";
        }
        ?>
    </div>
</div>
</section>


<!-- Recipes section -->
<div class="recipes-section">
    <h1>Recipes Dashboard</h1>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Instructions</th>
                <th>Ingredients</th>
                <th>Action</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $recipe_result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row["title"] ?></td>
                    <td><?= substr($row["description"], 0, 100) . "..." ?></td>
                    <td><?= substr($row["instructions"], 0, 100) . "..." ?></td>
                    <td><?= substr($row["ingredients"], 0, 100) . "..." ?></td>
                    <td>
                        <a href="view_recipe.php?id=<?= $row["id"] ?>">Read More</a>
                    </td>
                    <td>
                        <a href="edit_recipe.php?id=<?= $row["id"] ?>">Edit</a>
                        <a href="delete_recipe.php?id=<?= $row["id"] ?>">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script src="./js/index.js"></script>

</body>
</html>
