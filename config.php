<?php
$host = 'localhost';
$dbname = 'project_db';
$user = 'root';
$pass = '';

// Membuat koneksi
$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
