<?php
session_start();
include 'config.php';

$id = $_GET['id'];

// Hapus item dari database
$stmt = $conn->prepare("DELETE FROM items WHERE id = ?");
$stmt->execute([$id]);

header('Location: dashboard.php');
exit();
?>
