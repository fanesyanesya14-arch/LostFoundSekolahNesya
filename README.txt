PHP BACKEND - SESUAI BLOCKS AIA

Database: db_lostfound_sekolah
Folder aktif: C:\xampp\htdocs\lost_found_api\
IP contoh: 192.168.1.230

Tidak perlu mengubah Blocks.

login.php:
- menerima GET dan POST
- sukses -> LOGIN_OK

simpan.php:
- menerima POST form body dari App Inventor
- sukses -> mengembalikan ID angka saja

upload_foto.php:
- menerima id + file
- sukses -> UPLOAD_OK

tampil.php:
- mengembalikan JSON array
- cocok dengan Web1.JsonTextDecode -> ListView1.Elements

Tes:
http://localhost/lost_found_api/cek.php
http://localhost/lost_found_api/tampil.php
http://localhost/lost_found_api/login.php?username=admin&password=12345
