<?php
header('Content-Type: text/plain; charset=utf-8');
require __DIR__ . '/koneksi.php';

/*
 * MIT App Inventor Web.PostFile mengirim file sebagai request body langsung,
 * bukan multipart/form-data. Karena itu file dibaca dari php://input.
 */

$result = $conn->query(
    'SELECT id FROM barang ORDER BY id DESC LIMIT 1'
);

if (!$result) {
    http_response_code(500);
    exit('UPLOAD_FAIL');
}

$row = $result->fetch_assoc();
$id = (int)($row['id'] ?? 0);

if ($id <= 0) {
    http_response_code(400);
    exit('UPLOAD_FAIL');
}

$binary = file_get_contents('php://input');

if ($binary === false || strlen($binary) === 0) {
    http_response_code(400);
    exit('UPLOAD_FAIL');
}

/*
 * Ambil nama file dari header jika tersedia.
 * Kalau tidak ada, gunakan nama standar.
 */
$headers = function_exists('getallheaders') ? getallheaders() : [];
$originalName = '';

foreach ($headers as $key => $value) {
    if (strtolower($key) === 'filename') {
        $originalName = basename(trim($value));
        break;
    }
}

$ext = 'jpg';
$lower = strtolower($originalName);

if (str_ends_with($lower, '.png')) {
    $ext = 'png';
} elseif (str_ends_with($lower, '.webp')) {
    $ext = 'webp';
} elseif (str_ends_with($lower, '.jpeg')) {
    $ext = 'jpg';
}

$dir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads';

if (!is_dir($dir) && !mkdir($dir, 0775, true)) {
    http_response_code(500);
    exit('UPLOAD_FAIL');
}

$filename = 'barang_' . $id . '_' . time() . '.' . $ext;
$destination = $dir . DIRECTORY_SEPARATOR . $filename;

if (file_put_contents($destination, $binary) === false) {
    http_response_code(500);
    exit('UPLOAD_FAIL');
}

/* Pastikan data benar-benar gambar bila memungkinkan. */
$imageInfo = @getimagesize($destination);

if ($imageInfo === false) {
    @unlink($destination);
    http_response_code(400);
    exit('UPLOAD_FAIL');
}

$stmt = $conn->prepare(
    'UPDATE barang SET foto = ? WHERE id = ?'
);

if (!$stmt) {
    @unlink($destination);
    http_response_code(500);
    exit('UPLOAD_FAIL');
}

$stmt->bind_param('si', $filename, $id);

if (!$stmt->execute()) {
    @unlink($destination);
    $stmt->close();
    $conn->close();
    http_response_code(500);
    exit('UPLOAD_FAIL');
}

$stmt->close();
$conn->close();

echo 'UPLOAD_OK';
?>
