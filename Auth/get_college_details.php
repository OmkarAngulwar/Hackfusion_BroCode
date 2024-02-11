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
    $email = mysqli_real_escape_string($conn, $email);

    $sql = "SELECT * FROM college WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the first row (assuming email is unique)
        $details = $result->fetch_assoc();

        // Convert the result to JSON and output
        echo json_encode([$details]);
    } else {
        echo "No data found";
    }
}

$conn->close();
?>
