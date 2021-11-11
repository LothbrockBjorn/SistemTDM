<?php
	require_once"../_config/config.php";
	require "../assets/libs/vendor/autoload.php";

	use Ramsey\Uuid\Uuid;
	use Ramsey\Uuid\Exception\UnstatisfiedDependencyException;

	if (isset($_POST['add'])) {
		$total = $_POST['total'];
		$id_matkul = $_POST['id_matkul'];
		$id_pengampu = $_POST['id_pengampu'];
		$kd_prodi = $_POST['kd_prodi'];
		$ta = $_POST['ta'];
		// echo $ta;
		for ($i=1; $i <=$total ; $i++) { 
			$uuid = Uuid::uuid4()->toString();
			$nama = trim(mysqli_real_escape_string($con, $_POST['nama-'.$i]));
			$select=mysqli_query($con, "select id_dosen from dosen where nama_dosen='$nama'");
        			while($row=mysqli_fetch_array($select))
        			{$id_dosen= $row['id_dosen'];}
			$tgl = trim(mysqli_real_escape_string($con, $_POST['tgl-'.$i]));
			$sql = mysqli_query($con, "INSERT INTO tmdb (id_tmdb, id_pengampu, id_matkul, id_dosen, tanggal, kd_prodi, id_ta) VALUES ('$uuid','$id_pengampu','$id_matkul','$id_dosen','$tgl','$kd_prodi','$ta')")or die(mysqli_error($con));
		}

		//update pada tabel tmds 
		$select_count=mysqli_query($con, "SELECT COUNT(*) as id_pengampu FROM tmdb WHERE id_pengampu='$id_pengampu'");
        $count_data=mysqli_fetch_assoc($select_count);
        $data= $count_data['id_pengampu'];
         $date = date('Y-m-d H:i:s');

		mysqli_query($con, "UPDATE tmds SET jctm = '$data', updated = '$date' WHERE id_pengampu = '$id_pengampu'") or die(mysqli_error($con));
		echo "<script>alert('Data berhasil di inputkan!');window.location='data.php';</script>";

	} elseif (isset($_POST['edit'])) {
		$id = $_POST['id_tmdb'];
		$id_pengampu = trim(mysqli_real_escape_string($con,$_POST['id_pengampu']));
		$id_matkul = trim(mysqli_real_escape_string($con, $_POST['id_matkul']));
		$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
		$select=mysqli_query($con, "select id_dosen from dosen where nama_dosen='$nama'");
        			while($row=mysqli_fetch_array($select))
        			{$id_dosen= $row['id_dosen'];}
		$id_ta = trim(mysqli_real_escape_string($con, $_POST['id_ta']));
		$kd_prodi = trim(mysqli_real_escape_string($con, $_POST['kd_prodi']));
		$tgl = trim(mysqli_real_escape_string($con, $_POST['tgl']));
		$sql = mysqli_query($con, "UPDATE tmdb SET id_pengampu = '$id_pengampu', id_matkul ='$id_matkul', id_dosen ='$id_dosen',
				tanggal ='$tgl', kd_prodi ='$kd_prodi', id_ta ='$id_ta' WHERE id_tmdb ='$id'")or die(mysqli_error($con));
		echo "<script>window.location='data.php';</script>";
		
		// upload data exel to directori app
	// } elseif (isset($_POST['import'])) {
	// 	$file = $_FILES['file']['name'];
	// 	$ekstensi = explode(".", $file);
	// 	$file_name = "file_".round(microtime(true)).".".end($ekstensi);
	// 	$sumber = $_FILES['file']['tmp_name'];
	// 	$target_dir = "../_file/";
	// 	$target_file = $target_dir.$file_name;
	// 	move_uploaded_file($sumber, $target_file);
		
	// 	$obj = PHPExcel_IOFactory::load($target_file);
	// 	$all_data = $obj->getActiveSheet()->toArray(null, true, true, true);

	// 	$sql = "INSERT INTO tb_pasien (id_pasien, no_identitas, nama_pasien, jenis_kelamin, alamat, no_telp) VALUES"; //sql1
	// 	for ($i=3; $i <= count($all_data); $i++) { 
	// 	$uuid = Uuid::uuid4()->toString();
	// 	$no_id = $all_data[$i]['A'];
	// 	$nama = $all_data[$i]['B'];
	// 	$jk = $all_data[$i]['C'];
	// 	$alamat = $all_data[$i]['D'];
	// 	$telp = $all_data[$i]['E'];	
	// 	$sql .= " ('$uuid', '$no_id', '$nama', '$jk', '$alamat', '$telp'),"; //sql2
	// 	}
	// 	$sql = substr($sql, 0, -1); //menggabungkan script $sql 1 dan $sql 2
	// 	// echo $sql;
	// 	mysqli_query($con, $sql) or die (mysqli_error($con));
	// 	unlink($target_file); //unlink atau hapus file
	// 	echo "<script>window.location='data.php';</script>";
	}

	if(isset($_POST["data_id"])){
	$data_id = $_POST["data_id"];
	echo $data_id;
}
?> 