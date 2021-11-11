<?php include_once('../_header.php'); ?>

<div class="box">
	<h1>TMD</h1>
	<h4>
		<small>Edit Data Tatap muka Dosen</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
		</div>
	</h4>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<form action="proses.php" method="post">
				<?php
				$id = @$_GET['id'];

				$sql_main = mysqli_query($con, "SELECT * FROM tmdb JOIN dosen ON tmdb.id_dosen = dosen.id_dosen JOIN pengampu_matkul ON tmdb.id_pengampu = pengampu_matkul.id_pengampu WHERE id_tmdb='$id'") or die (mysqli_error($con));

					while ( $data = mysqli_fetch_array($sql_main)) {
					$id_pengampu = $data['id_pengampu'];
					$id_matkul = $data['id_matkul'];
					$id_dosen = $data['id_dosen'];
					$id_ta = $data['id_ta'];	
					$kd_prodi = $data['kd_prodi'];
					$tgl = $data['tanggal'];
					$nama_dosen = $data['nama_dosen'];
					$id_dosen1 = $data['id_dosen1'];
					$id_dosen2 = $data['id_dosen2'];
				}
				?>
				<div class="form-group">
					<label for="dosen">Nama dosen</label>
					<input type="hidden" name="id_pengampu" value="<?=@$id_pengampu?>">
					<input type="hidden" name="id_matkul" value="<?=@$id_matkul?>">
					<input type="hidden" name="id_tmdb" value="<?=@$id?>">
					<input type="hidden" name="id_ta" value="<?=@$id_ta?>">
					<input type="hidden" name="kd_prodi" value="<?=@$kd_prodi?>">
					<?php
						$sql1 =mysqli_query($con, "SELECT * FROM dosen WHERE id_dosen ='$id_dosen1'") or die (mysqli_error($con));
						$data1 = mysqli_fetch_array($sql1);
						$nama_dosen1 = $data1['nama_dosen'];

						$sql2 =mysqli_query($con, "SELECT * FROM dosen WHERE id_dosen ='$id_dosen2'") or die (mysqli_error($con));
						$data2 = mysqli_fetch_array($sql2);
						$nama_dosen2 = $data2['nama_dosen'];
					?>
					<select name="nama" class="form-control">
						 <?php
                            $select=mysqli_query($con, "SELECT * from pengampu_matkul WHERE id_matkul = '$id_matkul' AND id_ta = '$id_ta'");
                            while($row=mysqli_fetch_array($select))
                            { ?>
                                <option <?php if ($nama_dosen1 == $nama_dosen){ echo 'selected'; $used = $id_dosen1;}elseif($id_dosen2 == $nama_dosen){echo 'selected'; $used = $id_dosen2;} 
                                ?> > <?= $nama_dosen ?></option>
                                <?php if ($used == $id_dosen1){
                                	$nama = $nama_dosen2;} 
                                		else $nama = $nama_dosen1;?>
                                <option> <?= $nama ?></option>
                            <?php } 
                            ?>		
					</select>
				</div>				
				<div class="form-group">
					<label for="nama">Tanggal</label>
					<input type="date" name="tgl" id="tgl"	value="<?=$tgl?>" class="form-control" required>
				</div>
				<div class="form-group">
					<input type="submit" name="edit" value="Simpan" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div 	

<?php
include_once('../_footer.php');
?>