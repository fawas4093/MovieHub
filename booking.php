<?php
session_start();
include 'connection.php';

$movie_id = isset($_GET['movie_id']) ? intval($_GET['movie_id']) : 0;
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

$user_name = $_SESSION['user_name'] ?? 'Unknown';
$email = $_SESSION['email'] ?? 'Unknown';
$phno = $_SESSION['phno'] ?? 'Unknown';

if ($movie_id > 0 && $user_id > 0) {
    $query = "SELECT admovie.*, genre.genre_name FROM admovie
              JOIN genre ON admovie.genre_id = genre.genre_id
              WHERE admovie.movie_id = $movie_id";
    $result = $conn->query($query);

    $user_query = "SELECT user_name, email, phno FROM registration WHERE user_id = $user_id";
    $user_result = $conn->query($user_query);

    $user_data = $user_result->num_rows > 0 ? $user_result->fetch_assoc() : null;

    if ($result->num_rows > 0) {
        $movie_data = $result->fetch_assoc();
        $posterImage = 'uploads/' . ($movie_data['poster_img'] ?? 'default.jpg');
    } else {
        echo 'Movie not found.';
        exit;
    }
} else {
    echo 'Invalid movie or user ID.';
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        h3 {
            text-align: center;
        }

        .bento-grid {
            display: grid;
            grid-template-areas: "large small1" "large new-left" "large small2";
            grid-template-columns: 3fr 2fr;
            grid-template-rows: 2fr 1fr 1fr;
            gap: 20px;
            width: 900px;
            height: 700px;
        }

        .card {
            background-color: #1e1e2f;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .large {
            grid-area: large;
            position: relative;
            background: url('<?php echo $posterImage; ?>') center center / cover no-repeat;
            filter: grayscale(100%);
            border-radius: 12px;
            overflow: hidden;
            height: 100%;
        }

        .large::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .overlay-content {
            position: relative;
            z-index: 2;
            color: #fff;
            padding: 20px;
        }

        .small1,
        .new-left,
        .small2 {
            background: linear-gradient(to left, #434343 10%, black 120%);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .button-container {
            margin-top: 20px;
            width: 900px;
            text-align: center;
        }

        .action-button {
            background-color: linear-gradient(to right, #DECBA4, #3E5151);
            color: #121212;
            border: none;
            border-radius: 12px;
            padding: 15px;
            width: 100%;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .action-button:hover {
            background-color: #28a745;
        }

        .action-button:active {
            transform: scale(0.98);
        }
    </style>
</head>

<body>
    <h3>Booking Confirmation</h3>
    <div class="bento-grid">
        <div class="card large">
            <div class="overlay-content">
                <h2><?php echo htmlspecialchars($movie_data['title'] ?? 'Unknown'); ?></h2>
                <p>Director: <?php echo htmlspecialchars($movie_data['director'] ?? 'Unknown'); ?></p>
            </div>
        </div>
        <div class="card small small1">
            <h3>Movie Details</h3>
            <p><strong>Title:</strong> <?php echo htmlspecialchars($movie_data['title'] ?? 'Unknown'); ?></p>
            <p><strong>Director:</strong> <?php echo htmlspecialchars($movie_data['director'] ?? 'Unknown'); ?></p>
            <p><strong>Cast:</strong> <?php echo htmlspecialchars($movie_data['cast'] ?? 'Unknown'); ?></p>
            <p><strong>Duration:</strong> <?php echo htmlspecialchars($movie_data['duration'] ?? 'Unknown'); ?> minutes</p>
        </div>
        <div class="card small new-left">
            <h3>Select Booking Date</h3>
            <input type="date" id="booking_date" name="booking_date" class="form-control" required>
        </div>
        <div class="card small small2">
            <h3>User Details</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($user_name); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($phno); ?></p>
            <p><strong>Amount:</strong> <?php echo htmlspecialchars($movie_data['amount'] ?? 'Unknown'); ?> rupees</p>
            <p><strong>Booking Date:</strong> <span id="display_booking_date">Not Selected</span></p>
        </div>
    </div>
    <div class="button-container">
        <form action="process_booking.php" method="POST">
            <input type="hidden" name="movie_id" value="<?php echo htmlspecialchars($movie_id); ?>">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
            <input type="hidden" name="amount" value="<?php echo htmlspecialchars($movie_data['amount'] ?? 0); ?>">
            <input type="hidden" name="booking_date" id="form_booking_date" value="">
            <button type="submit" class="action-button">Confirm Booking</button>
        </form>
    </div>
    <script>
        document.getElementById('booking_date').addEventListener('change', function() {
            document.getElementById('display_booking_date').innerText = this.value;
            document.getElementById('form_booking_date').value = this.value;
        });
        const today = new Date().toISOString().split("T")[0];
        document.getElementById("booking_date").setAttribute("min", today);
    </script>
</body>

</html>