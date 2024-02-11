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
    $email = $_POST["email"];

    // Prepare and execute the SQL statement to delete the user from 'reg' table
    $stmt = $conn->prepare("DELETE FROM reg WHERE email = ?");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        echo "User with email $email has been rejected and removed.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
