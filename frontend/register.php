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
    
  $stmt = $pdo->prepare($sql);

        // Bind values to named placeholders
        $stmt->bindParam(':username', $user_input_username);
        $stmt->bindParam(':email', $user_input_email);
        $stmt->bindParam(':password', $user_input_password);

        // Execute the query
        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . implode(" - ", $stmt->errorInfo());
        }

        $stmt->closeCursor();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Close the PDO connection (optional as it's automatically closed at the end of the script)
unset($pdo);

?>
