<?php
	require_once"../_config/config.php";
	require "../assets/libs/vendor/autoload.php";

	use Ramsey\Uuid\Uuid;
	use Ramsey\Uuid\Exception\UnstatisfiedDependencyException;

	if (isset($_POST['add'])) {
		// $uuid = Uuid::uuid4()->toString();
		$id = trim(mysqli_real_escape_string($con, $_POST['id']));
		$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
		$prodi = trim(mysqli_real_escape_string($con, $_POST['prodi']));
		$sks = trim(mysqli_real_escape_string($con, $_POST['sks']));
		$sem = trim(mysqli_real_escape_string($con, $_POST['sem']));

		$sql_kdprodi = mysqli_query($con, "SELECT * FROM prodi WHERE nama_prodi ='$prodi'") or die (mysqli_error($con));
		$data = mysqli_fetch_array($sql_kdprodi);

		$kd_prodi = $data['kd_prodi'];

		mysqli_query($con, "INSERT INTO matkul (id_matkul, nama_matkul, kd_prodi, sks, sem) VALUES ('$id','$nama','$kd_prodi','$sks','$sem')")or die(mysqli_error($con));
		echo "<script>alert('Data matakuliah berhasil ditambahkan');window.location='data.php';</script>";
	} elseif (isset($_POST['edit'])) {
		$id = $_POST['id'];
		$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
		$prodi = trim(mysqli_real_escape_string($con, $_POST['prodi']));
		$sks = trim(mysqli_real_escape_string($con, $_POST['sks']));
		$sem = trim(mysqli_real_escape_string($con, $_POST['sem']));

		$sql_kdprodi = mysqli_query($con, "SELECT * FROM prodi WHERE nama_prodi ='$prodi'") or die (mysqli_error($con));
		$data = mysqli_fetch_array($sql_kdprodi);

		$kd_prodi = $data['kd_prodi'];

		mysqli_query($con, "UPDATE matkul SET nama_matkul = '$nama', kd_prodi ='$kd_prodi', sks ='$sks', sem = '$sem'  WHERE id_matkul = '$id'") or die(mysqli_error($con));
		echo "<script>window.location='data.php';</script>";
	}
?> 