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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Insert the details into the registration1 table
    $stmt = $conn->prepare("INSERT INTO registration1 (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    $stmt->execute();

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
