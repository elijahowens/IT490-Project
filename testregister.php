
<?php
if (isset($_POST["submit-btn"])) {
$email = $_POST["email"];
    $password = $_POST["password"];
    $username = $_POST["username"];
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $post_data = file_get_contents('php://input');
    echo "<div> POST BODY <br>".$post_data."</div>";
}
else
{
	$email = "mae7@gmail.com";
	$password= "marlon123";
	$username = "mae7";
	$hash = password_hash($password, PASSWORD_BCRYPT);
}
        $db = new mysqli('127.0.0.1','marlonegoavil','Paul.5600','testdb');
        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$username, $email, $hash]);

            echo("You've registered, yay...");	
?>

<form action="testregister.php" method="POST">
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" required />
    </div>
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" required maxlength="30" />
    </div>
    <div>
        <label for="pw">Password</label>
        <input type="password" id="pw" name="password" required minlength="8" />
    </div>
    <input type="submit"name="submit-btn" value="Register" />
</form>

