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
    $password = $_POST["password"];

    // Hash the password before saving it to the database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Upload ID card photo
    $idCardData = file_get_contents($_FILES["idCard"]["tmp_name"]);

    // Save user information to the database
    $stmt = $conn->prepare("INSERT INTO reg (email, idcard, pass) VALUES (?, ?, ?)");

    $stmt->bind_param("ssb", $email, $idCardData, $hashedPassword);


    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
