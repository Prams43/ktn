<?php
$data = json_decode(file_get_contents("php://input"), true);
$nama = $data['nama'];
$harga = $data['harga'];
?>
