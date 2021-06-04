<?php include 'koneksi.php';
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Petik Musik</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body class="mt-4">
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary">
      <div class="container">
      <a class="navbar-brand" href="index.php"><img src="img/pick.png" width="35px"></a>
      <a class="navbar-brand" href="index.php">Petik Musik</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
        <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Kategori
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  <a href="kategori.php?kategori=<?= 'gitar' ?>">
    <button class="dropdown-item">Gitar</button>
  </a>
  <a href="kategori.php?kategori=<?='bass'?>">
    <button class="dropdown-item">Bass</button>
  </a>
  <a href="kategori.php?kategori=<?='ukulele'?>">
    <button class="dropdown-item">Ukulele</button>
  </a>
  </div>
</div>
        </ul>
      <span style="width: 270px;"></span>
      <form action="cari.php?keyword=<?='keyword'?>" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" name="keyword" placeholder="Search" aria-label="Search">
      <button class="btn btn-info my-2 my-sm-0" type="submit">Search</button><span style="width: 10px;"></span>
    </form>
    <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img style="width: 35px; height: 35px; border-radius: 50%;" src="img/profile.png" alt="Cinque Terre">
    <?=$_SESSION["nama_user"]?>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="pesanan.php">Pesanan saya</a>
  </div>
</div></span>
        <a style="position:absolute; right:20px; color:white;" href="logout.php">Log Out</a>
      </div>
      </div>
    </nav>

    <div class="jumbotron jumbotron-fluid">
      <div class="container text-center">
        <img src="img/logo.png" width="25%" class="rounded-circle">
        <h1 class="display-4">Petik Musik</h1>
        <p class="lead">Selamat Datang di Petik Musik Website.</p>
      </div>
    </div>
  
    <div class="container">
      <div class="row mb-4">
        <div class="col text-center">
          <h2>Kategori : <?=$_GET['kategori']?></h2>
        </div>
      </div>
      <div class="row">
      <?php 
      $kategori=$_GET['kategori'];
			$data = mysqli_query($koneksi,"SELECT * FROM 05_barang WHERE kategori='$kategori' AND stok !=0");
			while($d = mysqli_fetch_array($data)){
				?>
        <div class="col">
          <div class="card" style="width: 320px; height: 420px;">
            <a href="view.php?id=<?= $d['id']; ?>">
            <center>
            <div style="width: 300px; height: 300px;" >
            <img style="width: 300px; height: 300px;"  class="card-img-top" src="gambar/<?= $d['foto']; ?>" alt="gambar artikel">
            </div>
            <div class="card-body">
              <p class="card-text" style="color:black"><?= $d['nama']; ?></p>
            </div>
            <a href="beli.php?id=<?= $d['id']; ?>">
            <button type="button" class="btn btn-primary">Beli</button></a>
            <P style="display:inline-block;"> Rp<?= $d['harga']; ?></P>
            </center>
          </a>
          </div>
        </div>
        <?php
			}
			?>
      </div>
  
      <div class="container">
        <div class="mt-4 row">
        </div>
      </div>
      </div>

      <div class="bg-dark text-white">
        <center>Petik Musik 2021 &copy;</center>
      </div>
 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>