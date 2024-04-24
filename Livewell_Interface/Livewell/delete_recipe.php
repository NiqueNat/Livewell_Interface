<?php
include("./php/db.php");

if (isset($_GET["id"])) {
    $recipe_id = $_GET["id"];
    // Delete a recipe from the 'recipes' table
    $stmt = $conn->prepare("DELETE FROM recipes WHERE id = ?");
    $stmt->bind_param("i", $recipe_id);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
}
?>
