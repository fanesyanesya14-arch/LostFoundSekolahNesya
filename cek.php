<?php
header('Content-Type: text/plain; charset=utf-8');
require __DIR__.'/koneksi.php';
$r=$conn->query('SELECT COUNT(*) AS jumlah FROM barang');
if(!$r){http_response_code(500);exit('QUERY_ERROR');}
$row=$r->fetch_assoc();
echo "KONEKSI_OK
DATABASE=db_lostfound_sekolah
TABEL=barang
JUMLAH_DATA=".(int)$row['jumlah'];
$conn->close();
?>