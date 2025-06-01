<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "kantin";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

foreach ($data as $nama => $jumlah) {
  // Kurangi stok
  $stmt = $conn->prepare("UPDATE menu SET stok = stok - ? WHERE nama = ? AND stok >= ?");
  $stmt->bind_param("isi", $jumlah, $nama, $jumlah);
  $stmt->execute();
}

echo "stok terupdate";

$conn->close();
?>
