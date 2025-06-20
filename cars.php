<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
include 'db.php';
$cars = $conn->query('SELECT * FROM cars');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f9fa; }
        .container { max-width: 800px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px #bbb; }
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
        <h2>Available Cars</h2>
        <table>
            <tr>
                <th>Brand</th>
                <th>Model</th>
                <th>Plate Number</th>
                <th>Rate (UGX/day)</th>
                <th>Available</th>
            </tr>
            <?php while ($car = $cars->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($car['brand']); ?></td>
                <td><?php echo htmlspecialchars($car['model']); ?></td>
                <td><?php echo htmlspecialchars($car['plate_number']); ?></td>
                <td>UGX <?php echo htmlspecialchars($car['rate']); ?></td>
                <td><?php echo $car['is_available'] ? 'Yes' : 'No'; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <div class="back"><a href="dashboard.php">&larr; Back to Dashboard</a></div>
    </div>
</body>
</html> 