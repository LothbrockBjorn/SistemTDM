<?php include_once('../_header.php'); ?>

<div class="box">
	<h1>Pengampu Matakuliah</h1>
	<h4>
		<small>Edit Data Pengampu</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
		</div>
	</h4>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<?php
				$id =@$_GET['id'];
				$sql_matkul = mysqli_query($con, "SELECT * FROM pengampu_matkul JOIN ta ON pengampu_matkul.id_ta = ta.id_ta WHERE id_pengampu ='$id'") or die (mysqli_error($con));
				$data = mysqli_fetch_array($sql_matkul);
				$matkul = $data['id_matkul'];
				$idpengampu1 = $data['id_dosen1'];
				$idpengampu2 = $data['id_dosen2'];
			?>
			<form action="proses.php" method="post">
				<div class="form-group">
					<?php
					$sql_matkul = mysqli_query($con, "SELECT * FROM matkul WHERE id_matkul ='$matkul'") or die (mysqli_error($con));
					$datamatkul = mysqli_fetch_array($sql_matkul);?>
					<input type="hidden" name="id" value="<?=$data['id_pengampu']?>">
					<input type="hidden" name="matkul" id="matkul"  value="<?=$datamatkul['nama_matkul']?>" class="form-control" required autofocus>
				</div>
				<div class="form-group">
					<?php
					$sql_pengampu1 = mysqli_query($con, "SELECT nama_dosen FROM dosen WHERE id_dosen ='$idpengampu1'") or die (mysqli_error($con));
					$datapengampu1 = mysqli_fetch_array($sql_pengampu1);?>
					<label for="nama1">Dosen Pengampu 1</label>
					<input type="text" name="nama1" id="nama1" value="<?=$datapengampu1['nama_dosen']?>" class="form-control" required autofocus>
				</div>
				<div class="form-group">
					<?php
					$sql_pengampu2 = mysqli_query($con, "SELECT nama_dosen FROM dosen WHERE id_dosen ='$idpengampu2'") or die (mysqli_error($con));
					$datapengampu2 = mysqli_fetch_array($sql_pengampu2);?>
					<label for="nama2">Dosen Pengampu 2</label>
					<input type="text" name="nama2" id="nama2" value="<?=$datapengampu2['nama_dosen']?>" class="form-control" required autofocus>
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
					<label for="ta">Tahun ajar</label>
					<select class="form-control" id="ta" name="ta" required>
                    	<?php
                    	$id_ta = $data['id_ta'];
						$sqlsesi= mysqli_query($con, "SELECT * FROM ta");
                            while($row=mysqli_fetch_array($sqlsesi))
                            { ?>
                            	<option <?php 
                            	if ($id_ta == $row['id_ta']) echo 'selected';?> ><?=$row['sem'].' / '.$row['nama_ta'] ?></option>
                            <?php }
                         ?>
                    </select>
					<!-- <input type="text" name="ta" id="ta" value="<?=$data['ta']?>" class="form-control" required autofocus> -->
				</div>
				<div class="form-group">
					<input type="submit" name="edit" value="Simpan" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>

 <script>
  $(function() {
    var datand = "ac_namadosen.php";
    $( "#nama1" ).autocomplete({
      source: datand  
    });
    $( "#nama2" ).autocomplete({
      source: datand  
    });
  });
  </script>

<?php
include_once('../_footer.php')
?>