<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('dbconnect.php');
include 'RabbitMQFunctions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_input_username = $_POST["username"];
    $user_input_email = $_POST["email"];
    $user_input_password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    try {
        $pdo = new PDO("mysql:host=$hostname;dbname=$database", $db_username, $db_password);

        $sql = "INSERT INTO user_info (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':username', $user_input_username);
        $stmt->bindParam(':email', $user_input_email);
        $stmt->bindParam(':password', $user_input_password);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . implode(" - ", $stmt->errorInfo());
        }

        $stmt->closeCursor();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    unset($pdo);
}
?>
