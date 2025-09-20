<?php
// Include the connection file
include 'connection.php';

// Check if genre_id is passed through the query string
if (isset($_GET['genre_id'])) {
    $genre_id = $_GET['genre_id'];

    // Fetch the existing genre details from the database
    $stmt = $conn->prepare("SELECT * FROM genre WHERE genre_id = ?");
    $stmt->bind_param("i", $genre_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $genre = $result->fetch_assoc();
    $stmt->close();

    if (!$genre) {
        echo "Genre not found!";
        exit();
    }
}

// Handle the POST request to update the genre
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_genre'])) {
    $genre_name = $_POST['genre_name'];

    // Handle file upload if a new file is uploaded
    if (isset($_FILES['genere_img']) && $_FILES['genere_img']['error'] == 0) {
        // Set the target directory for uploaded files
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['genere_img']['name']);

        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES['genere_img']['tmp_name'], $target_file)) {
            $genere_img = basename($_FILES['genere_img']['name']); // Get the image file name
        } else {
            echo "Failed to upload image.";
            exit();
        }
    } else {
        // If no new image is uploaded, keep the old image
        $genere_img = $genre['genere_img'];
    }

    // Update the genre in the database
    $stmt = $conn->prepare("UPDATE genre SET genre_name = ?, genere_img = ? WHERE genre_id = ?");
    $stmt->bind_param("ssi", $genre_name, $genere_img, $genre_id);

    if ($stmt->execute()) {
        echo "Genre updated successfully!";
        header('Location: genre.php'); // Redirect to the main page after updating
    } else {
        echo "Error updating genre: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Genre</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit Genre</h2>

        <form action="#" method="post" enctype="multipart/form-data" class="mb-4">
            <div class="mb-3">
                <label for="genre_name" class="form-label">Genre Name:</label>
                <input type="text" id="genre_name" name="genre_name" pattern="[A-Za-z\s]+" class="form-control" value="<?php echo htmlspecialchars($genre['genre_name']); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="genere_img" class="form-label">Genre Image:</label>
                <input type="file" id="genere_img" name="genere_img" class="form-control">
                <p>Current Image: <img src="uploads/<?php echo htmlspecialchars($genre['genere_img']); ?>" alt="<?php echo htmlspecialchars($genre['genre_name']); ?>" width="100"></p>
            </div>

            <input type="submit" name="update_genre" value="Update Genre" class="btn btn-primary">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
