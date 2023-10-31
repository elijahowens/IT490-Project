<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

$hostname = "localhost"; // Hostname
$db_username = "eco9"; // MySQL username
$db_password = "IT490Rocks!"; // MySQL password
$database = "users"; // Database name

$conn = new mysqli($hostname, $db_username, $db_password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_input_username = $_POST["username"];
    $user_input_email = $_POST["email"];
    $user_input_password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    $sql = "INSERT INTO user_info (username, email, password) VALUES (?, ?, ?)";
    
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $user_input_username, $user_input_email, $user_input_password);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
