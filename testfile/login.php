<?php
session_start();
include("./php/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Retrieve user information from the database
    $stmt = $conn->prepare("SELECT userID, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Successful login, set session variables
            $_SESSION["userID"] = $row["userID"];
            $_SESSION["email"] = $row["email"];
            header("Location: index.php"); // Redirect to the main page
            exit();
        } else {
            $login_error = "Incorrect password. <a href='./login.html'>Try again</a>";
        }
    } else {
        $login_error = "User not found. <a href='./register.html'>Register</a> or <a href='https://myrna67.web582.com/testfile/login.html'>Try again</a>";
    }

    $stmt->close();
}

// If there was an error, display it
if (isset($login_error)) {
    echo $login_error;
}
?>
