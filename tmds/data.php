 <?php include_once('../_header.php');?>

<div class="box">
	<h1>Rekap TMD</h1>
	<h4>
		<small>Data Rekap TM</small>
		<div class="pull-right">
			<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
			<?php if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) { ?>
			<a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Rekap data</a>
		<?php } ?>
		</div>
	</h4>
<!-- 	<div style="margin-bottom: 20px;">
		<form class="form-inline" action="" method="post">
			<div class="form-group">
				<input type="text" name="pencarian" class="form-control" placeholder="Pencarian">	
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" 
					aria-hidden="true"></span></button>
			</div>
		</form>
	</div>
 -->	<div class="table-responsive">
		<table id="table" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>No.</th>
					<th>Matakuliah/TA</th>
					<th>Smt/Kelas</th>
					<th>Sks</th>
					<th>Nama Dosen Pengampu</th>
					<th>Jumlah Tatap Muka ideal</th>
					<th>Jumlah Capai Tatap Muka</th>
					<th>Sisa Tatap Muka</th>
					<th>Last Updated</th>
					<th><i class="glyphicon glyphicon-cog"></i></th>
				
				</tr>
			</thead>
			<tbody>
				<?php 
				$no = 1;
				if (isset($_SESSION['lvl_prodi']) != '') {
					$lvl_prodi=$_SESSION['lvl_prodi'];
					$sqlsesi= mysqli_query($con, "SELECT * FROM prodi WHERE lvl_prodi = '$lvl_prodi'");
					$datasesi= mysqli_fetch_array($sqlsesi);
					$kd_prodi= $datasesi['kd_prodi'];
					$query = "SELECT * FROM tmds join ta on tmds.id_ta = ta.id_ta WHERE tmds.kd_prodi = '$kd_prodi' AND ta.status = 'Aktif'";
					$sql_rm = mysqli_query($con, $query) or die (mysqli_error($con));
				}else{
					$query = "SELECT * FROM tmds join ta on tmds.id_ta = ta.id_ta WHERE ta.status = 'Aktif'";
					$sql_rm = mysqli_query($con, $query) or die (mysqli_error($con));
					}
				while($data = mysqli_fetch_array($sql_rm)){
						$jtmi = $data['jtmi']; 
						$jctm=$data['jctm']; 
						$stm =$jtmi - $jctm; 
						$ta = $data['nama_ta'];
						$id_pengampu =$data['id_pengampu'];
						$sql = mysqli_query($con, "SELECT * FROM pengampu_matkul JOIN matkul ON pengampu_matkul.id_matkul = matkul.id_matkul join dosen on pengampu_matkul.id_dosen2 = dosen.id_dosen join ta on pengampu_matkul.id_ta = ta.id_ta WHERE id_pengampu = '$id_pengampu' AND ta.status ='Aktif'")or die(mysqli_error($con));
						$peng = mysqli_fetch_assoc($sql);
						// $id_matkul = $peng['id_matkul'];
						$idpengampu1 = $peng['id_dosen1'];
						$idpengampu2 = $peng['id_dosen2'];
						$nama_matkul = $peng['nama_matkul'];
						$nama_dosen2 = $peng['nama_dosen'];
						$sks = $peng['sks'];
						$kelas = $peng['kelas'];


						$sqlnd1 = mysqli_query($con, "SELECT nama_dosen FROM dosen WHERE id_dosen =
							'$idpengampu1'")or die(mysqli_error($con));
						$datand1 = mysqli_fetch_array($sqlnd1);
						$nama_dosen1 = $datand1['nama_dosen'];

				?>
				<tr>
					<td><?=$no++?>.</td>
					<td><?php
							echo $nama_matkul."<br>".$ta;
						?>
					</td>
					<td><?=$kelas?></td>
					<td><?=$sks?></td>
					<td><?=$nama_dosen1."<br>".$nama_dosen2?></td>
					<td><?=$jtmi?></td>
					<td><?=$jctm?></td>
					<td><?=$stm;?></td>
					<td><?=$data['updated']?></td>
					
					<td align="center">
						<!-- <a href="" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Detail</a> -->
						<input type="button" name="detail" value="Detail" data-id="<?php echo $data["id_pengampu"]; ?>" class="btn btn-info btn-xs detail_data" style="width: 60px;">
						
					<?php if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) { ?>
						<a href="del.php?id=<?=$data['id_tmds']?>" class="btn btn-danger btn-xs" style="margin-top: 5px;"><i class="glyphicon glyphicon-trash"></i>Delete</a>
					<?php } ?>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
	   
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #21addb; border-radius: 5px 5px 0 0;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="background-color: #21addb; color: white;">Detail tatap muka dosen / matakuliah</h4>
        </div>
        <div class="modal-body" id="detail">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <!-- style modal -->
	<style type="text/css">
	.modal-backdrop{
		z-index :-2;
	}
  	</style>
<!-- js untuk tabel -->
	<script type="text/javascript">
		$(document).ready(function(){
			$('#table').DataTable({
				columnDefs: [
				{
					"searchable" : false,
					"orderable" : false,
					"targets" : 8
				}
				]
			});

// js untuk modal
		$('.detail_data').click(function(){
		var data_id = $(this).data("id")
		$.ajax({
			url: "proses.php",
			method: "POST",
			data: {data_id: data_id},
			success: function(data){
				$("#detail").html(data)
				$("#myModal").modal('show')
			}
		})
	});
		});
	</script>
</div>


<?php include_once('../_footer.php');?>