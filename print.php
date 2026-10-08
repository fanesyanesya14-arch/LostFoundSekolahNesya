<?php
session_start();
require __DIR__ . '/config.php';
if (!isset($_SESSION['admin_username'])) { header('Location: login.php'); exit; }
$result = $conn->query("SELECT id,nama_barang,lokasi,keterangan,tanggal FROM barang ORDER BY id DESC");
?>
<!doctype html>
<html lang="id"><head><meta charset="utf-8"><title>Cetak Rekap LostFoundSekolah</title>
<style>
body{font-family:Arial,sans-serif;color:#111}h2{text-align:center}p{text-align:center;color:#555}
table{border-collapse:collapse;width:100%}th,td{border:1px solid #777;padding:8px;text-align:left}th{background:#eee}
@media print{.noprint{display:none}}
</style></head><body>
<div class="noprint"><button onclick="window.print()">Cetak</button></div>
<h2>REKAPITULASI LOST FOUND SEKOLAH</h2>
<p>Database: db_lostfound_sekolah</p>
<table><thead><tr><th>ID</th><th>Nama Barang</th><th>Lokasi</th><th>Keterangan</th><th>Tanggal</th></tr></thead>
<tbody>
<?php while($row=$result->fetch_assoc()): ?><tr>
<td><?= (int)$row['id'] ?></td>
<td><?= e($row['nama_barang']) ?></td>
<td><?= e($row['lokasi']) ?></td>
<td><?= e($row['keterangan'] ?? '') ?></td>
<td><?= e(date('d-m-Y H:i', strtotime($row['tanggal']))) ?></td>
</tr><?php endwhile; ?>
</tbody></table>
</body></html>
