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

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $email = $_GET["email"];

    // Fetch details from the 'reg' table
    $stmt = $conn->prepare("SELECT email, idcard FROM reg WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the data as an associative array
    $row = $result->fetch_assoc();

    // Encode the idcard blob data as base64
    $row["idcard"] = base64_encode($row["idcard"]);

    // Return the details as JSON
    header('Content-Type: application/json');
    echo json_encode([$row]);

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
