<?php
header('Content-Type: text/plain; charset=utf-8');
require __DIR__ . '/koneksi.php';

$nama = trim($_POST['nama_barang'] ?? '');
$lokasi = trim($_POST['lokasi'] ?? '');
$keterangan = trim($_POST['keterangan'] ?? '');

$raw = file_get_contents('php://input');

if (($nama === '' || $lokasi === '' || $keterangan === '') && $raw !== '') {
    parse_str($raw, $p);
    $nama = trim($p['nama_barang'] ?? $nama);
    $lokasi = trim($p['lokasi'] ?? $lokasi);
    $keterangan = trim($p['keterangan'] ?? $keterangan);
}

if (($nama === '' || $lokasi === '' || $keterangan === '') && $raw !== '') {
    $json = json_decode($raw, true);
    if (is_array($json)) {
        $nama = trim((string)($json['nama_barang'] ?? $nama));
        $lokasi = trim((string)($json['lokasi'] ?? $lokasi));
        $keterangan = trim((string)($json['keterangan'] ?? $keterangan));
    }
}

if ($nama === '' || $lokasi === '' || $keterangan === '') {
    http_response_code(400);
    exit('SAVE_FAIL');
}

$stmt = $conn->prepare(
    'INSERT INTO barang (nama_barang, lokasi, keterangan, tanggal)
     VALUES (?, ?, ?, NOW())'
);

if (!$stmt) {
    http_response_code(500);
    exit('SAVE_FAIL');
}

$stmt->bind_param('sss', $nama, $lokasi, $keterangan);

if (!$stmt->execute()) {
    $stmt->close();
    http_response_code(500);
    exit('SAVE_FAIL');
}

$stmt->close();
$conn->close();

/*
 * Penting untuk Blocks AIA kamu:
 * WebSimpan responseContent dipakai untuk membentuk URL upload_foto.php.
 * Kita sengaja mengembalikan string kosong agar URL upload menjadi tepat:
 * .../upload_foto.php
 *
 * upload_foto.php kemudian mengambil data barang terakhir (ID terbesar)
 * dan menempelkan foto ke record tersebut.
 */
echo '';
?>
