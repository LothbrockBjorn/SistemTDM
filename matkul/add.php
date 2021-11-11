<?php include_once('../_header.php'); 
?>

  	<!-- <script type="text/javascript">
    function fetch_select(val)
    {
    $.ajax({
    type: 'post',
    url: 'prodi-to-matkul.php',
    data: {
    get_option:val
    },
    success: function (response) {
    document.getElementById("prodi").innerHTML=response; 
    }
    });
    }
    </script> -->

<div class="box">
	<h1>Matakuliah</h1>
	<h4>
		<small>Tambah Data Matakuliah</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
		</div>
	</h4>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<form action="proses.php" method="post">
				<div class="form-group">
					<label for="id">Kode Matakuliah</label>
					<input type="text" name="id" id="id" class="form-control" required autofocus>
				</div>
				<div class="form-group">
					<label for="nama">Nama Matakuliah</label>
					<input type="text" name="nama" id="nama" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="jabatan">Sks</label>
					<input type="text" name="sks" id="sks" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="sem">Semester</label>
					<div>
						<label class="radio-inline">
							<input type="radio" name="sem" id="sem" value="Ganjil" required>Ganjil
						</label>
						<label class="radio-inline">
							<input type="radio" name="sem" id="sem" value="Genap" >Genap 	
						</label>
					</div>
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
					<input type="submit" name="add" value="Simpan" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div 	

<?php
include_once('../_footer.php')
?>