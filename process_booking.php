<?php

include 'connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $email = $_SESSION['email'];

    $stmt = $conn->prepare("SELECT user_id FROM registration WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];

    $movie_id = isset($_POST['movie_id']) ? intval($_POST['movie_id']) : 0;

    $booking_date = isset($_POST['booking_date']) ? $_POST['booking_date'] : '';
    $amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;

    if ($movie_id > 0 && $user_id > 0 && !empty($booking_date)) {
        
        $stmt = $conn->prepare("INSERT INTO booking (movie_id, user_id, telecast_time) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $movie_id, $user_id, $booking_date);

        
        if ($stmt->execute()) {
            echo "";

            
        } else {
            echo "Error: " . $stmt->error;
        }

        
        $stmt->close();
    } else {
        echo "Invalid input data.";
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #eee;
        }

        .card {
            border: none;
        }

        .inputbox span {
            position: absolute;
            top: 7px;
            left: 11px;
            transition: 0.5s;
        }

        .inputbox input:focus~span,
        .inputbox input:valid~span {
            transform: translateY(-15px);
            font-size: 12px;
        }

        .atm-card {
            background: linear-gradient(135deg, #5a2ec9, #7d45e0);
            color: #fff;
            border-radius: 15px;
            padding: 20px;
            width: 100%;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .atm-card-header {
            font-size: 14px;
        }

        .bank-name {
            font-weight: bold;
            font-size: 18px;
        }

        .chip-icon {
            width: 40px;
        }

        .atm-card-number {
            font-size: 18px;
            letter-spacing: 3px;
        }

        .atm-card-info span {
            font-size: 10px;
            text-transform: uppercase;
        }

        .holder-name {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
        }

        .atm-card-info p {
            margin: 0;
            font-size: 14px;
        }
    </style>
    <title>Payment</title>
</head>

<body>
    <form action="payment.php" method="post">
    <div class="container mt-5 px-5">
        <div class="mb-4">
            <h2>Confirm order and pay</h2>
            <p>Please make the payment, after that you can enjoy all the features and benefits.</p>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card p-3">
                    <h6 class="text-uppercase">Payment details</h6>

                    <div class="inputbox mt-3 position-relative">
                        <input type="text" name="name" class="form-control" required pattern="^[A-Za-z\s]+$">
                        <span>Name on card</span>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="inputbox mt-3 position-relative">
                                <input type="text" name="card_number" class="form-control" required pattern="^[0-9]+$" title="Please enter only numbers">
                                <span>Card Number</span>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex flex-row">
                                <div class="inputbox mt-3 me-2 position-relative">
                                    <input type="text" name="expiry" class="form-control" required  pattern="^[0-9]+$" title="Please enter only numbers">
                                    <span>Expiry</span>
                                </div>
                                <div class="inputbox mt-3 position-relative">
                                    <input type="text" name="cvv" class="form-control" required  pattern="^[0-9]+$" title="Please enter only numbers">
                                    <span>CVV</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 mb-4">
                        <h6 class="text-uppercase">Billing Address</h6>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="inputbox mt-3 position-relative">
                                    <input type="text" name="street_address" class="form-control" required pattern="^[A-Za-z\s]+$">
                                    <span>Street Address</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="inputbox mt-3 position-relative">
                                    <input type="text" name="city" class="form-control" required pattern="^[A-Za-z\s]+$">
                                    <span>City</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="inputbox mt-3 position-relative">
                                    <input type="text" name="state" class="form-control" required pattern="^[A-Za-z\s]+$">
                                    <span>State/Province</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="inputbox mt-3 position-relative">
                                    <input type="text" name="zip" class="form-control" required  pattern="^[0-9]+$" title="Please enter only numbers">
                                    <span>Zip Code</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                <div class="mt-4 mb-4 d-flex justify-content-between">
                    <a href="booking.php" class="btn btn-secondary">Previous step</a>
                    
                    <button type="submit" class="btn btn-success px-3">submit</button>
                </div>

                </form>

            </div>

            <div class="col-md-4">
                <!-- ATM Card Section -->
                <div class="atm-card p-3">
                    <div class="atm-card-header d-flex justify-content-between">
                        <span class="bank-name">SBI</span>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/1/16/Chip-card-symbol.svg" alt="Chip" class="chip-icon">
                    </div>
                    <div class="atm-card-number mt-3">
                        <span>1234 5678 9012 3456</span>
                    </div>
                    <div class="atm-card-info mt-3 d-flex justify-content-between">
                        <div>
                            <span>Card Holder</span>
                            <p class="holder-name">XXXXXX</p>
                        </div>
                        <div>
                            <span>Expires</span>
                            <p>XXXXX</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>