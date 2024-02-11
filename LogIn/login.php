<?php
// Enable error reporting for debugging purposes
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection details
$host = "localhost";
$username = "root";
$password = "";
$database = "signupforms";

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate user credentials
    $sql = "SELECT * FROM registration1 WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $row["password"])) {
            // Password is correct, redirect to a success page or perform further actions
            header("Location: success.html");
            exit();
        } else {
            // Invalid password, redirect to a login error page or display an error message
            header("Location: loginError.html");
            exit();
        }
    } else {
        // User not found, redirect to a login error page or display an error message
        header("Location: loginError.html");
        exit();
    }
}

// Close the database connection
$conn->close();
?>
