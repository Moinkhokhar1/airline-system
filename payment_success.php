<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Payment Success</title>
    <style>
        .container {
            max-width: 600px;
            margin: 100px auto;
            padding: 30px;
            text-align: center;
            border-radius: 10px;
            background-color: #e6ffe6;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .success {
            color: green;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .details {
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="success">✅ Payment Successful!</div>
    <div class="details">
        <?php
        if (isset($_POST['seat']) && isset($_POST['amount'])) {
            $seat = htmlspecialchars($_POST['seat']);
            $amount = htmlspecialchars($_POST['amount']);
            echo "<p>Your seat <strong>$seat</strong> has been booked.</p>";
            echo "<p>Amount Paid: ₹<strong>$amount</strong></p>";
        } else {
            echo "<p>Invalid access.</p>";
        }
        ?>
    </div>
</div>

</body>
</html>
