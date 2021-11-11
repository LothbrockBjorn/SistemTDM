<?php include_once('../_header.php');?>

<div class="box">
	<h1>Data tatap muka dosen</h1>
	<h4>
		<small>Data tatap muka dosen</small>
		<div class="pull-right">
			<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
			<?php if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) { ?>
			<a href="generate.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
		<?php } ?>
		</div>
	</h4>
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover" id="tmdb" >
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Dosen</th>
					<th>Matakuliah</th>
					<th>Kelas</th>
					<th>Tanggal</th>
					<th>Prodi</th>
					<th>Semester / Tahun ajar</th>
					<?php if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) { ?>
					<th><center><i class="glyphicon glyphicon-cog"></i></center></th>
				<?php } ?>
				</tr>
			</thead>
		</table>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){

		// js modal
  //  		$('.detail_data').click(function(){
		// var data_id = $(this).attr("id")
		// 	$.ajax({
		// 	url: "proses.php",
		// 	method: "POST",
		// 	data: {data_id: data_id},
		// 		success: function(data){
		// 			$("#detail").html(data)
		// 			$('#myModal').modal('show')
		// 		}
		// 	})
		// });

   		$('#tmdb').DataTable( {
   			"columnDefs": [{"orderable": false,
	        "targets": 6 }],  
	        "processing": true,
	        "serverSide": true,
	        "ajax": "tmdv1.php"
        // scrollY : '250px',
    	});

   		
	});
	</script>

</div>


 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #525252; border-radius: 5px 5px 0 0;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="background-color: #525252; color: white;">Detail tatap muka dosen</h4>
        </div>
        <div class="modal-body" id="detail">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<style type="text/css">
	.modal-backdrop{
		z-index :-2;
	}
</style>

<?php include_once('../_footer.php');?>