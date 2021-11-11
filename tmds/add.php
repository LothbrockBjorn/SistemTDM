<?php include_once('../_header.php'); ?>

<div class="box">
	<h1>Rekam tatap muka</h1>
	<h4>
		<small>Tambah Data Rekam tatap muka</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
		</div>
	</h4>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<form action="proses.php" method="post">
				<div class="form-group">
					<label for="matkul">Matakuliah</label>
					<select name="matkul" id="matkul" class="form-control" required>
						<option value="">- Pilih -</option>
						<!-- membuat seleksi matkul per prodi session otoritas user -->
						<?php
						if (isset($_SESSION['lvl_prodi']) != '') {
						$lvl_prodi=$_SESSION['lvl_prodi'];
						$sqlsesi= mysqli_query($con, "SELECT * FROM prodi WHERE lvl_prodi = '$lvl_prodi'");
						$datasesi= mysqli_fetch_array($sqlsesi);
						$kd_prodi= $datasesi['kd_prodi'];
						$sql = mysqli_query($con, "SELECT * FROM pengampu_matkul JOIN matkul ON pengampu_matkul.id_matkul = matkul.id_matkul JOIN ta ON pengampu_matkul.id_ta = ta.id_ta WHERE kd_prodi = '$kd_prodi' AND ta.status ='Aktif'") or die (mysqli_error($con));
					}else{
						$sql = mysqli_query($con, "SELECT * FROM pengampu_matkul JOIN matkul ON pengampu_matkul.id_matkul = matkul.id_matkul JOIN ta ON pengampu_matkul.id_ta = ta.id_ta WHERE ta.status ='Aktif'") or die (mysqli_error($con));
					}	
						while ($data_matkul = mysqli_fetch_array($sql)){
							echo '<option value="'.$data_matkul['id_matkul'].'">'.$data_matkul['nama_matkul'].'</option>';
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="ta">Tahun Ajaran</label>
					<select class="form-control" id="ta" name="ta">
                    	<?php
						$sqlsesi= mysqli_query($con, "SELECT * FROM ta WHERE status ='Aktif'");
						$data=mysqli_fetch_array($sqlsesi);
                            echo '<option value="'.$data['id_ta'].'">'.$data['nama_ta'].'/'.$data['sem'].'</option>';
                            while($row=mysqli_fetch_array($sqlsesi))
                            {
                            echo '<option value="'.$row['id_ta'].'">'.$row['nama_ta'].'/'.$row['sem'].'</option>';
                            }
                         ?>
                    </select>
				</div>
				<!-- <div class="form-group">
					<label for="sem">Semester</label>
					<div>
						<label class="radio-inline">
							<input type="radio" name="sem" id="sem" value="Ganjil" required>Ganjil
						</label>
						<label class="radio-inline">
							<input type="radio" name="sem" id="sem" value="Genap" required>Genap 	
						</label>
					</div>
				</div> -->
				<div class="form-group pull-right">
					<input type="submit" name="add" value="Simpan" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div 	

<?php/ 
include_once('../_footer.php')
?>