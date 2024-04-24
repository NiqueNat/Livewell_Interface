<?php
include("./php/db.php");

// Ensure that the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Parse the JSON data sent from the client
    $data = json_decode(file_get_contents("php://input"));

    // Validate the data (you can add more validation)
    if (empty($data->title) || empty($data->description) || empty($data->ingredients) || empty($data->instructions)) {
        http_response_code(400); // Bad Request
        echo json_encode(array("message" => "Incomplete data. Please provide title, description, ingredients, and instructions."));
        exit;
    }

    // Insert the API-sourced recipe into the 'api_recipes' table
    $stmt = $conn->prepare("INSERT INTO api_recipes (title, description, ingredients, instructions) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $data->title, $data->description, $data->ingredients, $data->instructions);

    if ($stmt->execute()) {
        http_response_code(201); // Created
        echo json_encode(array("message" => "Recipe saved successfully."));
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(array("message" => "Failed to save the recipe."));
    }

    $stmt->close();
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(array("message" => "Method not allowed."));
}
?>
