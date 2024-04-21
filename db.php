<?php
$servername = "localhost:3306";
$username = "myrna223";
$password = "4a#192gZj";
$dbname = "user_livewell";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
