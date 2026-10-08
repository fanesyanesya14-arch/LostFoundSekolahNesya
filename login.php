<?php
header('Content-Type: text/plain; charset=utf-8');
require __DIR__ . '/koneksi.php';

$username = trim($_POST['username'] ?? $_GET['username'] ?? '');
$password = (string)($_POST['password'] ?? $_GET['password'] ?? '');

if ($username === '' || $password === '') {
    http_response_code(400);
    exit('LOGIN_FAIL');
}

$stmt = $conn->prepare(
    'SELECT password_hash FROM users WHERE username = ? LIMIT 1'
);

if (!$stmt) {
    http_response_code(500);
    exit('LOGIN_FAIL');
}

$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->bind_result($storedPassword);

$loginOK = false;

if ($stmt->fetch()) {
    // Mendukung password biasa "12345"
    // maupun password yang sudah di-hash.
    if ($password === (string)$storedPassword) {
        $loginOK = true;
    } elseif (password_verify($password, (string)$storedPassword)) {
        $loginOK = true;
    }
}

$stmt->close();
$conn->close();

if ($loginOK) {
    echo 'LOGIN_OK';
} else {
    http_response_code(401);
    echo 'LOGIN_FAIL';
}
?>
