
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>testis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<script>
 let total = 0;
let keranjang = {};

function tambahPembelian(nama, harga) {
  total += harga;
  document.getElementById("total").innerText = total.toLocaleString();

  keranjang[nama] = (keranjang[nama] || 0) + 1;
  
  document.getElementById("konfir").style.display = "block";

  const formData = new FormData();
  formData.append("nama", nama);
  formData.append("harga", harga);

  fetch("koneksi.php", {
    method: "POST",
    body: formData
  }).then(response => response.text())
    .then(result => {
      if (result !== "success") {
        alert("Gagal menyimpan transaksi.");
      }
    });
}

function konfirmasiPembayaran() {
  document.getElementById("qr").style.display = "block";
  document.getElementById("sdh").style.display = "block";
  alert("Silahkan Bayar Melalui QR!");
}

function sudahBayar(){
  fetch("update_stok.php", {
    method: "POST",
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(keranjang)
  })
  .then(response => response.text())
  .then(data => {
    alert("Terimakasih Telah Belanja!!");
    location.reload();
  });
}

</script>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand">Kantin Sekolah</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#kantin">About Kantin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#cafetaria">Cafetaria List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#htb">How To Buy</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact Us</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<section id="kantin">
<h1 class="ms-5 mt-5">KANTIN SEKOLAH</h1>
<div class="ms-5 mt-5 me-5" >
<img src="Kantin.jpg" alt="Italian Trulli" width="100%" height="100%"> 
</div>

<div class="ms-5 mt-5" >
<iframe width="560" height="315" src="https://www.youtube.com/embed/2GaPSBNJNbk?si=ktP1VgjiZb8YDOL4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
    <div class="ms-5 mt-5 mb-5" >
    <pre>Kantin adalah tempat yang menyediakan makanan dan minuman, biasanya di sekolah, kantor, atau tempat umum lainnya. 
Kantin dapat menjadi tempat untuk membeli makanan dan minuman, atau bisa juga menjadi tempat untuk makan jika ada fasilitas tempat duduk</pre>
</div>
</section>
<section id ="cafetaria">
<h1 class="ms-5 mt-5 ">Cafetaria List</h1>
<div class="card mb-3 mt-5 ms-5" style="max-width: 600px;">
  <div class="row no-gutters">
    <div class="col-md-5">
      <img src="katsu.jpg" alt="katsu" class="img-fluid h-100">
    </div>
    <div class="col-md-5">
      <div class="card-body">
        <h5 class="card-title">Katsu Bu Ida</h5>
        <p class="card-text">Menjual Aneka Katsu.</p>
        <pre class="card-text">Menu Makanan:
Katsu Tiramisu
Katsu Coklat

Menu Minuman:
Esteh
Es Coklat
        </pre>
      </div>
    </div>
  </div>
</div>
<div class="card mb-5 mt-5 ms-5" style="max-width: 600px;">
  <div class="row no-gutters">
    <div class="col-md-5">
      <img src="katsu.jpg" alt="katsu" class="img-fluid h-100">
    </div>
    <div class="col-md-5">
      <div class="card-body">
        <h5 class="card-title">Bubur Pak Narji</h5>
        <p class="card-text">Menjual Aneka Bubur.</p>
        <pre class="card-text">Menu Makanan:
Bubur Ayam Bakar
Bubur Bebek Bakar

Menu Minuman:
Es Kelapa
Es Durian
        </pre>
      </div>
    </div>
  </div>
</div>
</section>

<section id="htb">
    <h1 class="ms-5 mt-5">Pembelian Menu Kantin</h1>
    <?php
    $conn = new mysqli("localhost", "root", "", "kantin");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM menu";
    $result = $conn->query($sql);

    $kategori = ["Kantin Bu Ida" => ["Katsu", "Es"], "Kantin Pak Narji" => ["Bubur", "Kelapa", "Durian"]];
    $kategoriSekarang = "";
    $kategoriTampil = [];

while ($row = $result->fetch_assoc()) {
    $nama = $row['nama'];
    $harga = $row['harga'];
    $stok = $row['stok'];

    // Cek kategori produk
    foreach ($kategori as $label => $kataKunci) {
        foreach ($kataKunci as $kata) {
            if (stripos($nama, $kata) !== false) {
                // Jika kategori belum pernah tampil, tampilkan heading
                if (!in_array($label, $kategoriTampil)) {
                    echo "<h2 class='ms-5 mt-5'>$label</h2>";
                    $kategoriTampil[] = $label;  // Tandai sudah tampil
                }
                break 2; // Keluar dari kedua foreach setelah ketemu kategori
            }
        }
    }

    echo "<div class='ms-5 mt-2'>
            <h5>$nama - Rp" . number_format($harga, 0, ',', '.') . " | Stok: $stok ";
    if ($stok > 0) {
        echo "<a class='btn btn-primary btn-sm ms-2' onclick=\"tambahPembelian('$nama', $harga)\">Beli</a>";
    } else {
        echo "<span class='badge bg-danger ms-2'>Habis</span>";
    }
    echo "</h5></div>";
}

    $conn->close();
    ?>
    <h3 class="ms-5 mt-3">Total Pembayaran: Rp<span id="total">0</span></h3>
    <div id="konfir" class="mt-3 mb-5 ms-5" style="display: none;">
        <button class="btn btn-primary" onclick="konfirmasiPembayaran()">Konfirmasi Pembayaran</button>
    </div>
</section>


<div id="qr" class="mt-3 ms-5 mb-5" style="display: none;">
  <h4>Scan QR untuk pembayaran:</h4>
  <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=Bayar+ke+Kantin+Sekolah" alt="QR Code">
</div>

<div id="sdh"class="mt-3 mb-5 ms-5" style="display: none;">
  <button class="btn btn-primary" onclick="sudahBayar()">Sudah Bayar</button>
</div>

<section id ="contact">
<h1 class="ms-5 mt-5">Contact Us</h1>
<form>
  <div class="mb-1 ms-5 mt-5 w-25">
    <label for="exampleInputEmail1" class="form-label">Nama</label>
    <input type="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
   <div class="mb-1 ms-5 w-25">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-1 ms-5 w-25">
  <label for="exampleFormControlTextarea1" class="form-label">Pesan</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
  <div class="mt-3 ms-5 mb-5">
  <button type="submit" class="btn btn-primary" onclick="alertform()">Submit</button>
</div>
</form>
</section>
<footer class="bg-primary text-white py-1 fixed-bottom text-center">
  <p class="mb-0">© copyright najwan</p>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>