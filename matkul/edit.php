<?php include_once('../_header.php'); ?>

<div class="box">
	<h1>Matakuliah</h1>
	<h4>
		<small>Edit Data Matakuliah</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
		</div>
	</h4>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<?php
				$id =@$_GET['id'];
				$sql_matkul = mysqli_query($con, "SELECT * FROM matkul WHERE id_matkul ='$id'") or die (mysqli_error($con));
				$data = mysqli_fetch_array($sql_matkul);
			?>
			<form action="proses.php" method="post">
				<div class="form-group">
					<label for="nama">Nama Matakuliah</label>
					<input type="hidden" name="id" value="<?=$data['id_matkul']?>">
					<input type="text" name="nama" id="nama"  value="<?=$data['nama_matkul']?>" class="form-control" required autofocus>
				</div>
				<div class="form-group">
					<label for="Sks">Sks</label>
					<input type="text" name="sks" id="sks" value="<?=$data['sks']?>" class="form-control" required autofocus>
				</div>
				<div class="form-group">
					<label for="sem">Semester</label>
					<div>
						<label class="radio-inline">
							<input type="radio" name="sem" id="sem" value="Ganjil" required <?=$data['sem'] == "Ganjil" ? "checked" : null?>>Ganjil
						</label>
						<label class="radio-inline">
							<input type="radio" name="sem" id="sem" value="Genap" <?=$data['sem'] == "Genap" ? "checked" : null?>>Genap
						</label>
					</div>
				</div>
				<div class="form-group">
					<label for="prodi">Prodi</label>
                    <select class="form-control" id="prodi" name="prodi">
                    	<option>Pilih Prodi</option>
                    	<?php
                    	$kd_prodi = $data['kd_prodi'];
                    	$select = mysqli_query($con, "SElECT * FROM prodi where kd_prodi = '$kd_prodi'") or die (mysqli_error($con));
                            while($row=mysqli_fetch_array($select))
                            {?>
                            	<option <?php 
                            	if ($kd_prodi == $row['kd_prodi']) echo 'selected';?> ><?=$row['nama_prodi'] ?></option>
                            <?php }
                         ?>
                    </select>
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