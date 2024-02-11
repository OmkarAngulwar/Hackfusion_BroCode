<?php
// Database connection details
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

// Retrieve media details from the database
$sql = "SELECT * FROM media ORDER BY id DESC";
$result = $conn->query($sql);

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<style>";
echo ".media-container {";
echo "    display: flex;";
echo "    flex-wrap: wrap;";
echo "    justify-content: center;";
echo "    align-items: center;";
echo "    flex-direction: column;";
echo "}";
echo ".media-item {";
echo "    margin: 20px;";
echo "}";
echo ".media-image {";
echo "    max-width: 600px;";
echo "    max-height: 480px;";
echo "    width: auto;";
echo "    height: auto;";
echo "}";
echo "</style>";
echo "</head>";
echo "<body>";

echo "<div class='media-container'>";
// Display media on the webpage
while ($row = $result->fetch_assoc()) {
    echo "<div class='media-item'>";
    $fileType = $row['type'];
    $fileName = $row['file_name'];
    $filePath = $row['file_path'];

    // Display different HTML based on file type
    switch ($fileType) {
        case 'image/jpeg':
        case 'image/png':
        case 'image/gif':
            echo "<img src='Post/uploads/$fileName' alt='$fileName' class='media-image'>";
            break;
        case 'video/mp4':
            echo "<video controls width='300' autoplay muted loop><source src='Post/uploads/$fileName' type='video/mp4'>Your browser does not support the video tag.</video>";
            break;
        case 'audio/mpeg':
            echo "<audio controls><source src='Post/uploads/$fileName' type='audio/mpeg'>Your browser does not support the audio tag.</audio>";
            break;
        default:
            echo "Unsupported file type.";
            break;
    }
    echo "</div>";
}
echo "</div>";

echo "</body>";
echo "</html>";

// Close connection
$conn->close();
?>
