<?php
// Include database connection
include 'connection.php'; // Ensure connection.php connects to the database correctly

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM admovie WHERE movie_id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Movie deleted successfully!";
    } else {
        echo "Error deleting movie: " . $conn->error;
    }
}

// Handle form submission
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

    // Upload poster image
    if (isset($_FILES['poster_img']) && $_FILES['poster_img']['error'] == 0) {
        $poster_img = $_FILES['poster_img']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($poster_img);

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['poster_img']['tmp_name'], $target_file)) {
            // Insert data into the database
            $sql = "INSERT INTO admovie (genre_id, poster_img, title, movie_desc, duration, director, cast, amount) 
                    VALUES ('$genre_id', '$poster_img', '$title', '$movie_desc', '$duration', '$director', '$cast', '$amount')";

            if ($conn->query($sql) === TRUE) {
                echo "New movie added successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Failed to upload poster image.";
        }
    } else {
        echo "No image uploaded or there was an error.";
    }
}

// Fetch all movies for display in the table
$movie_sql = "SELECT admovie.*, genre.genre_name FROM admovie 
              JOIN genre ON admovie.genre_id = genre.genre_id";
$movie_result = $conn->query($movie_sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
    <h2 class="mb-4">Add a New Movie</h2>
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
                        echo "<option value='" . $row['genre_id'] . "'>" . $row['genre_name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No genres available</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Movie Title:</label>
            <input type="text" name="title" id="title" class="form-control" maxlength="50" required>
        </div>

        <div class="mb-3">
            <label for="poster_img" class="form-label">Poster Image:</label>
            <input type="file" name="poster_img" id="poster_img" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="movie_desc" class="form-label">Movie Description:</label>
            <textarea name="movie_desc" id="movie_desc" class="form-control" maxlength="200"></textarea>
        </div>

        <div class="mb-3">
            <label for="director" class="form-label">Director:</label>
            <input type="text"
                name="director"
                id="director"
                class="form-control"
                maxlength="50"
                required
                pattern="[A-Za-z\s]+"
                title="Director's name should only contain letters and spaces">
        </div>

        <div class="mb-3">
            <label for="cast" class="form-label">Cast:</label>
            <input type="text" name="cast" id="cast" class="form-control" maxlength="50" required pattern="[A-Za-z\s]+"
                title="cast's name should only contain letters and spaces">
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label for="duration_hours" class="form-label">Duration (Hours):</label>
                <input type="number"
                    name="duration_hours"
                    id="duration_hours"
                    class="form-control"
                    placeholder="Hours"
                    required
                    min="0"
                    max="24"
                    title="Please enter a valid number of hours (0-24)">
            </div>
            <div class="col-md-6">
                <label for="duration_minutes" class="form-label">Duration (Minutes):</label>
                <input type="number"
                    name="duration_minutes"
                    id="duration_minutes"
                    class="form-control"
                    placeholder="Minutes"
                    required
                    min="0"
                    max="59"
                    title="Please enter a valid number of minutes (0-59)">
            </div>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount (₹):</label>
            <input type="text"
                name="amount"
                id="amount"
                class="form-control"
                placeholder="₹"
                required
                pattern="\d+(\.\d{1,2})?"
                title="Please enter a valid amount (e.g., 1234 or 1234.56)">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <button onclick="location.href='adhome.php';" class="btn btn-secondary">back</button>
    </form>

    <h2 class="mt-5">Movie List</h2>
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Genre</th>
                <th>Poster</th>
                <th>Title</th>
                <th>Description</th>
                <th>Duration</th>
                <th>Director</th>
                <th>Cast</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($movie_result->num_rows > 0) {
                while ($row = $movie_result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row['movie_id'] . "</td>
                        <td>" . $row['genre_name'] . "</td>
                        <td><img src='uploads/" . $row['poster_img'] . "' alt='Poster' width='50'></td>
                        <td>" . $row['title'] . "</td>
                        <td>" . $row['movie_desc'] . "</td>
                        <td>" . floor($row['duration'] / 60) . "h " . ($row['duration'] % 60) . "m</td>
                        <td>" . $row['director'] . "</td>
                        <td>" . $row['cast'] . "</td>
                        <td>₹" . $row['amount'] . "</td>
                        <td>
                            <a href='edit_movie.php?movie_id=" . $row['movie_id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='?delete_id=" . $row['movie_id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this movie?\")'>Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='10'>No movies available</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Bootstrap JS (for responsive behavior and modals) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>