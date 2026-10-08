<?php
$host = '127.0.0.1';
$user = 'root';
$pass = '';
$db   = 'db_lostfound_sekolah';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_errno) {
    die('Koneksi database gagal: ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');

function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
