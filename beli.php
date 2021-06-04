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

    <div class="container"><br><br><br>
      <?php 
      $id=$_GET['id'];
			$data = mysqli_query($koneksi,"select * from 05_barang WHERE id=$id");
			while($d = mysqli_fetch_array($data)){
				?>
        <div class="container"><h1><b>Beli Produk</b></h1></div>
        <br>
      <div class="container">
				<div class="media">
        <div class="shadow p-3 mb-5 bg-white rounded">
  <img src="gambar/<?= $d['foto']; ?>" style="width: 300px; height: 300px;" class="align-self-start mr-3" alt="...">
        </div>
  <div class="media-body" style="margin:20px;">
    <h2 class="mt-0"><b><?= $d['nama']; ?></b></h2>
    <h4>Kategori : 
    <a href="kategori.php?kategori=<?= $d['kategori']; ?>">
    <?= $d['kategori']; ?></h4>
    </a>
    <h4>Stok : <?= $d['stok']; ?></h4>
    <h4>Harga : Rp.<?= $d['harga']; ?></h4>
    <h4>Deskripsi :</h4>
    <h5><?= $d['deskripsi']; ?></h5>
  </div>
  
</div>
        <?php
			}
if(isset($_POST['beli'])){
    $namapro=$_POST['namapro'];
    $_SESSION["product_name"]=$namapro;
    $kuantitas=$_POST['kuantitas'];
    $_SESSION['qu']=$kuantitas;
    $harga=$_POST['hargapro']*$_POST['kuantitas'];
    $_SESSION['price']=$harga;
    $kurir=$_POST['kurir'];
    $_SESSION['ongkir']=$kurir;
    $total=$harga+$kurir;
    $_SESSION['total']=$harga+$kurir;
    $penerima=$_POST['nama_penerima'];
    $alamat=$_POST['alamat'];
    $detailtrans="<h2>Alamat</h2>
    <h4>Nama Penerima :</h4>
    <h4><b>$penerima</b></h4>
    <h4>Alamat lengkap :</h4>
    <h4><b>$alamat</b></h4>";
    $detail= "<h2 class='mt-0'><b> $namapro</b></h2>
    <h4>Nama Produk :  $namapro</h4>
    <h4>Kuantitas : $kuantitas</h4>
    <h4>Harga : Rp. $harga</h4>
    <h4>Ongkir : Rp. $kurir</h4>
    <h4>Total : Rp. $total</h4>";
    $id=$_GET['id'];
    $data = mysqli_query($koneksi,"select * from 05_barang WHERE id=$id");
    while($d = mysqli_fetch_array($data)){
    if($kuantitas==$d['stok']){
      $ubah="UPDATE 05_barang SET stok=0 WHERE id=$id;";
      mysqli_query($koneksi, $ubah);
    }else{
      $minus=$d['stok']-$kuantitas;
      $ubah="UPDATE 05_barang SET stok=$minus WHERE id=$id;";
      mysqli_query($koneksi, $ubah);
    }
  }
  $detailtrans=base64_encode($detailtrans);
  $detail=base64_encode($detail);
  $email_user=$_SESSION["email"];
  $sql="INSERT INTO `05_pesanan` ( `email_user`, `detail_barang`, `detail_transaksi`,`order_date`) VALUES ('$email_user', '$detail', '$detailtrans',current_timestamp())";
  mysqli_query($koneksi, $sql);
	header("Location: pesanan.php?email=$email_user");
}

			?>
      </div>
  <?php
  $id=$_GET['id'];
  $data = mysqli_query($koneksi,"select * from 05_barang WHERE id=$id");
  while($d = mysqli_fetch_array($data)){
  ?>
      <div class="container">
      <form action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
                <input type="hidden" value="<?= $d['nama']; ?>" name="namapro">
                <input type="hidden" name="kuantitas">
                <input type="hidden" value=<?= $d['harga']; ?> name="hargapro">
                <input type="hidden" name="ongkir">
                <input type="hidden" name="total">
                
				<label>Nama Penerima:</label>
				<input type="text" class="form-control" placeholder="Masukan Nama " name="nama_penerima" required="required">
			</div>
			<div class="form-group">
				<label>Kuantitas :</label>
				<input type="number" class="form-control" placeholder="0" name="kuantitas" min="1" max="<?= $d['stok']; ?>" required="required">
			</div>
            <div class="form-group">
				<label>Pengiriman :</label> <br>
				<input required="required" type="radio" name="kurir" value=10000> JNE Express (Rp.10000) <br>
				<input required="required" type="radio" name="kurir" value=20000> JNT Express (Rp.20000) <br>
				<input required="required" type="radio" name="kurir" value=30000> JNX Express (Rp.30000)
			</div>
			<div class="form-group">
				<label>Alamat :</label>
				<textarea class="form-control" name="alamat" required="required"></textarea>
			</div>	
			<input type="submit" name="beli" value="Check Out" class="btn btn-primary">
		</form>
        <?php
                }
                ?>
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