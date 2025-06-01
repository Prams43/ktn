<?php
$conn = new mysqli("localhost", "root", "", "kantin");
$conn->query("INSERT INTO transaksi (nama, harga) VALUES ('{$_POST['nama']}', {$_POST['harga']})")
    ? print("success") : print("gagal");
$conn->close();
?>
