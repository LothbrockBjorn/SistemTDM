<?php include_once('../_header.php');?>

<div class="box">
	<h1>Pengampu Matakuliah</h1><?php if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) { ?>
		<button class="btn btn-danger btn-sm" onclick="hapus()"><i class="glyphicon glyphicon-trash"></i>Hapus</button>
	<?php } ?>
	<h4>
		<small>Data Pengampu Matakuliah</small>
		<div class="pull-right">
			<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
			<?php if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) { ?>
			<a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Pengampu</a>
			<?php } ?>
		</div>
	</h4>
	<form method="post" name="proses">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover" id="pengampu">
			<thead>
				<tr>
					<th>
						<center>
							<input type="checkbox" name="select_all" id="select_all" value="">
						</center>
					</th>
					<th>No.</th>
					<th>Matakuliah</th>
					<th>Kelas</th>
					<th>Dosen pengampu 1</th>
					<th>Dosen pengampu 2</th>
					<th>Prodi</th>
					<th>Tahun ajar</th>
					<?php if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) { ?>
					<th><i class="glyphicon glyphicon-cog"></i></th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php
				// $sql_dp = mysqli_query($con, "SELECT * FROM pengampu_matkul WHERE id_dosen1 ='$prodi'") or die (mysqli_error($con));
				// $dp = mysqli_fetch_array($sql_dp);

				$no=1;
				if (isset($_SESSION['lvl_prodi']) !='') {
					$lvl_prodi=$_SESSION['lvl_prodi'];
					$sqlsesi= mysqli_query($con, "SELECT * FROM prodi WHERE lvl_prodi = '$lvl_prodi'");
					$datasesi= mysqli_fetch_array($sqlsesi);
					$kd_prodi= $datasesi['kd_prodi'];
					$sql_pengampu = mysqli_query($con, "SELECT * FROM pengampu_matkul INNER JOIN matkul ON pengampu_matkul.id_matkul = matkul.id_matkul INNER JOIN prodi ON pengampu_matkul.kd_prodi = prodi.kd_prodi JOIN ta ON pengampu_matkul.id_ta = ta.id_ta WHERE pengampu_matkul.kd_prodi = '$kd_prodi' AND  ta.status = 'Aktif'") or die (mysqli_error($con));
				}else{
				$sql_pengampu = mysqli_query($con, "SELECT * FROM pengampu_matkul INNER JOIN matkul ON pengampu_matkul.id_matkul = matkul.id_matkul INNER JOIN prodi ON pengampu_matkul.kd_prodi = prodi.kd_prodi JOIN ta ON pengampu_matkul.id_ta = ta.id_ta WHERE ta.status = 'Aktif'") or die (mysqli_error($con));
				}
				while($data = mysqli_fetch_array($sql_pengampu)){
					$idpengampu1 = $data['id_dosen1'];
					$idpengampu2 = $data['id_dosen2'];
						$sqlnd1 = mysqli_query($con, "SELECT nama_dosen FROM dosen WHERE id_dosen =
							'$idpengampu1'")or die(mysqli_error($con));
						$datand1 = mysqli_fetch_array($sqlnd1);
						
						$sql_nd2 = mysqli_query($con, "SELECT nama_dosen FROM dosen WHERE id_dosen = '$idpengampu2'") or die (mysqli_error($con));
						$datand2 = mysqli_fetch_array($sql_nd2);
					?>
					<tr>
						<td align="center">
							<input type="checkbox" name="checked[]" id="checked[]" class="check" value="<?=$data['id_pengampu'] ?>">
						</td>
						<td><?=$no++ ?></td>
						<td><?=$data['nama_matkul'] ?></td>
						<td><?=$data['kelas'] ?></td>
						<td><?=$datand1['nama_dosen'] ?></td>
						<td><?=$datand2['nama_dosen'] ?></td>
						<td><?=$data['nama_prodi'] ?></td>
						<td><?php echo $data['nama_ta']; echo" / ";  echo $data['sem'] ?></td>
						<?php if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) { ?>
						<td align="center">
							<a href="edit.php?id=<?=$data['id_pengampu']?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
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
    
    $('#pengampu').DataTable({
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
		var conf =confirm('yakin akan menghapus data ini?')
		if(conf){
		document.proses.action = 'del.php';
		document.proses.submit();
		}
	}
</script>


<?php include_once('../_footer.php');?>