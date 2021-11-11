<?php include_once('../_header.php'); ?>

<div class="box">
	<h1>Tahun Ajaran Baru</h1>
	<h4>
		<small>Tambah Data Tahun Ajaran Baru</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
		</div>
	</h4>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<form action="proses.php" method="post">
				<div class="form-group">
					<label for="id">Tahun Ajaran</label>
					<input type="text" name="ta" id="ta" class="form-control" required autofocus>
				</div>
				<div class="form-group">
				<label for="sem">Semester</label>
                    <select class="form-control" id="sem" name="sem">
                    	<option>Pilih Semester</option>
                    	<option value="Ganjil">Ganjil</option>
                    	<option value="Genap">Genap</option>
                    </select>
				</div>
				<div class="form-group">
					<input type="submit" name="add" value="Simpan" class="btn btn-success" style="float: right;">
				</div>
			</form>
		</div>
	</div>
</div 	

<?php/ 
include_once('../_footer.php')
?>