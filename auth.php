<?php

$conn = new mysqli("127.0.0.1", "elijahowens5", 'XiThetaSo1oAce', 'user_info');

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

