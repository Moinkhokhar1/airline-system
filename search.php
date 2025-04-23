<?php
include 'db.php';
include 'header.php';

$from_location = "";
$to_location = "";

if (isset($_GET['from_location']) || isset($_GET['to_location'])) {
    $from_location = $conn->real_escape_string($_GET['from_location']);
    $to_location = $conn->real_escape_string($_GET['to_location']);

    $conditions = [];

    if (!empty($from_location)) {
        $conditions[] = "from_location LIKE '%$from_location%'";
    }

    if (!empty($to_location)) {
        $conditions[] = "to_location LIKE '%$to_location%'";
    }

    $sql = "SELECT * FROM flights";

    if (count($conditions) > 0) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }
} else {
    $sql = "SELECT * FROM flights";
}

$result = $conn->query($sql);
?>
    

<!DOCTYPE html>
<html>
<head>
    <title>Flight Search</title>
    <style>
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #555;
            text-align: center;
        }
        form {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Search Flights</h2>

<form method="get" action="">
    <input type="text" name="from_location" placeholder="From Location">
    <input type="text" name="to_location" placeholder="To Location">
    <button type="submit">Search Flights</button>
</form>


<table>
    <tr>
        <th>ID</th>
        <th>From Location</th>
        <th>To Location</th>
        <th>Flight Date</th>
        <th>Action</th>
    </tr>
    <tbody>
        <?php 
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
        ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['from_location'] ?></td>
                <td><?= $row['to_location'] ?></td>
                <td><?= $row['flight_date'] ?></td>
                <td>
                    <button type="button" onclick="Bookflight(<?= $row['id'] ?>)">Book</button>
                </td>
            </tr>
        <?php 
            } 
        } else {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        }
        ?>
</tbody>



</table>
<script>
      function Bookflight(id) {
        window.location.href = "book.php?id=" + id;
        header("Location: book.php");
    
    }
</script>
</body>
</html>
