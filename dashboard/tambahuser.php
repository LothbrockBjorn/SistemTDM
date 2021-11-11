<?php
include_once('../_header.php');
if ($_SESSION['level'] != 3 ){
    	echo "<script>window.location='../dashboard/index.php'</script>";
    }
?>
  
  	<div class="row">
        <div class="col-lg-12">
        	<div class="pull-right">
            <a href="user.php" class="btn btn-warning  btn-sm"><i class="glyphicon glyphicon-chevron-left">Kembali</i></a>
        	</div>
            <h1>Tambah User prodi</h1>
            <!-- <p>Selamat datang <mark><?=$_SESSION['user'];?></mark> di Aplikasi sistem TMD ( Tatapmuka dosen )</p> -->
            <!-- <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a> -->
            <div class="jumbotron">
			  	<div class="row">
				  <div class="col-xs-6 col-md-3">
				      <img src="avatar.svg" style="width: 100%;">
				  </div>
				  <div class="col-xs-8 col-md-6">
				  	<form action="" method="post">
				  		<input type="hidden" name="id_user" value="<?=$data['id_user']?>">
				  		<label>Username</label>
				  		<input type="text" name="username"  class="form-control" required>
				  		<label style="margin-top: 10px;">Password</label>
				  		<input type="password" name="password" class="form-control" required>
				  		<label style="margin-top: 10px;">Prodi</label>
				  		<select class="form-control" name="nama_user" required>
				  			<option>Pilih prodi</option>
				  			<?php
				  $query = mysqli_query($con, "SELECT * FROM prodi") or die (mysqli_error($con));
				  while ( $data = mysqli_fetch_array($query)) {
				  			echo"<option>".$data['nama_prodi'].	"</option>";
				  }
				  ?>
				  		</select>
				  		<button style="float: right; margin-top: 20px; " type="submit" name="tambah" class="btn btn-success btn-lg">Simpan Data</button>
				  	</form>
				  </div>
				</div>
			</div>
        </div>
    </div>
<?php
require "../assets/libs/vendor/autoload.php";

	use Ramsey\Uuid\Uuid;
	use Ramsey\Uuid\Exception\UnstatisfiedDependencyException;
//proses tambah user
if (isset($_POST['tambah'])) {

	
	$uuid = Uuid::uuid4()->toString();
	$nama_user = $_POST['nama_user'];
	$username = $_POST['username'];
	$password = sha1($_POST['password']);

	$query_cek = mysqli_query($con, "SELECT * FROM users WHERE nama_user = '$nama_user'") or die (mysqli_error($con));
	$data_cek = mysqli_num_rows($query_cek);
	if ($data_cek > 0) {
		echo "<script>alert('Data user prodi ini sudah ada');history.back();</script>";
	}else{
	$query = mysqli_query($con, "SELECT * FROM prodi WHERE nama_prodi = '$nama_user'") or die (mysqli_error($con));
	$datalvl = mysqli_fetch_array($query);
	$lvl_prodi = $datalvl['lvl_prodi'];
	$level = 2;

	mysqli_query($con, "INSERT INTO users (id_user, nama_user, username, password, level, lvl_prodi) VALUES ('$uuid','$nama_user','$username','$password','$level','$lvl_prodi')")or die(mysqli_error($con));
		echo "<script>alert('Data user baru berhasil ditambahkan');window.location='tambahuser.php';</script>";
}
}

include_once('../_footer.php');
?>