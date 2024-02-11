<?php
// Replace these credentials with your own MySQL database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signupforms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["email"])) {
    $email = $_GET["email"];

    // Delete the email record from the reg table
    $stmt = $conn->prepare("DELETE FROM reg WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
