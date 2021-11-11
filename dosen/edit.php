<?php include_once('../_header.php'); ?>

<div class="box">
	<h1>Dosen</h1>
	<h4>
		<small>Edit Data Dosen</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
		</div>
	</h4>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<?php
				$id =@$_GET['id'];
				$sql_dokter = mysqli_query($con, "SELECT * FROM dosen WHERE id_dosen ='$id'") or die (mysqli_error($con));
				$data = mysqli_fetch_array($sql_dokter);
			?>
			<form action="proses.php" method="post">
				<div class="form-group">
					<label for="nama">Nama Dosen</label>
					<input type="hidden" name="id" value="<?=$data['id_dosen']?>">
					<input type="text" name="nama" id="nama"  value="<?=$data['nama_dosen']?>" class="form-control" required autofocus>
				</div>
				<div class="form-group">
					<label for="jabatan">Jabatan</label>
					<input type="text" name="jabatan" id="jabatan" value="<?=$data['jabatan']?>" class="form-control" required autofocus>
				</div>
				<div class="form-group">
					<label for="pendidikan">Pendidikan</label>
					<input type="text" name="pendidikan" id="pendidikan" value="<?=$data['jabatan']?>" class="form-control" required autofocus>
				</div>
				<div class="form-group">
					<label for="telp">No. Telepon</label>
					<input type="number" name="telp" id="telp" value="<?=$data['no_telp']?>" class="form-control" required autofocus>
				</div>
				<div class="form-group">
					<input type="submit" name="edit" value="Simpan" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div 	

<?php/ 
include_once('../_footer.php')
?>