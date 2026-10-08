<?php
session_start();
require __DIR__ . '/config.php';

if (isset($_SESSION['admin_username'])) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare('SELECT username, password_hash FROM users WHERE username = ? LIMIT 1');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($dbUsername, $dbPassword);

    if ($stmt->fetch() && hash_equals((string)$dbPassword, (string)$password)) {
        $_SESSION['admin_username'] = $dbUsername;
        header('Location: index.php');
        exit;
    }

    $error = 'Username atau password salah.';
    $stmt->close();
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Login Admin - LostFoundSekolah</title>
<style>
*{box-sizing:border-box}body{margin:0;font-family:Arial,sans-serif;background:#eef3f8;display:grid;place-items:center;min-height:100vh}
.card{width:min(420px,92vw);background:#fff;border-radius:20px;padding:32px;box-shadow:0 18px 45px rgba(15,32,57,.12)}
h1{margin:0 0 8px;color:#102a43}.sub{margin:0 0 24px;color:#667085}
label{display:block;margin:14px 0 7px;font-weight:700;color:#344054}input{width:100%;padding:13px 14px;border:1px solid #d0d5dd;border-radius:10px;font-size:15px}
button{width:100%;margin-top:20px;padding:13px;border:0;border-radius:10px;background:#1769aa;color:white;font-weight:700;font-size:15px;cursor:pointer}
.err{background:#fef3f2;color:#b42318;padding:11px 12px;border-radius:10px;margin-bottom:14px}.demo{margin-top:18px;font-size:13px;color:#667085}
</style>
</head>
<body>
<div class="card">
<h1>LostFoundSekolah</h1>
<p class="sub">Web Admin</p>
<?php if ($error): ?><div class="err"><?= e($error) ?></div><?php endif; ?>
<form method="post">
<label>Username</label>
<input name="username" required>
<label>Password</label>
<input type="password" name="password" required>
<button type="submit">Masuk</button>
</form>
<div class="demo">Akun demo: admin / 12345</div>
</div>
</body>
</html>
