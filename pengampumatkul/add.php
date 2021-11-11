<?php include_once('../_header.php'); 
?>

<div class="box">
	<h1>Pengampu Matakuliah</h1>
	<h4>
		<small>Tambah Data Pengampu</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
		</div>
	</h4>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<form action="proses.php" method="post">
				<div class="form-group">
					<label for="matkul">Matakuliah</label>
					<input type="text" name="matkul" id="matkul" class="form-control" required autofocus>
				</div>
				<div class="form-group">
					<label for="nama1">Nama Dosen pengampu 1</label>
					<input type="text" name="nama1" id="nama1" class="form-control" required autofocus>
				</div>
				<div class="form-group">
					<label for="nama2">Nama Dosen pengampu 2</label>
					<input type="text" name="nama2" id="nama2" class="form-control" required autofocus>
				</div>
				<div class="form-group">
					<label for="ta">Kelas</label>
					<input type="text" name="kelas" class="form-control" placeholder="Masukan kelas" required >
				</div>
				<!-- ngambil data dari tabel prodi -->
				<div class="form-group">
					<label for="prodi">Prodi</label>
                    <select class="form-control" id="prodi" name="prodi">
                    	<option>Pilih Prodi</option>
                    	<?php
                    	 if (isset($_SESSION['lvl_prodi']) != '') {
						$lvl_prodi=$_SESSION['lvl_prodi'];
						$sqlsesi= mysqli_query($con, "SELECT * FROM prodi WHERE lvl_prodi = '$lvl_prodi'");
						$datasesi= mysqli_fetch_array($sqlsesi);
						$kd_prodi= $datasesi['kd_prodi'];
						$select=mysqli_query($con, "select nama_prodi from prodi where kd_prodi = '$kd_prodi' group by nama_prodi");
						}else{
							$select=mysqli_query($con, "select nama_prodi from prodi group by nama_prodi");
						}
                            while($row=mysqli_fetch_array($select))
                            {
                            echo "<option>".$row['nama_prodi']."</option>";
                            }
                         ?>
                    </select>
				</div>
				<!-- end -->
				<div class="form-group">
					<label for="ta">Tahun ajar</label>
					<select class="form-control" id="ta" name="ta">
                    	<!-- <option>Pilih Tahun Ajaran</option> -->
                    	<?php
						$sqlsesi= mysqli_query($con, "SELECT * FROM ta where status ='Aktif'");
                            while($row=mysqli_fetch_array($sqlsesi))
                            {
                            echo "<option value='$row[id_ta]'>".$row['nama_ta']." / ".$row['sem']."</option>";
                            }
                         ?>
                    </select>
				</div>
				<div class="form-group">
					<input type="submit" name="add" value="Simpan" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>	
 <script>
  $(function() {
    var data = "autocomplete_search.php";
    var datand = "ac_namadosen.php";
    $( "#matkul" ).autocomplete({
      source: data  
    });
    $( "#nama1" ).autocomplete({
      source: datand  
    });   
    $( "#nama2" ).autocomplete({
      source: datand  
    });
  });
  </script>

<?php
include_once('../_footer.php');
?>