<?php include_once('../_header.php');?>
	<!-- <script type="text/javascript">
		function fetch_select(val)
	{
	 $.ajax({
	 type: 'post',
	 url: 'fetch.php',
	 data: {
	  get_option:val
	 },
	 success: function (response) {
	  document.getElementById("nama").innerHTML=response; 
	 }
	 });
	}
	</script> -->
	<div class="box">
	<h1>Tatap Muka Dosen</h1>
	<h4>
		<small>Tambah Data Tatap Muka</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>Kembali</a>
		</div>
	</h4>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<form action="add.php" method="post">
				<div class="form-group">
					<label for="matakuliah">Matakuliah</label>
					<select class="form-control" id="matakuliah" name="matakuliah"> 
                    <option>Pilih Matakuliah</option>
                    <?php
                    if (isset($_SESSION['lvl_prodi']) !='') {
					$lvl_prodi=$_SESSION['lvl_prodi'];
					$sqlsesi= mysqli_query($con, "SELECT * FROM prodi WHERE lvl_prodi = '$lvl_prodi'");
					$datasesi= mysqli_fetch_array($sqlsesi);
					$kd_prodi= $datasesi['kd_prodi'];
					 $select=mysqli_query($con, "select * from pengampu_matkul JOIN ta ON pengampu_matkul.id_ta = ta.id_ta JOIN matkul ON pengampu_matkul.id_matkul = matkul.id_matkul WHERE pengampu_matkul.kd_prodi = '$kd_prodi' AND ta.status = 'Aktif' group by nama_matkul");
				}else{
					 $select=mysqli_query($con, "select * from pengampu_matkul JOIN ta ON pengampu_matkul.id_ta = ta.id_ta JOIN matkul ON pengampu_matkul.id_matkul = matkul.id_matkul WHERE ta.status = 'Aktif' group by nama_matkul");
				}
                   
                    while($row=mysqli_fetch_array($select))
                    {
                    echo "<option>".$row['nama_matkul']."</option>";
                    }
                    ?>
                    </select>
					<!-- <input type="text" name="matkul" id="matkul" class="form-control" required autofocus> -->
				</div>
				<div class="form">
					<label>Tahun ajar</label>
					<select class="form-control" id="id_ta" name="id_ta">
						<?php
						$sqlsesi= mysqli_query($con, "SELECT * FROM ta WHERE status = 'Aktif'");
						$data=mysqli_fetch_array($sqlsesi);
                            echo "<option value='$data[id_ta]'>".$data['nama_ta']." / ".$data['sem']."</option>";
						?>
                    	<?php
                            while($row=mysqli_fetch_array($sqlsesi))
                            {
                            echo "<option value='$row[id_ta]'>".$row['nama_ta']." / ".$row['sem']."</option>";
                            }
                         ?>
                    </select>
				<!-- <input type="text" name="ta" class="form-control" required> -->
				</div>
				<br>
				<div class="form-group">
					<label for="count_add"> Banyak record tatap muka</label>
					<input type="text" name="count_add" id="count_add" maxlength="2" pattern="[0-9]+" class="form-control" required>
				</div>
				<div class="from-group pull-right">
					<input type="submit" name="generate" value="Generate" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
	<!-- <script>
		$(document).ready(function() {
		    $('#matakuliah').select2();
		});
	</script>   -->
<?php include_once('../_header.php');?>