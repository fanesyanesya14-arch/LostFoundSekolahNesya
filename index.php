<?php
session_start();
require __DIR__ . '/config.php';
if (!isset($_SESSION['admin_username'])) {
    header('Location: login.php');
    exit;
}

$q = trim($_GET['q'] ?? '');

if ($q !== '') {
    $like = '%' . $q . '%';
    $stmt = $conn->prepare(
        "SELECT id,nama_barang,lokasi,keterangan,foto,tanggal
         FROM barang
         WHERE nama_barang LIKE ? OR lokasi LIKE ? OR keterangan LIKE ?
         ORDER BY id DESC"
    );
    $stmt->bind_param('sss', $like, $like, $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query(
        "SELECT id,nama_barang,lokasi,keterangan,foto,tanggal
         FROM barang ORDER BY id DESC"
    );
}

$countResult = $conn->query("SELECT COUNT(*) AS total FROM barang");
$total = (int)$countResult->fetch_assoc()['total'];
$todayResult = $conn->query("SELECT COUNT(*) AS total FROM barang WHERE DATE(tanggal)=CURDATE()");
$today = (int)$todayResult->fetch_assoc()['total'];
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Dashboard Admin - LostFoundSekolah</title>
<style>
*{box-sizing:border-box}body{margin:0;font-family:Arial,sans-serif;background:#f4f7fb;color:#182230}
.top{background:#102a43;color:#fff;padding:18px 24px;display:flex;justify-content:space-between;align-items:center;gap:15px}
.top h1{margin:0;font-size:22px}.wrap{max-width:1200px;margin:25px auto;padding:0 18px}
.cards{display:grid;grid-template-columns:repeat(2,1fr);gap:15px;margin-bottom:20px}.card{background:#fff;padding:20px;border-radius:16px;box-shadow:0 8px 26px rgba(16,42,67,.07)}
.num{font-size:30px;font-weight:800;color:#1769aa}.lbl{color:#667085;margin-top:4px}
.actions{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:15px}a.btn,button{padding:10px 14px;border-radius:9px;border:0;background:#1769aa;color:#fff;text-decoration:none;cursor:pointer}
a.out{background:#667085}
form.search{display:flex;gap:8px;margin-bottom:15px}.search input{flex:1;padding:11px;border:1px solid #d0d5dd;border-radius:9px}
.tablebox{background:#fff;border-radius:16px;overflow:auto;box-shadow:0 8px 26px rgba(16,42,67,.07)}
table{border-collapse:collapse;width:100%;min-width:900px}th,td{padding:12px;border-bottom:1px solid #eaecf0;text-align:left;vertical-align:top}th{background:#f8fafc}
.photo{width:70px;height:70px;object-fit:cover;border-radius:10px;background:#eef2f6}
.muted{color:#667085;font-size:13px}
@media(max-width:700px){.cards{grid-template-columns:1fr}.top{align-items:flex-start;flex-direction:column}}
</style>
</head>
<body>
<div class="top">
<h1>LostFoundSekolah — Web Admin</h1>
<a class="btn out" href="logout.php">Logout</a>
</div>
<div class="wrap">
<div class="cards">
<div class="card"><div class="num"><?= $total ?></div><div class="lbl">Total Barang</div></div>
<div class="card"><div class="num"><?= $today ?></div><div class="lbl">Input Hari Ini</div></div>
</div>

<div class="actions">
<a class="btn" href="index.php">Refresh</a>
<a class="btn" href="print.php">Cetak Rekap</a>
<a class="btn" href="export_excel.php">Export Excel</a>
</div>

<form class="search" method="get">
<input name="q" value="<?= e($q) ?>" placeholder="Cari nama barang, lokasi, atau keterangan...">
<button type="submit">Cari</button>
</form>

<div class="tablebox">
<table>
<thead><tr>
<th>ID</th><th>Foto</th><th>Nama Barang</th><th>Lokasi</th><th>Keterangan</th><th>Tanggal</th>
</tr></thead>
<tbody>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
<td><?= (int)$row['id'] ?></td>
<td>
<?php if (!empty($row['foto'])): ?>
<img class="photo" src="../lost_found_api/uploads/<?= e($row['foto']) ?>" alt="foto">
<?php else: ?><span class="muted">Tidak ada foto</span><?php endif; ?>
</td>
<td><strong><?= e($row['nama_barang']) ?></strong></td>
<td><?= e($row['lokasi']) ?></td>
<td><?= nl2br(e($row['keterangan'] ?? '')) ?></td>
<td><?= e(date('d-m-Y H:i', strtotime($row['tanggal']))) ?></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>
</body>
</html>
