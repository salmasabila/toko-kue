<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];  // Deskripsi baru
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";

    // Upload gambar
    move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $image);

    // Insert data ke database, termasuk deskripsi
    $stmt = $conn->prepare("INSERT INTO items (name, description, image) VALUES (?, ?, ?)");
    $stmt->execute([$name, $description, $image]);

    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="file"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h1>Tambah Item</h1>
<form method="POST" enctype="multipart/form-data">
    <label for="name">Nama Item:</label>
    <input type="text" name="name" id="name" required><br>

    <label for="description">Deskripsi Item:</label>
    <textarea name="description" id="description" rows="4" required></textarea><br>

    <label for="image">Gambar:</label>
    <input type="file" name="image" id="image" required><br>

    <button type="submit">Tambah Item</button>
</form>

</body>
</html>
