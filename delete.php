<?php
if (isset($_GET["id"])) {
$id = $_GET["id"];

$servername = "localhost";
$username = "root";
$password = "";
$database = "myshop";
$connection = new mysqli($servername, $username, $password, $database);

$sql = "DELETE FROM clients WHERE id=?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $id); // "i" represents integer type
$stmt->execute();

// Check for errors
if ($stmt->error) {
echo "Error: " . $stmt->error;
// Handle the error as needed
}

$stmt->close();
$connection->close();
}

header("location:/client-list/index.php");
exit;
?>