<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Select Your Seat</title>
    <style>
        .seat {
            width: 40px;
            height: 40px;
            background-color: #ccc;
            border: 1px solid #999;
            border-radius: 5px;
            margin: 5px;
            text-align: center;
            line-height: 40px;
            cursor: pointer;
            user-select: none;
            transition: 0.3s;
        }

        .seat.selected {
            background-color: green;
            color: white;
        }

        .seat.occupied {
            background-color: red;
            cursor: not-allowed;
        }

        .seat-row {
            display: flex;
            justify-content: center;
        }

        .screen {
            width: 80%;
            margin: 20px auto;
            padding: 10px;
            background: #eee;
            text-align: center;
            border-radius: 5px;
            font-weight: bold;
        }

        .seat-map {
            width: 60%;
            margin: auto;
        }

        .btn {
            margin-top: 20px;
            display: block;
            text-align: center;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background: #28a745;
            border: none;
            color: white;
            cursor: pointer;    
        }
        .seat-row {
    display: flex;
    justify-content: center;
    margin-bottom: 10px;
}

    </style>
</head>
<body>
    <br>
<h2 style="text-align:center;">Select Your Seat</h2><br>    
<div class="seat-map">
<?php
$rows = 10;
$cols = 5;

for ($r = 1; $r <= $rows; $r++) {
    echo "<div class='seat-row'>";
    for ($c = 1; $c <= $cols; $c++) {
        if ($c == 3) {
            // Add gap after 2nd seat
            echo "<div style='width: 30px;'></div>";
        }

        $seat = chr(64 + $r) . $c; // A1, A2, ...
        echo "<div class='seat' data-seat='$seat'>$seat</div>";
    }
    echo "</div>";
}
?>

</div>

<div class="btn">
    <form method="post" action="confirm_booking.php">
        <input type="hidden" name="selected_seat" id="selected_seat">
        <button type="submit">Confirm Selection</button>
    </form>
</div>

<script>
    const seats = document.querySelectorAll('.seat');
    const seatInput = document.getElementById('selected_seat');

    seats.forEach(seat => {
        seat.addEventListener('click', function () {
            if (seat.classList.contains('occupied')) return;

            // Deselect all other seats (if only one seat is allowed)
            seats.forEach(s => s.classList.remove('selected'));
            
            seat.classList.add('selected');
            seatInput.value = seat.getAttribute('data-seat');
        });
    });
</script>

</body>
</html>
