<?php 
include 'koneksi.php';
if (isset($_POST['simpan'])){
	$nama = $_POST['nama'];
	$harga = $_POST['harga'];
	$kategori = $_POST['kategori'];
	$stok = $_POST['stok'];
	$deskripsi = $_POST['deskripsi'];
	
	//upload gambar
	$rand = rand();
	$ekstensi =  array('png','jpg','jpeg','gif');
	$filename = $_FILES['foto']['name'];
	$ukuran = $_FILES['foto']['size'];
	$asal=$_FILES['foto']['tmp_name'];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	
	if(!in_array($ext,$ekstensi) ) {
		header("location:adminpage.php?alert=notsupport");
	}else{
		if($ukuran < 1044070){		
			$nama_foto = $rand.'_'.$filename;
			move_uploaded_file($asal, 'gambar/'.$rand.'_'.$filename);
			$sql="INSERT INTO 05_barang (nama, harga, kategori, stok, deskripsi, foto, added_date) 
			VALUES('$nama',$harga, '$kategori', $stok, '$deskripsi','$nama_foto', current_timestamp())";
			mysqli_query($koneksi, $sql);
			echo "$sql";
			header("location:adminpage.php?alert=success");
		}else{
			header("location:adminpage.php?alert=sizeover");
		}
	}
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
		<h2 style="text-align: center;">Tambah Produk</h2>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama :</label>
				<input type="text" class="form-control" placeholder="Masukkan Nama" name="nama" required="required">
			</div>
			<div class="form-group">
				<label>Harga :</label>
				<input type="number" class="form-control" placeholder="Masukkan Harga" name="harga" required="required">
			</div>
			<div class="form-group">
				<label>Kategori :</label> <br>
				<input required="required" type="radio" name="kategori" value="gitar"> Gitar <br>
				<input required="required" type="radio" name="kategori" value="bass"> Bass <br>
				<input required="required" type="radio" name="kategori" value="ukulele"> Ukulele
			</div>
			<div class="form-group">
				<label>Stok :</label>
				<input type="number" class="form-control" placeholder="0" name="stok" required="required">
			</div>
			<div class="form-group">
				<label>Deskripsi :</label>
				<textarea class="form-control" name="deskripsi" required="required"></textarea>
			</div>
			<div class="form-group">
				<label>Foto :</label>
				<input type="file" name="foto" required="required">
				<p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg | .gif</p>
			</div>			
			<input type="submit" name="simpan" value="simpan" class="btn btn-primary">
		</form>
	</div>

</body>
</html>
