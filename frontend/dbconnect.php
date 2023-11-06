$hostname = "localhost"; // Hostname
$db_username = "eco9"; // MySQL username
$db_password = "IT490Rocks!"; // MySQL password
$database = "users"; // Database name

$conn = new mysqli($hostname, $db_username, $db_password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {
    echo "Connected ";
}
