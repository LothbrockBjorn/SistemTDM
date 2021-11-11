<?php include_once('../_header.php');?>
<!-- yang di komen adalah bagian untuk kloning data pengampu matakuliah -->
<div class="box">
	<h1>Tahun Ajaran</h1>
	<h4>
		<small>Data Tahun Ajaran</small><?php if ($_SESSION['level'] == 3 ) { ?>
	<?php } ?>
		<div class="pull-right">
			<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
			<?php if ($_SESSION['level'] == 3) { ?>
			<a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Buka Tahun Ajar</a>
		<?php } ?>
		</div>
	</h4>	
	<form>
	<div class="table-responsive">
		<table class="table table-bordered table-hover" id="ta">
			<thead>
				<tr>
					<th class="text-center">No.</th>
					<th class="text-center">Tahun Ajar</th>
					<th class="text-center">Semester</th>
					<th class="text-center">Status</th>
					<th class="text-center">Aksi</th>
					<!-- <th class="text-center" style="width: 200px">Clone Data Pengampu</th> -->
				</tr>
			</thead>
			<tbody>
				<?php
				$no=1;

				// if (isset($_SESSION['lvl_prodi']) != '') {
				// 	$lvl_prodi=$_SESSION['lvl_prodi'];
				// 	$sqlsesi= mysqli_query($con, "SELECT * FROM prodi WHERE lvl_prodi = '$lvl_prodi'");
				// 	$datasesi= mysqli_fetch_array($sqlsesi);
				// 	$kd_prodi= $datasesi['kd_prodi'];
				// }

					$sql_ta = mysqli_query($con, "SELECT * FROM ta") or die (mysqli_error($con));
				while($data = mysqli_fetch_array($sql_ta)){
					// if (isset($_SESSION['lvl_prodi']) != '') {
					// 	$sql_jdpm = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM pengampu_matkul join matkul ON pengampu_matkul.id_matkul = matkul.id_matkul  WHERE ta ='$data[ta]' AND matkul.sem = '$data[sem]' AND pengampu_matkul.kd_prodi='$kd_prodi'") or die (mysqli_error($con));
					// }else{
					// 	$sql_jdpm = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM pengampu_matkul join matkul on pengampu_matkul.id_matkul = matkul.id_matkul  WHERE ta ='$data[ta]' AND matkul.sem = '$data[sem]'") or die (mysqli_error($con));
					// }
					// $sql_data = mysqli_fetch_array($sql_jdpm);
					?>
					<tr>
						<td class="text-center"><?=$no++ ?></td>
						<td class="text-center"><?=$data['nama_ta'] ?></td>
						<td class="text-center"><?=$data['sem'] ?></td>
						<td class="text-center"><?=$data['status'] ?></td>
						<td class="text-center" style="max-width: 40px;" ><a href="ubahstatus.php?id=<?php echo $data['id_ta'] ?>" class="btn btn-warning btn-sm"><b>Ubah Status</b></a></td>
						<?php if (isset($_SESSION['lvl_prodi']) != ''){?>
						<!-- <td class="text-center">
							<button type="button" data-toggle="modal" data-target="#modalCloning" data-id="<?=$data['id_ta']?>" 
							data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-md"><i class="glyphicon glyphicon-file"> Cloning</i></button>
						</td> -->
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

<!-- --pemroses button-- -->
<?

?>

<?php include_once('modal.php');?>

<script type="text/javascript">
	$(document).ready(function() {
    
    $('#ta').DataTable({
    	columnDefs: [
    		{
	    		"searchable": false,
	    		"orderable": true,
	    		"targets": [0]
    		}
    	],
    	// "order" : [0, "asc"]
    });

     // $('#modalCloning').on('show.bs.modal', function (e) {
     //        var getCloning = $(e.relatedTarget).data('id');
     //        /* fungsi AJAX untuk melakukan fetch data */
     //        $.ajax({
     //            type : 'post',
     //            url : 'proses.php',
     //            // detail per identifier ditampung pada berkas detail.php yang berada di file lain
     //            data :  'getCloning='+ getCloning,
     //            /* memanggil fungsi getCloning dan mengirimkannya */
     //            success : function(data){
     //            $('.modal-data').html(data);
     //            /* menampilkan data dalam bentuk dokumen HTML */
     //            }
     //        });
     //     });
	})
</script>

<style type="text/css">
	.modal-backdrop{
		z-index :-2;
	}
</style>

<?php include_once('../_footer.php');?>