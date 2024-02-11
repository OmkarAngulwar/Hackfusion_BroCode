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

    // Fetch data from 'college' and 'reg' tables based on the selected email
    $collegeQuery = "SELECT first_name, email FROM college WHERE email = '$email'";
    $collegeResult = $conn->query($collegeQuery);

    $regQuery = "SELECT pass FROM reg WHERE email = '$email'";
    $regResult = $conn->query($regQuery);

    if ($collegeResult->num_rows > 0 && $regResult->num_rows > 0) {
        $collegeData = $collegeResult->fetch_assoc();
        $regData = $regResult->fetch_assoc();

        // Insert data into 'registration1' table
        $insertQuery = "INSERT INTO registration1 (username, email, password) VALUES ('{$collegeData['first_name']}', '{$collegeData['email']}', '{$regData['pass']}')";
        if ($conn->query($insertQuery) === TRUE) {
            // Delete the record from 'reg' table
            $deleteQuery = "DELETE FROM reg WHERE email = '$email'";
            if ($conn->query($deleteQuery) === TRUE) {
                echo "User accepted and data transferred successfully.";
            } else {
                echo "Error deleting record from 'reg' table: " . $conn->error;
            }
        } else {
            echo "Error inserting record into 'registration1' table: " . $conn->error;
        }
    } else {
        echo "Error fetching data from 'college' or 'reg' table.";
    }
}

$conn->close();
?>
