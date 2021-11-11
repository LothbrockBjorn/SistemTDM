<?php
include_once('../_header.php');

?>
  
  	<div class="row">
        <div class="col-lg-12">
        	<div class="pull-right">
            <a href="index.php" class="btn btn-warning  btn-sm"><i class="glyphicon glyphicon-chevron-left">Kembali</i></a>
            <?php if ($_SESSION['level'] == 3) { ?>
			<a class="btn btn-success btn-sm" href="tambahuser.php" role="button"><i class="glyphicon glyphicon-plus"></i> Tambah user prodi</a>
        	<?php } ?>
        	</div>
            <h1>User Profil</h1>
				  <?php
				  $query = mysqli_query($con, "SELECT * FROM users WHERE username = '$_SESSION[user]'") or die (mysqli_error($con));
				  $data = mysqli_fetch_array($query)
				  ?>
            <!-- <p>Selamat datang <mark><?=$_SESSION['user'];?></mark> di Aplikasi sistem TMD ( Tatapmuka dosen )</p> -->
            <!-- <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a> -->
            <div class="jumbotron">
			  <h2 style=" margin-bottom: 50px;">Hello, Selamat datang</h2>
			  	<div class="row">
				  <div class="col-xs-6 col-md-3">
				      <img src="avatar.svg" style="width: 100%;">
				  </div>
				  <div class="col-xs-6 col-md-6">
				  	<h3>Otoritas : <?=$data['nama_user'];?></h3>
				  	<h3>Username : <?=$data['username'];?></h3>
				  </div>
				</div>
			  <p style="float: right;"><a class="btn btn-success btn-lg" href="edit.php" role="button">Edit profil</a></p>
			  <p style="margin-bottom: 80px;"></p>
			</div>
        </div>
    </div>
    
<?php
include_once('../_footer.php');
?>