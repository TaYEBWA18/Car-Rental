<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
include 'db.php';
$user = $_SESSION['user'];
$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_id = $_POST['car_id'];
    $date_borrowed = $_POST['date_borrowed'];
    $expected_return_date = $_POST['expected_return_date'];
    $status = 'active';
    // Get car rate
    $car = $conn->query("SELECT * FROM cars WHERE id = $car_id AND is_available = 1")->fetch_assoc();
    if ($car) {
        $days = (strtotime($expected_return_date) - strtotime($date_borrowed)) / (60*60*24);
        $days = $days > 0 ? $days : 1;
        $total_cost = $days * $car['rate'];
        $sql = "INSERT INTO rentals (customer_id, car_id, date_borrowed, expected_return_date, total_cost, status) VALUES ({$user['id']}, $car_id, '$date_borrowed', '$expected_return_date', $total_cost, '$status')";
        if ($conn->query($sql)) {
            $conn->query("UPDATE cars SET is_available = 0 WHERE id = $car_id");
            $success = 'Car rented successfully!';
        } else {
            $error = 'Failed to rent car.';
        }
    } else {
        $error = 'Selected car is not available.';
    }
}
$cars = $conn->query('SELECT * FROM cars WHERE is_available = 1');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent a Car</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f9fa; }
        .container { max-width: 500px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px #bbb; }
        h2 { text-align: center; }
        form { margin-top: 20px; }
        label { display: block; margin: 10px 0 5px; }
        select, input[type="date"] { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 10px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: red; text-align: center; }
        .success { color: green; text-align: center; }
        .back { display: block; margin: 20px 0 0 0; text-align: center; }
        .back a { color: #007bff; text-decoration: none; }
        .back a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Rent a Car</h2>
        <?php if ($error) echo "<div class='error'>$error</div>"; ?>
        <?php if ($success) echo "<div class='success'>$success</div>"; ?>
        <form method="POST">
            <label>Select Car:</label>
            <select name="car_id" required>
                <option value="">-- Select --</option>
                <?php while ($car = $cars->fetch_assoc()): ?>
                <option value="<?php echo $car['id']; ?>">
                    <?php echo htmlspecialchars($car['brand'] . ' ' . $car['model'] . ' (' . $car['plate_number'] . ') - UGX ' . $car['rate'] . '/day'); ?>
                </option>
                <?php endwhile; ?>
            </select>
            <label>Date Borrowed:</label>
            <input type="date" name="date_borrowed" required>
            <label>Expected Return Date:</label>
            <input type="date" name="expected_return_date" required>
            <button type="submit">Rent</button>
        </form>
        <div class="back"><a href="dashboard.php">&larr; Back to Dashboard</a></div>
    </div>
</body>
</html> 