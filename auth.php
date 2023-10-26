<?php
$hostname = "localhost"; // Hostname
$username = "eco9"; // MySQL username
$password = "IT490Rocks!"; // MySQL password
$database = "users"; // Database name
$conn = new mysqli($hostname, $username, $password, $database);

if($conn->connect_error)
{
        die("Connection failed: " . $conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

        $sql = "INSERT INTO user_info (username, email, password) VALUES (?, ?, ?)";
        // Print the SQL query for debugging
        echo "SQL Query: " . $sql . "<br>";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);

        if($stmt->execute())
        {
                echo "Registration successful!";

        }
        else
        {
                echo "Error: " . $conn->error;
        }

        $stmt->close();
}

$conn->close();
?>

