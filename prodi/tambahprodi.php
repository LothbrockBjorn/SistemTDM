
<?php
include_once('../_header.php');
    if ($_SESSION['level'] != 3 ){
    	echo "<script>window.location='../dashboard/index.php'</script>";
    }
?>
  
  	<div class="row">
        <div class="col-lg-12">
        	<div class="pull-right">
            <a href="../dashboard/index.php" class="btn btn-warning  btn-sm"><i class="glyphicon glyphicon-chevron-left">Kembali</i></a>
        	</div>
            <h1>Tambah prodi</h1>
            <!-- <p>Selamat datang <mark><?=$_SESSION['user'];?></mark> di Aplikasi sistem TMD ( Tatapmuka dosen )</p> -->
            <!-- <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a> -->
            <div class="jumbotron">
			  	<div class="row">
				  <div class="col-xs-6 col-md-3">
				      <img src="avatar.svg" style="width: 100%;">
				  </div>
				  <div class="col-xs-8 col-md-6">
				  	<form action="" method="post">
				  		<label>Kode Podi</label>
				  		<input type="text" name="kd_prodi"  class="form-control" required>
				  		<label style="margin-top: 10px;">Nama Prodi</label>
				  		<input type="texxt" name="nama_prodi" class="form-control" required>
				  		<label style="margin-top: 10px;">Level Prodi</label>
				  		<input type="number" name="lvl_prodi" class="form-control" placeholder="Masukan prodi ke berapa">
				  		<button style="float: right; margin-top: 20px; " type="submit" name="add" class="btn btn-success btn-lg">Simpan Data</button>
				  	</form>
				  </div>
				</div>
			</div>
        </div>
    </div>
<?php
//proses tambah user
if (isset($_POST['add'])) {


	$lvl_prodi = $_POST['lvl_prodi'];

	$query=mysqli_query($con, "SELECT * FROM prodi WHERE lvl_prodi = '$lvl_prodi'") or die(mysqli_error($con));
	$cek = mysqli_num_rows($query);
	if ($cek > 0) {
		echo "<script>alert('Level prodi sudah ada, masukan angka lain');history.back();</script>";
	}else{
	$nama_prodi = $_POST['nama_prodi'];
	$kd_prodi = $_POST['kd_prodi'];

	mysqli_query($con, "INSERT INTO prodi (kd_prodi, nama_prodi, lvl_prodi) VALUES ('$kd_prodi','$nama_prodi','$lvl_prodi')")or die(mysqli_error($con));
		echo "<script>alert('Data prodi baru berhasil di tambahkan');window.location='../dashboard/index.php';</script>";
}
}

include_once('../_footer.php');
?>