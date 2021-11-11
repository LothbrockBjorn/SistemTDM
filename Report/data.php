<?php include_once('../_header.php');?>

<div class="box">
	<h1>Generate Report  TMD</h1>
	<!-- <small>Laporan</small> -->
	<div class="col-lg-6">
	<div class="panel panel-default">
		<div class="panel-heading">Laporan TMD per Matakuliah</div>
		<div class="panel-body">
			<form action="reportpermatkul.php" method="post" target="_blank">
				<div class="form-group">
					<label for="periode"> Priode Tahun Ajaran</label>
					<select class="form-control" id="ta" name="ta">
                    	<option>Pilih Tahun Ajaran</option>
                    	<?php
						$sqlsesi= mysqli_query($con, "SELECT * FROM ta WHERE status ='Aktif'");
                            while($row=mysqli_fetch_array($sqlsesi))
                            {
                            echo "<option value=".$row['id_ta'].">".$row['sem'].' / '.$row['nama_ta']."</option>";
                            }
                         ?>
                    </select>
				</div>
				<div class="form-group">
					<label for="prodi"> Prodi</label>
					<select class="form-control"  name="prodi"> 
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
				</div><!-- 
				<div class="form-group">
					<label for="sem">Semster</label>
					<select class="form-control" name="sem">
						<option value="Ganjil">Ganjil</option>
						<option value="Genap">Genap</option>
					</select>
				</div> -->
				<!-- <table>
					<tr>
						<td width="50%">
							<div class="form-group" >
								<label for="periode">Dari Tanggal</label>
								<input type="date" name="tgl_a" class="tgl form-control" value="<?= date('Y-m-d')?>" required>
							</div>
						</td>
						<td width="20px"><div></div></td>	
						<td width="50%">
							<div class="form-group">
								<label for="periode">Sampai Tanggal</label>
								<input type="date" name="tgl_b"  class="tgl form-control" value="<?= date('Y-m-d')?>" required>
							</div>
						</td>
					</tr>
				</table> -->
				<div class="from-group pull-right">
					<input type="submit" name="permatkul" value="Proses Laporan" class="btn btn-success">
				</div>
			</form>
			</div>
		</div>
	</div>


		<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">Laporan TMD per dosen</div>
			<div class="panel-body">
			<form action="reportperdosen1.php" method="post" target="_blank">
				<div class="form-group">
					<label for="ta"> Priode Tahun Ajaran</label>
					<select class="form-control" id="ta" name="ta">
                    	<option>Pilih Tahun Ajaran</option>
                    	<?php
						$sqlsesi= mysqli_query($con, "SELECT * FROM ta where status = 'Aktif'");
                            while($row=mysqli_fetch_array($sqlsesi))
                            {
                            echo "<option value=".$row['id_ta'].">".$row['sem'].' / '.$row['nama_ta']."</option>";
                            }
                         ?>
                    </select>
				</div>
				<div class="form-group">
					<label for="prodi"> Prodi</label>
					<select class="form-control"  name="prodi"> 
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
				<table>
					<tr>
						<td width="50%">
							<div class="form-group" >
								<label for="periode">Dari Tanggal</label>
								<input type="date" name="tgl_a" class="form-control" value="<?= date('Y-m-d')?>" required>
							</div>
						</td>
						<td width="20px"><div></div></td>	
						<td width="50%">
							<div class="form-group">
								<label for="periode">Sampai Tanggal</label>
								<input type="date" name="tgl_b"  class="form-control" value="<?= date('Y-m-d')?>" required>
							</div>
						</td>
					</tr>
				</table>
				<div class="from-group pull-right">
					<input type="submit" name="perdosen" value="Proses Laporan" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
	</div>

<?php include_once('../_footer.php');?>