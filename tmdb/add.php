<?php include_once('../_header.php'); ?>

<div class="box">
	<h1>Record Tatap muka</h1>
	<h4>
		<small>Tambah Data</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
		</div>
	</h4>
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			<form action="proses.php" method="post">
					<input type="hidden" name="matkul" id="matkul"  value="<?=@$_POST['matakuliah']?>">
					<?php
					$matkul = $_POST['matakuliah'];
					$select=mysqli_query($con, "select id_matkul,kd_prodi from matkul where nama_matkul='$matkul'");
        			while($row=mysqli_fetch_array($select))
        			{$id_matkul= $row['id_matkul'];
        			$kd_prodi= $row['kd_prodi'];}
					?>

					<input type="hidden" name="total" value="<?=@$_POST['count_add']?>">
					<table class="table">
					<tr>
						<th>#</th>
						<th>Nama Dosen</th>
						<th>Tanggal masuk</th>
					</tr>
					<?php
					for ($i=1; $i<=$_POST['count_add']; $i++) { ?>
						<tr>
							<td><?=$i ?></td>
							<td>
								<select name="nama-<?=$i?>" class="form-control">
									<option>Pilih dosen</option>
								<?php 
								$ta = $_POST['id_ta'];
								$select=mysqli_query($con, "SELECT * FROM pengampu_matkul WHERE id_matkul='$id_matkul' AND id_ta = '$ta'");
                    				while($row=mysqli_fetch_array($select)){
                    					$idpengampu1 = $row['id_dosen1'];
                    					$idpengampu2 = $row['id_dosen2']; 
						$sqlnd1 = mysqli_query($con, "SELECT nama_dosen FROM dosen WHERE id_dosen =
							'$idpengampu1'")or die(mysqli_error($con));
						$datand1 = mysqli_fetch_array($sqlnd1);
						
						$sql_nd2 = mysqli_query($con, "SELECT nama_dosen FROM dosen WHERE id_dosen = '$idpengampu2'") or die (mysqli_error($con));
						$datand2 = mysqli_fetch_array($sql_nd2);
                    				 echo "<option>".$datand1['nama_dosen']."</option>";
                    				 echo "<option>".$datand2['nama_dosen']."</option>";
                    				 $id_pengampu = $row['id_pengampu'];
                    				}
								?>
								</select>
								<input type="hidden" name="id_pengampu" value="<?=@$id_pengampu?>">
								<input type="hidden" name="id_matkul" value="<?=@$id_matkul?>">
								<input type="hidden" name="kd_prodi" value="<?=@$kd_prodi?>">
								<input type="hidden" name="ta" value="<?=@$ta?>">
								<td>
									<input type="date" name="tgl-<?=$i?>" id="tgl"	value="<?= date('Y-m-d')?>" class="form-control" required>
								</td>
							</td>
						</tr>	
						<?php
						}
					?>
				</table>
				<div class="form-group pull-right">
					<input type="submit" name="add" value="simpan Semua" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div 	

<?php
include_once('../_footer.php')
?>