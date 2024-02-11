<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Validation</title>
    <link rel="stylesheet" href="adminvalidation.css" />
    <style>
        #details-container {
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        #left-details, #right-details {
            width: 100%;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        #user-photo {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        #user-photo img {
            max-width: 100%;
            max-height: 100%;
        }

        #action-buttons {
            display: none;
            margin-top: 10px;
        }

        #action-buttons button {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h2>User Emails</h2>

    <form action="" method="post">
        <label for="search">Search:</label>
        <input type="text" id="search" name="search" placeholder="Enter email...">
        <button type="submit">Search</button>
    </form>

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

    // Handle search
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $searchTerm = $_POST["search"];
        $searchTerm = mysqli_real_escape_string($conn, $searchTerm);

        $sql = "SELECT email FROM reg WHERE email LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Email</th><th>Action</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["email"] . "</td><td><button class='select-btn' onclick='selectEmail(\"" . $row["email"] . "\")'>Select</button></td></tr>";
            }
            echo "</table>";
        } else {
            echo "No matching results found";
        }
    } else { // Display all emails if no search
        $sql = "SELECT email FROM reg";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Email</th><th>Action</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["email"] . "</td><td><button class='select-btn' onclick='selectEmail(\"" . $row["email"] . "\")'>Select</button></td></tr>";
            }
            echo "</table>";
        } else {
            echo "No data found";
        }
    }

    // Close the database connection
    $conn->close();
    ?>

    <div id="details-container" style="display: none;">
        <div id="left-details">
            <h2>College Details</h2>
            <table id="college-details"></table>
        </div>
        <div id="right-details">
            <h2>User Details</h2>
            <div id="user-photo"></div>
            <div id="action-buttons">
                <button onclick="rejectUser()">Reject</button>
                <button onclick="acceptUser()">Accept</button>
            </div>
        </div>
    </div>

    <script>
        var selectedEmail = null;

        function selectEmail(email) {
            // Show the details container
            document.getElementById('details-container').style.display = 'flex';

            // Fetch details from the college table
            fetchCollegeDetails(email);

            // Fetch email and idcard photo from the reg table
            fetchRegDetails(email);

            // Set the selected email
            selectedEmail = email;

            // Show the action buttons
            document.getElementById('action-buttons').style.display = 'block';
        }

        function fetchCollegeDetails(email) {
            // AJAX request to fetch details from the college table
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Parse JSON response
                    var details = JSON.parse(this.responseText);

                    // Display details in the 'college-details' table
                    displayDetails('college-details', details);
                }
            };
            xhr.open("GET", "get_college_details.php?email=" + email, true);
            xhr.send();
        }

        function fetchRegDetails(email) {
            // AJAX request to fetch details from the reg table
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Parse JSON response
                    var details = JSON.parse(this.responseText);

                    // Display details in the 'user-photo' div
                    displayUserDetails(details);
                }
            };
            xhr.open("GET", "get_reg_details.php?email=" + email, true);
            xhr.send();
        }

        function displayDetails(tableId, details) {
            var table = document.getElementById(tableId);
            table.innerHTML = ""; // Clear existing content

            // Create header row
            var headerRow = table.insertRow();
            for (var key in details[0]) {
                var headerCell = headerRow.insertCell();
                headerCell.innerHTML = "<strong>" + key + "</strong>";
            }

            // Create data row
            var dataRow = table.insertRow();
            for (var key in details[0]) {
                var dataCell = dataRow.insertCell();
                dataCell.innerHTML = details[0][key];
            }
        }

        function displayUserDetails(details) {
            var userPhotoDiv = document.getElementById('user-photo');
            userPhotoDiv.innerHTML = ""; // Clear existing content

            // Create image element
            var userPhoto = document.createElement('img');
            userPhoto.src = "data:image/jpeg;base64," + details[0]['idcard']; // Assuming idcard is the column name

            // Append image to the 'user-photo' div
            userPhotoDiv.appendChild(userPhoto);
        }

        function rejectUser() {
    var confirmReject = confirm("Are you sure you want to reject this user?");
    if (confirmReject) {
        // Send an AJAX request to reject_user.php to delete the user from 'reg' table
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
                // Reload the page or update the email table after successful deletion
                // You may want to update the table without refreshing the entire page
                location.reload();
            }
        };
        xhr.open("POST", "reject_user.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("email=" + selectedEmail);
    }
}



function acceptUser() {
    var confirmAccept = confirm("Are you sure you want to accept this user?");
    if (confirmAccept) {
        // Send an AJAX request to perform the acceptance actions
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
                // Reload the page or update the email table after successful acceptance
                // You may want to update the table without refreshing the entire page
                location.reload();
            }
        };
        xhr.open("POST", "accept_user.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("email=" + selectedEmail);
    }
}



    </script>
</body>
</html>
