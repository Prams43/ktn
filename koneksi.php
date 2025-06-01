<?php
$koneksi = new mysqli("localhost", "root", "", "kantin");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$nama = $_POST['nama'];
$harga = $_POST['harga'];

if (!empty($nama) && !empty($harga)) {
    $stmt = $koneksi->prepare("INSERT INTO transaksi (nama, harga) VALUES (?, ?)");
    $stmt->bind_param("si", $nama, $harga);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "gagal";
    }
    $stmt->close();
} else {
    echo "data tidak lengkap";
}

$koneksi->close();
?>
