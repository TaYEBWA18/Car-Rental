<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
include 'db.php';
$user = $_SESSION['user'];
$sql = "SELECT rentals.*, cars.brand, cars.model, cars.plate_number FROM rentals JOIN cars ON rentals.car_id = cars.id WHERE rentals.customer_id = {$user['id']} ORDER BY rentals.id DESC";
$rentals = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Rentals</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f9fa; }
        .container { max-width: 900px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px #bbb; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ccc; text-align: center; }
        th { background: #007bff; color: #fff; }
        tr:nth-child(even) { background: #f2f2f2; }
        .back { display: block; margin: 20px 0 0 0; text-align: center; }
        .back a { color: #007bff; text-decoration: none; }
        .back a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h2>My Rentals</h2>
        <table>
            <tr>
                <th>Car</th>
                <th>Plate Number</th>
                <th>Date Borrowed</th>
                <th>Expected Return</th>
                <th>Actual Return</th>
                <th>Total Cost</th>
                <th>Status</th>
            </tr>
            <?php while ($rental = $rentals->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($rental['brand'] . ' ' . $rental['model']); ?></td>
                <td><?php echo htmlspecialchars($rental['plate_number']); ?></td>
                <td><?php echo htmlspecialchars($rental['date_borrowed']); ?></td>
                <td><?php echo htmlspecialchars($rental['expected_return_date']); ?></td>
                <td><?php echo htmlspecialchars($rental['actual_return_date'] ?? '-'); ?></td>
                <td>UGX <?php echo htmlspecialchars($rental['total_cost']); ?></td>
                <td><?php echo htmlspecialchars($rental['status']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <div class="back"><a href="dashboard.php">&larr; Back to Dashboard</a></div>
    </div>
</body>
</html> 