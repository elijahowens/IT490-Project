<?php
// To edit
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'dbconnect.php';
include 'RabbitMQFunctions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_input_username = $_POST["username"];
    $user_input_password = $_POST["password"];

    $sql = "SELECT username, password FROM user_info WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user_input_username, $user_input_password);

    if ($stmt->execute()) {
        $stmt->bind_result($db_username, $db_password);

        if ($stmt->fetch()) {
            // Verify the password hash
            if (password_verify($user_input_password, $db_password)) {
                // Password matches; the user is authenticated
                echo "Login successful!";
            } else {
                // Password does not match
                echo "Incorrect password";
            }
        } else {
            // Username not found in the database
            echo "Username not found";
        }
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}

//$conn->close();
?>
