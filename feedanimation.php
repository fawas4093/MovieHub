<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You Animation</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #4caf50, #81c784);
            color: #fff;
        }

        .feedback-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 20px;
            border: 2px solid #fff;
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.6);
            animation: fadeIn 1s ease forwards, fadeOut 1s 4s ease forwards;
        }

        .thank-you-message h1 {
            font-size: 36px;
            margin: 10px 0;
            animation: bounce 1s ease infinite alternate;
        }

        .thank-you-message p {
            font-size: 18px;
            margin-top: 10px;
            opacity: 0;
            animation: fadeInText 2s ease forwards 1s;
        }

        .animated-icon {
            margin-top: 20px;
            opacity: 0;
            animation: scaleUp 1s ease forwards 2s;
        }

        .home-button {
            display: none; /* Initially hidden */
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #2196f3;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .home-button:hover {
            background-color: #1976d2;
        }

        svg {
            display: block;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }

        @keyframes fadeInText {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes bounce {
            from {
                transform: translateY(0);
            }
            to {
                transform: translateY(-10px);
            }
        }

        @keyframes scaleUp {
            from {
                transform: scale(0);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="feedback-container" id="feedbackContainer">
        <div class="thank-you-message">
            <h1>Thank You!</h1>
            <p>We appreciate your feedback.</p>
        </div>
        <div class="animated-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100" height="100">
                <path fill="green"
                    d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm-1 17.93l-4.62-4.62 1.41-1.41L11 14.1l5.2-5.2 1.41 1.41L11 17.93z" />
            </svg>
        </div>
    </div>
    <button class="home-button" id="homeButton" onclick="returnHome()">Return Home</button>

    <script>
        window.onload = function () {
            const feedbackContainer = document.getElementById("feedbackContainer");
            const homeButton = document.getElementById("homeButton");

            feedbackContainer.style.display = "flex"; 

            setTimeout(() => {
                feedbackContainer.style.display = "none"; 
                homeButton.style.display = "block"; 
            }, 5000);
        };

        function returnHome() {
            window.location.href = "home.php"; 
        }
    </script>
</body>

</html>
