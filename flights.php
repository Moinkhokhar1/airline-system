<?php
include 'db.php';

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM flights WHERE user_id = $user_id ORDER BY flight_date DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Flight Details</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3 class="mb-4">Your Flight Details</h3>

    <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Sr.no</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Date</th>
                        <th>Passengers</th>
                        <th>Booked At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = $result->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= htmlspecialchars($row['from_location']) ?></td>
                        <td><?= htmlspecialchars($row['to_location']) ?></td>
                        <td><?= htmlspecialchars($row['flight_date']) ?></td>
                        <td><?= htmlspecialchars($row['passengers']) ?></td>
                        <td><?= htmlspecialchars($row['created_at']) ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">No flights booked yet.</div>
    <?php endif; ?>
</div>
</body>
</html>
