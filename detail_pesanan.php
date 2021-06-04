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

    <div class="container">
      <div class="row mb-4">
        <div class="col text-center">
          <h2>Articles</h2>
        </div>
      </div>
        <div class="container"><h1><b>Detail Pesanan</b></h1></div>
        <br>
      <div class="container">
				<div class="media">
  <div class="media-body" style="margin:20px;">
  <?php
require_once "koneksi.php";
      $email=$_SESSION["email"];
      $pid=$_GET['id'];
      $data = mysqli_query($koneksi,"SELECT 05_pesanan.* FROM 05_pesanan, 05_users WHERE 05_pesanan.email_user=05_users.email AND 05_users.email='$email' AND 05_pesanan.id=$pid");
      while($d = mysqli_fetch_array($data)){
          $id=$d['id'];
          $date=$d['order_date'];
          $datex=(date_parse($date));                        
          $monthNum  = $datex["month"];
          $dateObj   = DateTime::createFromFormat('!m', $monthNum);
          $monthName = $dateObj->format('F'); // March
          $decode=$d['detail_barang'];
              $decode=base64_decode($decode);
              echo "
              $decode
              <h4>Dibuat pada tanggal : $datex[day] $monthName $datex[year]</h4>
              
              ";  ?> 
                 
  </div>  
</div>
      </div>
  
      <div class="container">
        <div style="margin: 20px;">
  <?php echo base64_decode($d['detail_transaksi']); } ?>
        
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