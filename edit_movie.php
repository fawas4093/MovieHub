<?php
// Include database connection
include 'connection.php'; // Ensure connection.php connects to the database correctly

// Check if movie_id is provided in the URL
if (isset($_GET['movie_id'])) {
    $movie_id = $_GET['movie_id'];

    // Fetch movie details from the database
    $sql = "SELECT * FROM admovie WHERE movie_id = $movie_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc();
    } else {
        echo "Movie not found!";
        exit;
    }
}

// Handle form submission to update the movie details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Variables from the form
    $genre_id = $_POST['genre_id'];
    $title = $_POST['title'];
    $movie_desc = $_POST['movie_desc'];
    $director = $_POST['director'];
    $cast = $_POST['cast'];

    // Calculate duration in minutes from hours and minutes fields
    $hours = $_POST['duration_hours'];
    $minutes = $_POST['duration_minutes'];
    $duration = ($hours * 60) + $minutes; // Total duration in minutes

    // Convert amount to integer (remove any ₹ symbol if present)
    $amount = preg_replace('/[^0-9]/', '', $_POST['amount']);

    // Check if the poster image is updated
    if (isset($_FILES['poster_img']) && $_FILES['poster_img']['error'] == 0) {
        $poster_img = $_FILES['poster_img']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($poster_img);

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['poster_img']['tmp_name'], $target_file)) {
            // Update data in the database
            $sql = "UPDATE admovie SET genre_id = '$genre_id', poster_img = '$poster_img', title = '$title', movie_desc = '$movie_desc', 
                    duration = '$duration', director = '$director', cast = '$cast', amount = '$amount' WHERE movie_id = $movie_id";

            if ($conn->query($sql) === TRUE) {
                echo "Movie updated successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Failed to upload poster image.";
        }
    } else {
        // If poster image was not updated, update without changing the poster
        $sql = "UPDATE admovie SET genre_id = '$genre_id', title = '$title', movie_desc = '$movie_desc', 
                duration = '$duration', director = '$director', cast = '$cast', amount = '$amount' WHERE movie_id = $movie_id";

        if ($conn->query($sql) === TRUE) {
            echo "Movie updated successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movie</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
    <h2 class="mb-4">Edit Movie</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="genre" class="form-label">Genre:</label>
            <select name="genre_id" id="genre" class="form-select" required>
                <?php
                // Fetch genre list from the genre table
                $sql = "SELECT genre_id, genre_name FROM genre";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $selected = ($row['genre_id'] == $movie['genre_id']) ? 'selected' : '';
                        echo "<option value='" . $row['genre_id'] . "' $selected>" . $row['genre_name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No genres available</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Movie Title:</label>
            <input type="text" name="title" id="title" class="form-control" maxlength="50" value="<?php echo $movie['title']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="poster_img" class="form-label">Poster Image:</label>
            <input type="file" name="poster_img" id="poster_img" class="form-control">
            <img src="uploads/<?php echo $movie['poster_img']; ?>" alt="Poster" width="100" class="mt-2">
        </div>

        <div class="mb-3">
            <label for="movie_desc" class="form-label">Movie Description:</label>
            <textarea name="movie_desc" id="movie_desc" class="form-control" maxlength="200"><?php echo $movie['movie_desc']; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="director" class="form-label">Director:</label>
            <input type="text" name="director" id="director" class="form-control" maxlength="50" value="<?php echo $movie['director']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="cast" class="form-label">Cast:</label>
            <input type="text" name="cast" id="cast" class="form-control" maxlength="50" value="<?php echo $movie['cast']; ?>" required>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label for="duration_hours" class="form-label">Duration (Hours):</label>
                <input type="number" name="duration_hours" id="duration_hours" class="form-control" value="<?php echo floor($movie['duration'] / 60); ?>" required min="0" max="24">
            </div>
            <div class="col-md-6">
                <label for="duration_minutes" class="form-label">Duration (Minutes):</label>
                <input type="number" name="duration_minutes" id="duration_minutes" class="form-control" value="<?php echo $movie['duration'] % 60; ?>" required min="0" max="59">
            </div>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount (₹):</label>
            <input type="text" name="amount" id="amount" class="form-control" value="<?php echo $movie['amount']; ?>" required pattern="\d+(\.\d{1,2})?">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="adhome.php" class="btn btn-secondary">Back</a>
    </form>

    <!-- Bootstrap JS (for responsive behavior and modals) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
