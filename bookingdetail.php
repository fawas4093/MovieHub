<?php

include 'connection.php';


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchDate = isset($_POST['search_date']) ? $_POST['search_date'] : '';

$sql = "
    SELECT 
        b.book_id, 
        m.title, 
        u.user_name, 
        u.email, 
        b.telecast_time 
    FROM 
        booking b
    JOIN 
        admovie m ON b.movie_id = m.movie_id
    JOIN 
        registration u ON b.user_id = u.user_id
";

if ($searchDate) {
    $sql .= " WHERE b.telecast_time = '$searchDate'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
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

        .search-form {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
        }

        .search-form input {
            padding: 10px;
            font-size: 16px;
            width: 250px;
            margin-right: 10px;
        }

        .search-form button {
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
        }

        .back-btn {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Booking Details</h1>

        <div class="search-form">
            <form method="POST">
                <input type="date" name="search_date" value="<?php echo htmlspecialchars($searchDate); ?>" required>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <div class="back-btn">
            <button class="btn btn-secondary" onclick="location.href='adhome.php';">Back</button>
        </div>

        <?php if ($result->num_rows > 0): ?>
            <input type="button" class="btn btn-primary" onclick="printData();" value="PRINT" />
            <div id="printTable">
            <table>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Movie Name</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>booking date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['book_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['telecast_time']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            </div>
        <?php else: ?>
            <p class="message">No booking details available.</p>
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
