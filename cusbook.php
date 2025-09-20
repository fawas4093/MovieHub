<?php

session_start();
include 'connection.php';


$email = isset($_SESSION['email']) ? $conn->real_escape_string($_SESSION['email']) : '';

if (!empty($email)) {
    
    $query = "SELECT booking.book_id, booking.telecast_time, admovie.amount, admovie.title, admovie.duration, admovie.poster_img 
              FROM booking 
              JOIN admovie ON booking.movie_id = admovie.movie_id 
              JOIN registration ON booking.user_id = registration.user_id
              WHERE registration.email = '$email'";
    $result = $conn->query($query);
    
    if (!$result || $result->num_rows == 0) {
        echo 'No bookings found for this user.';
        echo "User Email: " . $email;
        exit;
    }
} else {
    echo 'Invalid email or session expired.';
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel_booking_id'])) {
    $book_id = $conn->real_escape_string($_POST['cancel_booking_id']);
    $delete_query = "DELETE FROM booking WHERE book_id = '$book_id'";
    
    if ($conn->query($delete_query)) {
        echo "<script>alert('Booking cancelled successfully.'); window.location.href='cusbook.php';</script>";
    } else {
        echo "<script>alert('Error cancelling booking. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Bookings</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Your Bookings</h2>

       
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Movie</th>
                    <th>Poster</th>
                    <th>Duration</th>
                    <th>Booking Date</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td>
                        <img src="uploads/<?php echo htmlspecialchars($row['poster_img'] ?? 'default.jpg'); ?>" alt="Poster" style="width: 100px; height: 100px; object-fit: cover;">
                    </td>
                    <td><?php echo htmlspecialchars($row['duration']); ?> minutes</td>
                    <td><?php echo htmlspecialchars($row['telecast_time']); ?></td>
                    <td><?php echo htmlspecialchars($row['amount']); ?> rupees</td>
                    <td>
                        
                        <form method="POST" style="display: inline-block;">
                            <input type="hidden" name="cancel_booking_id" value="<?php echo $row['book_id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</body>
</html>
