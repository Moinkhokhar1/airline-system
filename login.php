<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);

    if (!empty($email) && !empty($pass)) {
        $sql = "SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $pass);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            header("Location: dashboard.html");
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Please enter email and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('background.jpg');
            background-image: url('background.jpg');
            background-size: cover; /* Ensures the image covers the entire viewport */
            background-position: center center; /* Centers the image */
            background-repeat: no-repeat; /* Prevents the image from repeating */
            height: 100vh; /* Ensures full viewport height */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            background-color: #fff;
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h3 class="text-center mb-4">Login</h3>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post" action="login.php">
            <div class="mb-3">
                <label for="email" class="form-label">Email address:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-dark w-100">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS (optional for alerts, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
