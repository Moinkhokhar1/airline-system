<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Confirm Booking</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        .container {
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background-color: #fff;
            text-align: center;
        }
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .info {
            font-size: 18px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Confirm Your Booking</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_seat'])) {
        $selectedSeat = htmlspecialchars($_POST['selected_seat']);

        // Simulating booking details
        $fromLocation = "Kolkata";
        $toLocation = "Hyderabad";
        $flightDate = "2025-05-05";
        $price = 2500; // INR
        $amountInPaise = $price * 100;

        echo "<div class='info'><strong>From:</strong> $fromLocation</div>";
        echo "<div class='info'><strong>To:</strong> $toLocation</div>";
        echo "<div class='info'><strong>Flight Date:</strong> $flightDate</div>";
        echo "<div class='info'><strong>Seat Selected:</strong> $selectedSeat</div>";
        echo "<div class='info'><strong>Amount:</strong> ₹$price</div>";
    ?>

    <button id="rzp-button" class="btn">Pay ₹<?= $price ?> with Razorpay</button>

    <form name="razorpay-form" action="payment_success.php" method="POST">
        <input type="hidden" name="seat" value="<?= $selectedSeat ?>">
        <input type="hidden" name="amount" value="<?= $price ?>">
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    </form>

    <script>
    const options = {
        "key": "YOUR_KEY_ID_HERE", // Replace with your Razorpay Key ID
        "amount": "<?= $amountInPaise ?>",
        "currency": "INR",
        "name": "Flight Booking",
        "description": "Seat <?= $selectedSeat ?> from <?= $fromLocation ?> to <?= $toLocation ?>",
        "handler": function (response){
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.forms["razorpay-form"].submit();
        },
        "prefill": {
            "name": "Test User",
            "email": "testuser@example.com",
            "contact": "9999999999"
        },
        "theme": {
            "color": "#007bff"
        }
    };

    const rzp = new Razorpay(options);
    document.getElementById('rzp-button').onclick = function(e){
        rzp.open();
        e.preventDefault();
    }
    </script>

    <?php } else {
        echo "<p>No seat selected. Please go back and choose a seat.</p>";
    } ?>
</div>

</body>
</html>
