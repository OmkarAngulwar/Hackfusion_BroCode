<?php include 'nav.php'; ?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Projects</title>
</head>
<body> -->

<link rel="stylesheet" href="css/table.css">

    <div class="table-body">
        <?php session_start(); ?>
        <h2>Projects Uploaded By User : <span style='color:orange; font-size:45px;'><?php echo $_SESSION['username'];  ?></span></h2>
        <?php
        $name=$_SESSION['username'];
        ?>
        <table class="content-table">
            <thead>
                <tr>
                    <td>Sr.No.</td>
                    <td>Project Name</td>
                    <td>Created By</td>
                    <td>Technologies used</td>
                    <td>Code</td>
                </tr>
            </thead>

            <tbody>
                <?php
                    include 'connect.php';
                    $i=1;
                    $rows=mysqli_query($con,"SELECT * FROM uploads WHERE username='$name'");
                ?> 
                <?php foreach($rows as $row) :  ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row["Project_Name"]; ?></td>
                    <td><?php echo $row["username"]; ?></td>
                    <td><?php echo $row["technologies"]; ?></td>
                    <td><a href="<?php echo $row["file"]; ?>">View Code</a></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>
</html>