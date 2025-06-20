<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
include 'db.php';
$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $plate_number = $_POST['plate_number'];
    $rate = $_POST['rate'];
    $is_available = isset($_POST['is_available']) ? 1 : 0;
    $sql = "INSERT INTO cars (brand, model, plate_number, rate, is_available) VALUES ('$brand', '$model', '$plate_number', $rate, $is_available)";
    if ($conn->query($sql) === TRUE) {
        $success = 'Car added successfully!';
    } else {
        $error = 'Failed to add car. Plate number may already exist.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f9fa; }
        .container { max-width: 500px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px #bbb; }
        h2 { text-align: center; }
        form { margin-top: 20px; }
        label { display: block; margin: 10px 0 5px; }
        input[type="text"], input[type="number"] { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; }
        input[type="checkbox"] { margin-right: 8px; }
        button { width: 100%; padding: 10px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: red; text-align: center; }
        .success { color: green; text-align: center; }
        .links { display: flex; justify-content: space-between; margin-top: 20px; }
        .links a { color: #007bff; text-decoration: none; }
        .links a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add a New Car</h2>
        <?php if ($error) echo "<div class='error'>$error</div>"; ?>
        <?php if ($success) echo "<div class='success'>$success</div>"; ?>
        <form method="POST">
            <label>Brand:</label>
            <input type="text" name="brand" required>
            <label>Model:</label>
            <input type="text" name="model" required>
            <label>Plate Number:</label>
            <input type="text" name="plate_number" required>
            <label>Rate (UGX per day):</label>
            <input type="number" name="rate" step="0.01" min="0" required>
            <label><input type="checkbox" name="is_available" checked>Available</label>
            <button type="submit">Add Car</button>
        </form>
        <div class="links">
            <a href="dashboard.php">&larr; Dashboard</a>
            <a href="cars.php">View Cars &rarr;</a>
        </div>
    </div>
</body>
</html> 