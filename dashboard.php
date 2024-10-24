<?php
session_start();
include 'config.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Ambil data item dari database
$stmt = $conn->prepare("SELECT * FROM items");
$stmt->execute();
$items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
            padding: 20px;
        }
        h1 {
            color: #4CAF50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            color: #4CAF50;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .action-btns {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>

<h1>Daftar Item</h1>
<a href="insert_item.php">Tambah Item</a>

<?php if ($items): ?>
    <table>
        <tr>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td><?= htmlspecialchars($item['description']) ?></td>
                <td>
                    <?php if (!empty($item['image'])): ?>
                        <img src="uploads/<?= htmlspecialchars($item['image']) ?>" alt="Image" width="100">
                    <?php else: ?>
                        <em>Tidak ada gambar</em>
                    <?php endif; ?>
                </td>
                <td class="action-btns">
                    <a href="detail_item.php?id=<?= $item['id'] ?>">Detail</a>
                    <a href="update_item.php?id=<?= $item['id'] ?>">Update</a>
                    <a href="delete_item.php?id=<?= $item['id'] ?>" onclick="return confirm('Yakin ingin menghapus item ini?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Tidak ada item yang tersedia.</p>
<?php endif; ?>

<a href="logout.php">
    <button type="button">Logout</button>
</a>

</body>
</html>
