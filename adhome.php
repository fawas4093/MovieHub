<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bento Grid</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #111;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            box-sizing: border-box;
        }

        .bento-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-auto-rows: 1fr;
            gap: 1rem;
            max-width: 900px;
            width: 90%;
        }

        .bento-item {
            background-color: #222;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .profile {
            grid-column: span 2;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .profile img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background-color: #333;
        }

        .profile-info {
            font-size: 1.2rem;
            line-height: 1.4;
        }

        .gallery-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            cursor: pointer;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #222;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.7);
            z-index: 1000;
            text-align: center;
        }

        .popup img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
        }

        .popup-content {
            margin-top: 1rem;
            color: #ccc;
        }

        .popup-close {
            margin-top: 1rem;
            background-color: #ff6600;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            color: #fff;
            cursor: pointer;
        }

        .popup-close:hover {
            background-color: #ff4500;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 999;
        }

        @media (max-width: 768px) {
            .bento-grid {
                grid-template-columns: 1fr;
            }

            .profile {
                grid-column: span 1;
                flex-direction: column;
                text-align: center;
            }
        }

        .email {
            color: #ff6600;
            font-weight: bold;
            margin-top: 1rem;
            word-wrap: break-word;
        }
    </style>
</head>

<body>
    <div class="bento-grid">
        <!-- Profile Section -->
        <div class="bento-item profile">
            <img src="images/vaalibhan.jpg" alt="Profile Image" class="gallery-image" id="profile-image">
            <div class="profile-info">
                <strong>Hi Fahad</strong><br />
                Welcome to Admin Dashboard.
            </div>
        </div>

        <!-- Popup Modal -->
        <div class="overlay" id="overlay"></div>
        <div class="popup" id="popup">
            <img src="images/vaalibhan.jpg" alt="Profile Image">
            <div class="popup-content">
                <strong>Log Out?</strong><br />
                Want to logout?<br />
            </div>
            <button class="popup-close" id="popup-close">log out</button>
        </div>

        <!-- Other Sections -->
        <div class="bento-item" onclick="location.href='genre.php';">
            <div>Add Genre</div>
            <div class="email">Want to add genre?</div>
        </div>

        <div class="bento-item" onclick="location.href='admovie.php';">
            <div>Add Movie</div>
            <div class="email">Want to add movie based on genre?</div>
        </div>

        <div class="bento-item" onclick="location.href='regdetails.php';">
            <div>Check Registration</div>
            <div class="email">Want to check customer registration?</div>
        </div>

        <div class="bento-item" onclick="location.href='bookingdetail.php';">
            <div>Check Booking</div>
            <div class="email">Want to check customer booking?</div>
        </div>

        <div class="bento-item" onclick="location.href='feeddetail.php';">
            <div>Check Feedback</div>
            <div class="email">Want to check customer feedback?</div>
        </div>

        <div class="bento-item" onclick="location.href='adlicen.php';">
        <div>Movie License</div>
        <div class="email">licence for movie selling
            
        </div>
        </div>
    </div>

    <script>
        const profileImage = document.getElementById('profile-image');
        const popup = document.getElementById('popup');
        const overlay = document.getElementById('overlay');
        const closeButton = document.getElementById('popup-close');

        // Show popup on image click
        profileImage.addEventListener('click', () => {
            popup.style.display = 'block';
            overlay.style.display = 'block';
        });

        // Close popup and redirect to adlog.php on button click
        closeButton.addEventListener('click', () => {
            popup.style.display = 'none';
            overlay.style.display = 'none';
            window.location.href = 'adlog.php';
        });

        // Close popup on overlay click
        overlay.addEventListener('click', () => {
            popup.style.display = 'none';
            overlay.style.display = 'none';
        });
    </script>
</body>

</html>
