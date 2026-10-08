<?php
header('Content-Type: application/json; charset=utf-8');
require __DIR__.'/koneksi.php';

$result=$conn->query('SELECT id,nama_barang,lokasi,keterangan,foto,tanggal FROM barang ORDER BY id DESC');

if(!$result){
    http_response_code(500);
    echo json_encode(['error'=>'DATA_FAIL'],JSON_UNESCAPED_UNICODE);
    exit;
}

$data=[];
while($row=$result->fetch_assoc()){
    $tanggal='';
    if(!empty($row['tanggal'])){
        $ts=strtotime($row['tanggal']);
        if($ts!==false)$tanggal=date('d-m-Y H:i',$ts);
    }
    $data[]='ID '.$row['id'].' | Nama: '.trim($row['nama_barang']).
            ' | Lokasi: '.trim($row['lokasi']).
            ' | Keterangan: '.trim($row['keterangan']??'').
            ' | Tanggal: '.$tanggal;
}

echo json_encode($data,JSON_UNESCAPED_UNICODE);
$conn->close();
?>