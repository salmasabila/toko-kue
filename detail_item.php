<?php
session_start();
include 'config.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM items WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Item</title>
    <style>
        body {
            background-color: #f7e8e3;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .detail-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        h1 {
            color: #5a7184;
        }

        img {
            width: 200px;
            margin-top: 20px;
            border-radius: 10px;
        }

        a {
            margin-top: 20px;
            display: inline-block;
            background-color: #f9a8ae;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        a:hover {
            background-color: #f3969d;
        }
    </style>
</head>
<body>
    <div class="detail-container">
        <h1>Detail Item</h1>
        <p>Nama: <?= $item['name'] ?></p>
        <img src="uploads/<?= $item['image'] ?>" alt="Gambar Item">
        <br><br>
        <a href="dashboard.php">Kembali</a>
    </div>
</body>
</html>
