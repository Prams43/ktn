<?php
$conn = new mysqli("localhost", "root", "", "kantin1");
$data = json_decode(file_get_contents("php://input"), true);
foreach ($data as $nama => $jumlah) {
    $conn->query("UPDATE menu SET stok = stok - $jumlah WHERE nama = '$nama' AND stok >= $jumlah");
}
echo "stok terupdate";
$conn->close();
?>
