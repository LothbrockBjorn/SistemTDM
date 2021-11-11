<?php
	require_once"../_config/config.php";
	require "../assets/libs/vendor/autoload.php";

	use Ramsey\Uuid\Uuid;
	use Ramsey\Uuid\Exception\UnstatisfiedDependencyException;

	if (isset($_POST['add'])) {
		$uuid = Uuid::uuid4()->toString();
		$nama1 = trim(mysqli_real_escape_string($con, $_POST['nama1']));
		$nama2 = trim(mysqli_real_escape_string($con, $_POST['nama2']));
		$matkul = trim(mysqli_real_escape_string($con, $_POST['matkul']));
		$prodi = trim(mysqli_real_escape_string($con, $_POST['prodi']));
		$ta = trim(mysqli_real_escape_string($con, $_POST['ta']));
		$kelas = trim(mysqli_real_escape_string($con, $_POST['kelas']));

		$sqlnamapengampu1 = mysqli_query($con, "SELECT id_dosen FROM dosen WHERE nama_dosen ='$nama1'") or die (mysqli_error($con));
		$datap1 = mysqli_fetch_array($sqlnamapengampu1); 
		$sqlnamapengampu2 = mysqli_query($con, "SELECT id_dosen FROM dosen WHERE nama_dosen ='$nama2'") or die (mysqli_error($con));
		$datap2 = mysqli_fetch_array($sqlnamapengampu2); 
		$sql_kdprodi = mysqli_query($con, "SELECT * FROM prodi WHERE nama_prodi ='$prodi'") or die (mysqli_error($con));
		$data = mysqli_fetch_array($sql_kdprodi);

		$sql_idmatkul = mysqli_query($con, "SELECT * FROM matkul WHERE nama_matkul ='$matkul'") or die (mysqli_error($con));
		$datamatkul = mysqli_fetch_array($sql_idmatkul);

		$kd_prodi = $data['kd_prodi'];
		$id_matkul = $datamatkul['id_matkul'];
		$idpengampu1 = $datap1['id_dosen'];
		$idpengampu2 = $datap2['id_dosen'];

		$sql_cek_pengampu = mysqli_query($con,"SELECT * FROM pengampu_matkul WHERE id_matkul ='$id_matkul' AND id_ta='$ta' AND kelas='$kelas'")or die (mysqli_error($con));
		if (mysqli_num_rows($sql_cek_pengampu) > 0){
			echo "<script>alert('Data Pengampu matakuliah untuk TA ini sudah di input!');window.location='add.php';</script>";
		}else{

		mysqli_query($con, "INSERT INTO pengampu_matkul (id_pengampu, id_dosen1, id_dosen2, kelas, id_matkul, kd_prodi, id_ta) VALUES ('$uuid','$idpengampu1','$idpengampu2','$kelas','$id_matkul','$kd_prodi','$ta')")or die(mysqli_error($con));
		echo "<script>alert('Data berhasil di inputkan!');window.location='data.php';</script>";
	}
	
	} elseif (isset($_POST['edit'])) {
		$id = $_POST['id'];
		$matkul =$_POST['matkul'];
		$nama1 = trim(mysqli_real_escape_string($con, $_POST['nama1']));
		$nama2 = trim(mysqli_real_escape_string($con, $_POST['nama2']));
		$prodi = trim(mysqli_real_escape_string($con, $_POST['prodi']));
		$ta = trim(mysqli_real_escape_string($con, $_POST['ta']));

		$sqlnamapengampu1 = mysqli_query($con, "SELECT id_dosen FROM dosen WHERE nama_dosen ='$nama1'") or die (mysqli_error($con));
		$datap1 = mysqli_fetch_array($sqlnamapengampu1); 
		$sqlnamapengampu2 = mysqli_query($con, "SELECT id_dosen FROM dosen WHERE nama_dosen ='$nama2'") or die (mysqli_error($con));
		$datap2 = mysqli_fetch_array($sqlnamapengampu2); 
		$sql_kdprodi = mysqli_query($con, "SELECT * FROM prodi WHERE nama_prodi ='$prodi'") or die (mysqli_error($con));
		$data = mysqli_fetch_array($sql_kdprodi);
		$sql_idmatkul = mysqli_query($con, "SELECT * FROM matkul WHERE nama_matkul ='$matkul'") or die (mysqli_error($con));
		$data = mysqli_fetch_array($sql_idmatkul);

		$kd_prodi = $data['kd_prodi'];
		$id_matkul = $data['id_matkul'];
		$idpengampu1 = $datap1['id_dosen'];
		$idpengampu2 = $datap2['id_dosen'];


		mysqli_query($con, "UPDATE pengampu_matkul SET id_dosen1 = '$idpengampu1', id_dosen2 ='$idpengampu2', kd_prodi ='$kd_prodi', ta = '$ta'  WHERE id_matkul = '$id_matkul' AND id_pengampu = '$id'") or die(mysqli_error($con));
		echo "<script>window.location='data.php';</script>";
	}
?> 