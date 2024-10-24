<?php
session_start(); // Memulai session

// Menghapus semua session
session_unset(); // Menghapus semua variabel session
session_destroy(); // Menghancurkan session

// Redirect ke halaman login
header('Location: login.php');
exit();
?>
