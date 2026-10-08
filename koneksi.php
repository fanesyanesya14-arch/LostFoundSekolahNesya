<?php
header('Content-Type: text/plain; charset=utf-8');
$host='127.0.0.1';
$user='root';
$pass='';
$db='db_lostfound_sekolah';
$conn=new mysqli($host,$user,$pass,$db);
if($conn->connect_errno){http_response_code(500);exit('DB_ERROR');}
$conn->set_charset('utf8mb4');
?>