<?php
include"db.php";                                                                                              
// include 'header.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $q = "SELECT * FROM flights WHERE id = $id";
    $data = mysqli_query($conn, $q);
    $num = mysqli_fetch_array($data);
} else {
    echo " ID not found in URL!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Booking Form</title>
</head>
<body>
    <div class="container">
        <h2>Ticket Booking Form</h2>
        <form action="select_seats.php" method="POST" onsubmit="return aadharcheck()">
            
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="from_location">From Location</label>
            <input type="text" id="from_location" name="from_location" required value="<?php echo $num['from_location']; ?>" readonly>

            <label for="to_location"> To Location:</label>
            <input type="text" id="to_location" name="to_location" required value="<?php echo $num['to_location']; ?>" readonly>

            <label for="flight_date">Flight Date</label>
            <input type="date" id="flight_date" name="flight_date" required value="<?php echo $num['flight_date']; ?>" readonly>

            <label for="aadhar">Enter Your Aadhar Number</label>
            <input type="text" id="aadhar" name="aadhar" value="">

            <button type="submit" >Select Seats</button>
        </form>
    </div>
</body>
</html>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 106%;
            padding: 10px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
    <script>
         function aadharcheck() {
        var aadharinput = document.getElementById("aadhar");
        var aadhar = aadharinput.value.trim();
        //alert(pannumber);
        var aadharpattern = /^[2-9][0-9]{11}$/;
        if (aadharpattern.test(aadhar)) {
            // alert("valid aadhar Number!!!!");
            return true;
        } else {
            alert("invalid aadhar");
            paninput.value = '';
            return false;
        }
    }
    </script>