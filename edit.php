<?php 
include 'koneksi.php';
$id=$_GET['id'];
if (isset($_POST['simpan'])){
	$nama = $_POST['nama'];
	$harga = $_POST['harga'];
	$kategori = $_POST['kategori'];
	$stok = $_POST['stok'];
	$deskripsi = $_POST['deskripsi'];
    $sql="UPDATE 05_barang
    SET nama='$nama', harga=$harga, stok=$stok, kategori='$kategori', deskripsi='$deskripsi' 
    WHERE id=$id";
    mysqli_query($koneksi, $sql);
    header("location:adminpage.php?alert=success");

}
if (isset($_POST['hapus'])){
    $sql="DELETE FROM 05_barang WHERE id=$id";
    mysqli_query($koneksi, $sql);
    header("location:adminpage.php?alert=success");

}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Tambah Produk</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h2 style="text-align: center;">Kelola Produk</h2>
		<form style="display:inline" action="" method="post" enctype="multipart/form-data">
        <?php 
        $data = mysqli_query($koneksi,"SELECT * FROM 05_barang WHERE id=$id");
        while($d = mysqli_fetch_array($data)){
            ?>  
            <img style="width:200px; height: 200px;" src="gambar/<?= $d['foto']?>" alt="asdas"><br>
			<div class="form-group">
				<label>Nama :</label>
				<input value="<?= $d['nama']?>" type="text" class="form-control" placeholder="Masukkan Nama" name="nama" required="required">
			</div>
			<div class="form-group">
				<label>Harga :</label>
				<input value="<?= $d['harga']?>" type="number" class="form-control" placeholder="Masukkan Harga" name="harga" required="required">
			</div>
			<div class="form-group">
				<label>Kategori :</label> <br>
				<input required="required" type="radio" name="kategori" value="gitar"> Gitar <br>
				<input required="required" type="radio" name="kategori" value="bass"> Bass <br>
				<input required="required" type="radio" name="kategori" value="ukulele"> Ukulele
			</div>
			<div class="form-group">
				<label>Stok :</label>
				<input value="<?= $d['stok']?>" type="number" class="form-control" placeholder="0" name="stok" required="required">
			</div>
			<div class="form-group">
				<label>Deskripsi :</label>
				<textarea class="form-control" name="deskripsi" required="required"><?= $d['deskripsi']?></textarea>
			</div>	
			<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
            <?php
        }
        ?>
		</form>
        <form style="display:inline" action="" method="post">
        <input type="submit" name="hapus" value="Hapus" class="btn btn-danger">
        </form>
	</div>

</body>
</html>
