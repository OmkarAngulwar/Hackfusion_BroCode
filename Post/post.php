<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Process uploaded media file
    if ($_FILES["media"]["error"] == 0) {
        // Get file details
        $file_name = $_FILES["media"]["name"];
        $file_type = $_FILES["media"]["type"];
        $file_size = $_FILES["media"]["size"];
        $file_tmp_name = $_FILES["media"]["tmp_name"];
        
        // Upload directory
        $upload_dir = "uploads/";

        // Move uploaded file to the upload directory
        $target_path = $upload_dir . basename($file_name);
        if (move_uploaded_file($file_tmp_name, $target_path)) {
            // Insert file details into database
            $sql = "INSERT INTO media (type, file_name, file_path) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            
            // Bind parameters
            $stmt->bind_param("sss", $file_type, $file_name, $target_path);
            
            // Execute the statement
            if ($stmt->execute()) {
                echo "File uploaded successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Error: " . $_FILES["media"]["error"];
    }

    // Close connection
    $conn->close();
}
?>
