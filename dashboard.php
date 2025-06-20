<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #e9ecef; }
        .container { max-width: 500px; margin: 60px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px #bbb; }
        h2 { text-align: center; }
        .links { display: flex; flex-direction: column; gap: 15px; margin-top: 30px; }
        a { display: block; padding: 12px; background: #007bff; color: #fff; text-align: center; border-radius: 4px; text-decoration: none; font-weight: bold; }
        a:hover { background: #0056b3; }
        .logout { background: #dc3545; }
        .logout:hover { background: #a71d2a; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h2>
        <div class="links">
            <a href="cars.php">View Cars</a>
            <a href="addcar.php">Add Car</a>
            <a href="rent.php">Rent a Car</a>
            <a href="tracker.php">Track My Rentals</a>
            <a href="logout.php" class="logout">Logout</a>
        </div>
    </div>
</body>
</html> 