<?php
session_start();
include("./php/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the user already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // User does not exist, proceed with registration
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hashedPassword);
        $stmt->execute();
        $stmt->close();
        header("Location: login.html"); // Redirect to the login page after registration
        exit();
    } else {
        echo "User already exists. <a href='https://myrna67.web582.com/testfile/login.html'>Log in</a> or choose a different email.";
    }
}
?>
