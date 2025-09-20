<?php
// Include the database connection file
include 'connection.php';  // Adjust the path based on your structure

// Start session if needed
session_start();

// Fetch all user registration details
$query = "SELECT * FROM registration";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">User Registration Details</h2>
        <input type="button" onclick="printData();" value="PRINT" class="btn btn-primary mb-4" />
        <button onclick="location.href='adhome.php';" class="btn btn-secondary">back</button>
        <div id="printTable">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['user_id'] . "</td>";
                            echo "<td>" . $row['user_name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3' class='text-center'>No users found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function printData() {
            var divToPrint = document.getElementById("printTable");
            var newWin = window.open("", "", "width=800, height=600");
            newWin.document.write("<html><head><title>Feedback Report</title>");
            newWin.document.write("<style>table { width: 100%; border-collapse: collapse; } td, th { padding: 8px; border: 1px solid #ddd; text-align: left; } </style>");
            newWin.document.write("</head><body>");
            newWin.document.write(divToPrint.outerHTML);
            newWin.document.write("</body></html>");
            newWin.document.close();
            newWin.print();
            newWin.close();
        }
    </script>
</body>
</html>

<?php

$conn->close();
?>
