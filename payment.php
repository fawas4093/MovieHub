
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success Animation</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f3f3f3;
        }

        .success-container {
            text-align: center;
            opacity: 0;
            transform: scale(0.9);
            transition: opacity 0.5s ease-in, transform 0.5s ease-in;
        }

        .checkmark-circle {
            width: 100px;
            height: 100px;
            position: relative;
            margin: 0 auto 20px;
        }

        .checkmark {
            width: 100%;
            height: 100%;
            stroke: #28a745;
            stroke-width: 3;
            stroke-linecap: round;
            stroke-linejoin: round;
            fill: none;
        }

        .checkmark-circle__path {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }

        .checkmark__check {
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.4s cubic-bezier(0.65, 0, 0.45, 1) 0.6s forwards;
        }

        .success-message {
            font-size: 24px;
            color: #28a745;
            margin-bottom: 20px;
        }

        .success-button {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .success-button:hover {
            background-color: #218838;
        }

        @keyframes stroke {
            100% {
                stroke-dashoffset: 0;
            }
        }

        /* Show success container */
        .show-success {
            opacity: 1;
            transform: scale(1);
        }
    </style>
    <div class="success-container">
        <div class="checkmark-circle">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark-circle__path" cx="26" cy="26" r="25" fill="none"/>
                <path class="checkmark__check" fill="none" d="M14 27l8 8 16-16"/>
            </svg>
        </div>
        <h2 class="success-message">Payment Successful!</h2>
        <a class="success-button" href="home.php">return to home</a>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                document.querySelector(".success-container").classList.add("show-success");
            }, 500); 
        });
    </script>
</body>
</html>
