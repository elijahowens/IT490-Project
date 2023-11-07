<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'dbconnect.php';
include 'RabbitMQFunctions.php';

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
