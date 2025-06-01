<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
    <nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Kantin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#kantin">About Kantin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#list ">Cafetaria List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">How to Buy</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="#contact ">Contact Us</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<section id="kantin" class="mt-5 ms-5 me-5">
  <h1>KANTIN TELKOM</h1>
  <img src="gmbrkntin.jpg" width="80%" height="80%" style="display: absolute">
</section>
<div>
<img src="logokntin.png" width="30%" height="50%" style="display: absolute; top: 500px">
</div>

<div>
<pre class="ms-5 mx-5"style="left: 600px;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
Provident asperiores rem soluta odit error, 
consequatur corporis temporibus repudiandae odio ut nobis dignissimos sequi facere eligendi libero reiciendis iusto iste voluptatibus.
<pre>
</div>
<iframe class="ms-5 mx-5"width="560" height="315" src="https://www.youtube.com/embed/SHP-xh5NnVs?si=FFZZmIYH9tEqPQb5" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
<section class="ms-5 mx-5 mt-5"id="list">
  <h1>Cafetaria List</h1>
  <div class="card mb-3 mt-3" style="max-width: 1000px;">
  <div class="row no-gutters">
    <div class="col-md-3">
      <img src="kantin1.jpg" alt="...">
    </div>
    <div class="col-md-7">
      <div class="card-body">
        <h5 class="card-title">Pak Rusdi</h5>
        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        <p class="card-text"><small class="text-muted">Seger Banget Coy!</small></p>
      </div>
    </div>
  </div>
</div>
<div class="card mb-3 mt-3" style="max-width: 1000px;">
  <div class="row no-gutters">
    <div class="col-md-3">
      <img src="kantin1.jpg" alt="...">
    </div>
    <div class="col-md-7">
      <div class="card-body">
        <h5 class="card-title">Bu Dwi</h5>
        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        <p class="card-text"><small class="text-muted">Ayo Dibeli!</small></p>
      </div>
    </div>
  </div>
</div>
<h2 class="mt-5">Menu Pak Rusdi</h2>

<div class="row">

<div class="col">
     <div class="card" style="width: 18rem;">
  <img src="katsu1.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Katsu Sigma</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>
</div>

    <div class="col">
       <div class="card" style="width: 18rem;">
  <img src="katsu2.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Katsu Bakar</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>
</div>

<div class="col">
       <div class="card" style="width: 14rem;">
  <img src="escoklat.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Es Coklat</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>
</div>

    <div class="col">
       <div class="card" style="width: 18rem;">
  <img src="esteh.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Esteh</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
    </div>
</div>
</div>

<h2 class="mt-5">Menu Bu Dwi</h2>

<div class="row">

<div class="col">
     <div class="card" style="width: 18rem;">
  <img src="katsu1.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Ayam Goyeng Sigma</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>
</div>

    <div class="col">
       <div class="card" style="width: 18rem;">
  <img src="katsu2.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Sushi Patih</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>
</div>

<div class="col">
       <div class="card" style="width: 14rem;">
  <img src="escoklat.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Teh Botol</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>
</div>

    <div class="col">
       <div class="card" style="width: 18rem;">
  <img src="esteh.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Teh Segitiga</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
    </div>
</div>
</div>
</section>

<section id="htb">
    <h1 class="ms-5 mt-5">Pembelian Menu Kantin</h1>
    <?php
    $conn = new mysqli("localhost", "root", "", "kantin1");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM menu";
    $result = $conn->query($sql);

    $kategori = ["Kantin Pak Rusdi" => ["Katsu", "Es"], "Kantin Bu Dwi" => ["", "",]];
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
<br>
<br>
<br>
<section class="ms-5 mx-5"id="contact">
  <form>
  <div class="form-group w-50">
    <label for="exampleInputEmail1">Nama</label>
    <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    
  </div>
  <div class="form-group w-50">
    <label for="exampleInputPassword1">Email</label>
    <input type="Email" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 w-50">
  <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
  <button class="mt-4"class="btn btn-primary" onclick="sigmaAlert()">Submit</button>
</form>
<script>
  function sigmaAlert(){
    alert("Terimakasih!");
  }
</script>
</section>
<br>
<br>
<br>
<footer class="fixed-bottom bg-primary text-center ">
  <p>aku sigma</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
