<?php
session_start();
include 'config.php';

$id = $_GET['id']; // Mendapatkan id item dari query string
$stmt = $conn->prepare("SELECT * FROM items WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Mengecek apakah ada file gambar yang di-upload
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target_dir = "uploads/";
        move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $image);
        
        // Update data dengan gambar
        $stmt = $conn->prepare("UPDATE items SET name = ?, description = ?, image = ? WHERE id = ?");
        $stmt->execute([$name, $description, $image, $id]);
    } else {
        // Update data tanpa mengubah gambar
        $stmt = $conn->prepare("UPDATE items SET name = ?, description = ? WHERE id = ?");
        $stmt->execute([$name, $description, $id]);
    }

    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Item</title>
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
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }
        h2 {
            color: #5a7184;
        }
        input[type="text"], textarea, input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            padding: 10px 20px;
            background-color: #f9a8ae;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #f3969d;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Update Item</h2>
    <form method="POST" enctype="multipart/form-data">
        <label for="name">Nama Item:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($item['name']) ?>" required><br>

        <label for="description">Deskripsi Item:</label>
        <textarea name="description" id="description" rows="4" required><?= htmlspecialchars($item['description']) ?></textarea><br>

        <label for="image">Gambar (Opsional):</label>
        <input type="file" name="image" id="image"><br>
        <p>Gambar saat ini: 
            <?php if (!empty($item['image'])): ?>
                <img src="uploads/<?= htmlspecialchars($item['image']) ?>" alt="Gambar Item" width="100">
            <?php else: ?>
                <em>Tidak ada gambar</em>
            <?php endif; ?>
        </p>

        <button type="submit">Update Item</button>
    </form>
</div>

</body>
</html>
