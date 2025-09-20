<?php

include 'connection.php';


$query = "SELECT * FROM genre";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Genres</title>

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
        body {
            background: #161616;
        }

        h2 {
            color: #fff;
        }

        .card {
            border: none;
            transition: all 500ms cubic-bezier(0.19, 1, 0.22, 1);
            overflow: hidden;
            border-radius: 20px;
            min-height: 450px;
            box-shadow: 0 0 12px 0 rgba(0, 0, 0, 0.2);
            background-size: 120%;
            background-repeat: no-repeat;
            background-position: center center;
            position: relative;
            color: #fff;
        }

        .card:hover {
            transform: scale(0.98);
            box-shadow: 0 0 5px -2px rgba(0, 0, 0, 0.3);
            background-size: 130%;
            transition: all 500ms cubic-bezier(0.19, 1, 0.22, 1);
        }

        .card-title {
            font-weight: 800;
            color: #fff;
        }

        .card-meta {
            color: rgba(255, 255, 255, 0.7);
            text-transform: uppercase;
            font-weight: 500;
            letter-spacing: 2px;
        }

        .card-body {
            margin-top: 30px;
            transition: all 800ms cubic-bezier(0.19, 1, 0.22, 1);
        }

        .card-footer {
            background: none;
            border-top: none;
            color: #fff;
        }

        .card-img-overlay {
            background: rgba(0, 0, 0, 0.5);
        }

        a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Genres</h2>

        <div class="row justify-content-center">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div class="col-md-4 mb-4">
                        <a href="cusadmovie.php?genre_id=' . $row['genre_id'] . '">
                            <div class="card text-dark card-has-bg" style="background-image:url(\'uploads/' . htmlspecialchars($row['genere_img']) . '\');">
                                <div class="card-img-overlay d-flex flex-column">
                                    <div class="card-body">
                                        <h4 class="card-title mt-0">' . htmlspecialchars($row['genre_name']) . '</h4>
                                    </div>
                                    <div class="card-footer mt-auto"></div>
                                </div>
                            </div>
                        </a>
                    </div>';
                }
            } else {
                echo '<p class="text-center">No genres available</p>';
            }
            ?>
        </div>
    </div>

 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

