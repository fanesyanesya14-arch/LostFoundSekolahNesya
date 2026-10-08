<?php
session_start();
require __DIR__ . '/config.php';
if (!isset($_SESSION['admin_username'])) { header('Location: login.php'); exit; }

header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment; filename="rekap_lostfound_sekolah.xls"');

$result = $conn->query("SELECT id,nama_barang,lokasi,keterangan,tanggal FROM barang ORDER BY id DESC");

echo "ID\tNama Barang\tLokasi\tKeterangan\tTanggal\n";
while ($row = $result->fetch_assoc()) {
    $cells = [
        $row['id'],
        $row['nama_barang'],
        $row['lokasi'],
        $row['keterangan'],
        date('d-m-Y H:i', strtotime($row['tanggal']))
    ];
    echo implode("\t", array_map(fn($v)=>str_replace(["\t","\r","\n"], ' ', $v), $cells)) . "\n";
}
?>
