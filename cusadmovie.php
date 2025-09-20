<?php

include 'connection.php';

$genre_id = isset($_GET['genre_id']) ? intval($_GET['genre_id']) : 0;

$query = "SELECT admovie.*, genre.genre_name FROM admovie 
          JOIN genre ON admovie.genre_id = genre.genre_id
          WHERE admovie.genre_id = $genre_id"; 

$result = $conn->query($query);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movies</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <style>
        
        :root {
            --primary: hsl(222, 80%, 50%);
            --light: hsl(222, 50%, 95%);
            --titleMovie: hsla(0, 0%, 100%, 0.8);
        }

        *, *:before, *:after {
            box-sizing: border-box;
        }

        html {
            font-size: 18px;
            line-height: 1.5;
            font-weight: 300;
            color: #333;
            font-family: "Nunito Sans", sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background-color:  #161616;;
            background-attachment: fixed;
        }
        h2 {
            color: #fff;
        }

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .card-flip {
            width: calc(50% - 2rem); 
            min-width: calc(50% - 2rem); 
            height: 450px; 
            perspective: 1000px;
            margin: 1rem;
            position: relative;
            transition: transform 0.6s;
        }

        @media screen and (max-width: 800px) {
            .card-flip {
                width: calc(100% - 2rem); 
            }
        }

        .frontWeb, .back {
            display: flex;
            border-radius: 6px;
            background-position: center;
            background-size: cover;
            text-align: center;
            justify-content: center;
            align-items: center;
            position: absolute;
            height: 100%;
            width: 100%;
            backface-visibility: hidden;
            transform-style: preserve-3d;
            transition: ease-in-out 600ms;
        }

        .frontWeb {
            cursor: pointer;
            background-size: cover;
            padding: 2rem;
            font-size: 1.62rem;
            font-weight: 600;
            color: var(--titleMovie);
            overflow: hidden;
            font-family: Poppins, sans-serif;
        }

        .card-flip:hover .frontWeb {
            transform: rotateY(180deg);
        }

        .back {
            background: #fff;
            transform: rotateY(-180deg);
            padding: 0 2em;
        }

        .card-flip:hover .back {
            transform: rotateY(0deg);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Available Movies</h2>
        <div class="row content">
            <?php
            if ($result->num_rows > 0) {
               
                while ($row = $result->fetch_assoc()) {
                    $poster_img = htmlspecialchars($row['poster_img'] ?? 'default.jpg'); 
                    $title = htmlspecialchars($row['title'] ?? 'Untitled');
                    $movie_desc = htmlspecialchars($row['movie_desc'] ?? 'No description available');
                    $genre_name = htmlspecialchars($row['genre_name'] ?? 'Unknown');
                    $director = htmlspecialchars($row['director'] ?? 'Unknown');
                    $cast = htmlspecialchars($row['cast'] ?? 'Unknown');
                    $duration = htmlspecialchars($row['duration'] ?? 'Unknown'); 
                    $amount = htmlspecialchars($row['amount'] ?? 'Unknown'); 

                    echo '
                    <div class="col-md-6 mb-4"> <!-- Increased card size -->
                        <a href="booking.php?movie_id=' . $row['movie_id'] . '&user_id=1" style="text-decoration: none;">
                            <div class="card-flip">
                                <div class="frontWeb" style="background-image: url(uploads/' . $poster_img . ');">
                                    
                                </div>
                                <div class="back">
                                    <div>
                                        <p><strong>title:</strong> ' . $title . '</p>
                                        <p><strong>Description:</strong> ' . $movie_desc . '</p>
                                        <p><strong>Genre:</strong> ' . $genre_name . '</p>
                                        <p><strong>Director:</strong> ' . $director . '</p>
                                        <p><strong>Cast:</strong> ' . $cast . '</p>
                                        <p><strong>Duration:</strong> ' . $duration . ' minutes</p>
                                        <p><strong>Amount:</strong> ' . $amount . ' rupees</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>';
                }
            } else {
                echo '<p class="text-center">No movies available under this genre.</p>';
            }
            ?>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
