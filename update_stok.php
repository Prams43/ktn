<?php
$conn = new mysqli("localhost", "root", "", "kantin1");
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

$data = json_decode(file_get_contents("php://input"), true);

foreach ($data as $nama => $jumlah) {
    $nama = $conn->real_escape_string($nama);
    $jumlah = (int)$jumlah;
    $sql = "UPDATE menu SET stok = stok - $jumlah WHERE nama = '$nama' AND stok >= $jumlah";
    $conn->query($sql) 
        ? file_put_contents("log_update.txt", "Update stok berhasil untuk $nama, jumlah: $jumlah\n", FILE_APPEND)
        : file_put_contents("log_update.txt", "Error update stok untuk $nama: " . $conn->error . "\n", FILE_APPEND);
}

echo "Stok berhasil diperbarui.";
?>
