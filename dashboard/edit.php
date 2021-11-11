<?php
include_once('../_header.php');
?>
  
  	<div class="row">
        <div class="col-lg-12">
        	<div class="pull-right">
            <a href="user.php" class="btn btn-warning  btn-sm"><i class="glyphicon glyphicon-chevron-left">Kembali</i></a>
        	</div>
            <h1>Edit Profil</h1>
				  <?php
				  $query = mysqli_query($con, "SELECT * FROM users WHERE username = '$_SESSION[user]'") or die (mysqli_error($con));
				  $data = mysqli_fetch_array($query)
				  ?>
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
				  		<input type="text" name="username"  class="form-control" value="<?=$data['username']?>" required>
				  		<label style="margin-top: 10px;">Password</label>
				  		<input type="password" name="password" class="form-control" required>
				  		<!-- <label style="margin-top: 10px;">Otoritas Login</label>
				  		<select class="form-control">
				  			<option><?=$data['nama_user']?></option>
				  		</select> -->
				  		<button style="float: right; margin-top: 20px; " type="submit" name="edit" class="btn btn-success btn-lg">Simpan</button>
				  	</form>
				  </div>
				</div>
			</div>
        </div>
    </div>
<?php
//proses edit user
if (isset($_POST['edit'])) {
	$username = $_POST['username'];
	$password = sha1($_POST['password']);
	$id_user = $_POST['id_user'];

mysqli_query($con, "UPDATE users SET username = '$username', password ='$password'  WHERE id_user = '$id_user'") or die(mysqli_error($con));
		echo "<script>alert('Username dan Password anda berhasil di ubah');window.location='../auth/logout.php';</script>";
}

include_once('../_footer.php');
?>