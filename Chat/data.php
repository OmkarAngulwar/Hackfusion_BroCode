<?php include 'nav.php'; ?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>
</head>
<body> -->
    
<link rel="stylesheet" href="css/table.css">
    
    <div class="table-body">
    <h1 style="margin-top:30px;">Project Showcase :</h1>
    
    <!-- Filter by Technology Form -->
    <form action="" method="post" onsubmit="return showSelectedLanguages()">
        <!-- Filter Label -->
        <label for="filter"><b>Filter by Technology:</b></label>
        <?php
        // Array of programming languages for the filter
        $programming_languages = array(
            "Java" => "Java",
            "Python" => "Python",
            "HTML" => "HTML",
            "CSS" => "CSS",
            "JS" => "JavaScript (JS)",
            "C++" => "C++",
            "Ruby" => "Ruby",
            "Swift" => "Swift",
            // Add other mappings as needed
        );
        
        // Generate checkboxes for each programming language
        foreach ($programming_languages as $key => $value) {
            echo "<input type='checkbox' name='technology[]' value='$key'>$value&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        }
        ?>
        <!-- Submit button for applying the filter -->
        <input type="submit" class="apply-filter-button" value="Apply Filter">
    </form>
    <style>
        .apply-filter-button {
            background-color: var(--accent-color);
            border-radius: 6px;
            font-weight: 700;
            color: white;
            padding: 12px 24px;
            box-shadow: 0 0 2px var(--secondary-text-color);
            transition: 0.2s ease-out;
        }
    </style>
    <!-- Table to display project information -->
    <table class="content-table">
        <!-- Table header -->
        <thead>
            <tr>
                <td>Sr.No.</td>
                <td>Project Name</td>
                <td>Created By</td>
                <td>Technologies used</td>
                <td>Code</td>
            </tr>
        </thead>
        <!-- Table body -->
        <tbody>
        <?php
        // Include the database connection
        include 'connect.php';
        
        $i = 1;
        $filter_conditions = '';

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['technology'])) {
            // Get selected technologies from the form
            $selected_technologies = $_POST['technology'];
            
            // Check if no technology is selected
            if (empty($selected_technologies)) {
                echo "<p>Please select at least one technology for filtering.</p>";
            } else {
                // Prepare conditions for the SQL query based on selected technologies
                $conditions = array();
                
                foreach ($selected_technologies as $language) {
                    $conditions[] = "(FIND_IN_SET('$language', technologies) OR FIND_IN_SET('" . getAbbreviation($language) . "', technologies))";
                }

                // Combine conditions with OR for the SQL query
                $filter_conditions = " AND (" . implode(" OR ", $conditions) . ")";
            }
        }

        // Fetch rows from the database based on filter conditions
        $rows = mysqli_query($con, "SELECT * FROM uploads WHERE 1 $filter_conditions ORDER BY id");
        
        // Display message if no projects are found for the selected filter
        if (mysqli_num_rows($rows) == 0) {
            echo "<p>No projects found for the selected filter.</p>";
        } else {
            // Display project information in the table
            foreach ($rows as $row) {
                echo "<tr>
                        <td>$i</td>
                        <td>{$row['Project_Name']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['technologies']}</td>
                        <td><a href='{$row['file']}'>View Code</a></td>
                    </tr>";
                $i++;
            }
        }

        // Function to get abbreviation for programming languages
        function getAbbreviation($language) {
            // Add more mappings as needed
            $abbreviations = array(
                "JavaScript" => "JS",
                // Add other mappings as needed
            );

            return $abbreviations[$language] ?? $language;
        }
        ?>
        </tbody>
    </table>
</div>

<!-- JavaScript to show selected checkboxes in the console -->
<script>
    function showSelectedLanguages(event) {
        event.preventDefault(); // Prevent the default form submission
        
        var selectedLanguages = [];
        var checkboxes = document.getElementsByName('technology[]');
        
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                selectedLanguages.push(checkbox.value);
            }
        });

        if (selectedLanguages.length === 0) {
            alert("Please select at least one technology for filtering.");
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
</script>

