<?php

include 'connection.php';


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT feed_name, feed_email, feedback FROM feedback";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* General styling for the page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 1rem;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            margin-bottom: 1rem;
            color: #444;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        table th,
        table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #f4f4f9;
            color: #333;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .message {
            text-align: center;
            margin-top: 1rem;
            color: #444;
        }

        /* Additional styling for print */
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .container {
                box-shadow: none;
                padding: 0;
                margin: 0;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 0;
            }

            table th,
            table td {
                padding: 8px;
                border: 1px solid #ddd;
                text-align: left;
                font-size: 14px;
            }

            table th {
                background-color: #f4f4f9;
            }

            table tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            input[type="button"] {
                display: none; /* Hide the print button in print view */
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Feedback Details</h1>

        <?php if ($result->num_rows > 0): ?>
            <input type="button" class="btn btn-primary" onclick="printData();" value="PRINT" />
            <button onclick="location.href='adhome.php';" class="btn btn-secondary">back</button>
            <div id="printTable">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Feedback</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['feed_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['feed_email']); ?></td>
                                <td><?php echo htmlspecialchars($row['feedback']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="message">No feedback available.</p>
        <?php endif; ?>

        <?php $conn->close(); ?>
    </div>

    <script>
        function printData() {
            var divToPrint = document.getElementById("printTable");
            var newWin = window.open("");
            newWin.document.write("<html><head><title>Feedback Report</title>");
            newWin.document.write("<style>");
            newWin.document.write("table { width: 100%; border-collapse: collapse; }");
            newWin.document.write("table th, table td { padding: 8px; border: 1px solid #ddd; text-align: left; font-size: 14px; }");
            newWin.document.write("table th { background-color: #f4f4f9; }");
            newWin.document.write("table tr:nth-child(even) { background-color: #f9f9f9; }");
            newWin.document.write("</style></head><body>");
            newWin.document.write(divToPrint.outerHTML);
            newWin.document.write("</body></html>");
            newWin.document.close();
            newWin.print();
            newWin.close();
        }
    </script>
</body>

</html>
