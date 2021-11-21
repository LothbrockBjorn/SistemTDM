<?php include_once('../_header.php');?>

<div class="box">
	<h1>Matakuliah</h1>
	<h4>
		<small>Data Matakuliah</small><?php if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) { ?><br><br>
		<button class="btn btn-danger btn-sm" onclick="hapus()"><i class="glyphicon glyphicon-trash"></i>Hapus</button>
	<?php } ?>
		<div class="pull-right">
			<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
			<?php if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) { ?>
			<a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Matakuliah</a>
		<?php } ?>
		</div>
	</h4>
	<form method="post" name="proses">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover" id="matkul">
			<thead>
				<tr>
					<th>
						<center>
							<input type="checkbox" name="select_all" id="select_all" value="">
						</center>
					</th>
					<th>No.</th>
					<!-- <th>Kode Matkul</th> -->
					<th>Nama Matakuliah</th>
					<th>Prodi</th>
					<th>Sks</th>
					<th>Semester</th>
					<?php if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) { ?>
					<th><i class="glyphicon glyphicon-cog"></i></th>
				<?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php
				$no=1;
				if (isset($_SESSION['lvl_prodi']) != '') {
					$lvl_prodi=$_SESSION['lvl_prodi'];
					$sqlsesi= mysqli_query($con, "SELECT * FROM prodi WHERE lvl_prodi = '$lvl_prodi'");
					$datasesi= mysqli_fetch_array($sqlsesi);
					$kd_prodi= $datasesi['kd_prodi'];
					$sql_matkul = mysqli_query($con, "SELECT * FROM matkul JOIN prodi ON matkul.kd_prodi = prodi.kd_prodi WHERE matkul.kd_prodi='$kd_prodi'") or die (mysqli_error($con));
				}else{
					$sql_matkul = mysqli_query($con, "SELECT * FROM matkul JOIN prodi ON matkul.kd_prodi = prodi.kd_prodi") or die (mysqli_error($con));
				}				
				while($data = mysqli_fetch_array($sql_matkul)){
					?>
					<tr>
						<td align="center">
							<input type="checkbox" name="checked[]" id="checked[]" class="check" value="<?=$data['id_matkul'] ?>">
						</td>
						<td><?=$no++ ?></td>
						<!-- <td><?=$data['id_matkul'] ?></td> -->
						<td><?=$data['nama_matkul'] ?></td>
						<td><?=$data['nama_prodi'] ?></td>
						<td><?=$data['sks'] ?></td>
						<td><?=$data['sem'] ?></td>
						<?php if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) { ?>
						<td align="center">
							<a href="edit.php?id=<?=$data['id_matkul']?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
						</td>
					<?php } ?>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function() {
    
    $('#matkul').DataTable({
    	columnDefs: [
    		{
	    		"searchable": false,
	    		"orderable": false,
	    		"targets": [0, 6]
    		}
    	],
    	"order" : [1, "asc"]
    });

		$('#select_all').on('click', function(){
			if (this.checked){
				$('.check').each(function(){
					this.checked = true;
				})
			}else{
				$('.check').each(function(){
					this.checked = false;
				})
			}
		});

		$('.check').on('click', function(){
			if($('.check:checked').length == $('.check').length){
				$('#select_all').prop('checked', true)
			} else {
				$('#select_all').prop('checked', false)
			}
		})
	})

	function hapus(){
		var conf =confirm('yakin ingin menghapus data yang di pilih?')
		if(conf){
		document.proses.action = 'del.php';
		document.proses.submit();
		}
	}
</script>


<?php include_once('../_footer.php');?>