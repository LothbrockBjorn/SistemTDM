<?php include_once('../_header.php');?>

<div class="box">
	<h1>Dosen</h1>
	<h4>
		<small>Data Dosen</small><?php if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) { ?><br><br>
		<button class="btn btn-danger btn-sm" onclick="hapus()"><i class="glyphicon glyphicon-trash"></i>Hapus</button>
	<?php } ?>
		<div class="pull-right">
			<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
			<?php if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) { ?>
			<a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Dosen</a>
		<?php } ?>
		</div>
	</h4>
	<form method="post" name="proses">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover" id="dosen">
			<thead>
				<tr>
					<th>
						<center>
							<input type="checkbox" name="select_all" id="select_all" value="">
						</center>
					</th>
					<th>No.</th>
					<th>NIDN</th>
					<th>Nama Dosen</th>
					<th>Jabatan</th>
					<th>Pendidikan</th>
					<th>No telp</th>
					<?php if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) { ?>
					<th><i class="glyphicon glyphicon-cog"></i></th>
				<?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php
				$no=1;
				$sql_dosen = mysqli_query($con, "SELECT * FROM dosen") or die (mysqli_error($con));
				while($data = mysqli_fetch_array($sql_dosen)){
					?>
					<tr>
						<td align="center">
							<input type="checkbox" name="checked[]" id="checked[]" class="check" value="<?=$data['id_dosen'] ?>">
						</td>
						<td><?=$no++ ?></td>
						<td><?=$data['id_dosen'] ?></td>
						<td><?=$data['nama_dosen'] ?></td>
						<td><?=$data['jabatan'] ?></td>
						<td><?=$data['pendidikan'] ?></td>
						<td><?=$data['no_telp'] ?></td>
						<?php if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) { ?>
						<td align="center">
							<a href="edit.php?id=<?=$data['id_dosen']?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
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
    
    $('#dosen').DataTable({
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