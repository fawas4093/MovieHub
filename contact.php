<?php

include 'connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $feed_name = $conn->real_escape_string($_POST['name']);  
    $feed_email = $conn->real_escape_string($_POST['email']);  
    $feedback = $conn->real_escape_string($_POST['message']);  


    $sql = "INSERT INTO feedback (feed_name, feed_email, feedback) VALUES ('$feed_name', '$feed_email', '$feedback')";

    if ($conn->query($sql) === TRUE) {
        header("Location: feedanimation.php");
    } else {
        echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

$conn->close();
?>
