<?php
// Include the connection file
include 'connection.php';

// Handle the POST request for adding a new genre
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_genre'])) {
    $genre_name = $_POST['genre_name'];

    // Handle file upload
    if (isset($_FILES['genere_img']) && $_FILES['genere_img']['error'] == 0) {
        // Set the target directory for uploaded files
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['genere_img']['name']);

        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES['genere_img']['tmp_name'], $target_file)) {
            $genere_img = basename($_FILES['genere_img']['name']); // Get the image file name

            // Prepare and bind the SQL statement
            $stmt = $conn->prepare("INSERT INTO genre (genre_name, genere_img) VALUES (?, ?)");
            $stmt->bind_param("ss", $genre_name, $genere_img);  // "ss" indicates two string parameters (genre_name and genere_img)

            // Execute the query and check for success
            if ($stmt->execute()) {
                echo "Genre added successfully with image!";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "No image uploaded or there was an error.";
    }
}

// Handle the GET request for deleting a genre
if (isset($_GET['delete_genre_id'])) {
    $genre_id = $_GET['delete_genre_id'];

    // Prepare delete query
    $stmt = $conn->prepare("DELETE FROM genre WHERE genre_id = ?");
    $stmt->bind_param("i", $genre_id);
    if ($stmt->execute()) {
        echo "Genre deleted successfully!";
    } else {
        echo "Error deleting genre: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch all genres from the database to display in a table
$query = "SELECT * FROM genre";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Genres</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Add New Genre</h2>

        <!-- Add Genre Form -->
        <form action="#" method="post" enctype="multipart/form-data" class="mb-4">
            <div class="mb-3">
                <label for="genre_name" class="form-label">Genre Name:</label>
                <input type="text"
                    id="genre_name"
                    name="genre_name"
                    class="form-control"
                    required
                    pattern="[A-Za-z\s]+"
                    title="Genre name can only contain letters and spaces">
            </div>

            <div class="mb-3">
                <label for="genere_img" class="form-label">Genre Image:</label>
                <input type="file" id="genere_img" name="genere_img" class="form-control" required>
            </div>

            <input type="submit" name="add_genre" value="Add Genre" class="btn btn-primary">
            <button onclick="location.href='adhome.php';" class="btn btn-secondary">back</button>
        </form>

        <!-- Display Genres in a Table -->
        <h2 class="text-center mb-4">Genres List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Genre Name</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '
                        <tr>
                            <td>' . $row['genre_id'] . '</td>
                            <td>' . htmlspecialchars($row['genre_name']) . '</td>
                            <td><img src="uploads/' . htmlspecialchars($row['genere_img']) . '" alt="' . htmlspecialchars($row['genre_name']) . '" width="100"></td>
                            <td>
                                <a href="edit_genre.php?genre_id=' . $row['genre_id'] . '" class="btn btn-warning btn-sm">Edit</a>
                                <a href="?delete_genre_id=' . $row['genre_id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this genre?\');">Delete</a>
                            </td>
                        </tr>
                        ';
                    }
                } else {
                    echo '<tr><td colspan="4" class="text-center">No genres available</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>