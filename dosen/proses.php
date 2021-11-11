<?php
	require_once"../_config/config.php";
	require "../assets/libs/vendor/autoload.php";

	use Ramsey\Uuid\Uuid;
	use Ramsey\Uuid\Exception\UnstatisfiedDependencyException;

	if (isset($_POST['add'])) {
		// $uuid = Uuid::uuid4()->toString();
		$id = trim(mysqli_real_escape_string($con, $_POST['id']));
		$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
		$jabatan = trim(mysqli_real_escape_string($con, $_POST['jabatan']));
		$pendidikan = trim(mysqli_real_escape_string($con, $_POST['pendidikan']));
		$telp = trim(mysqli_real_escape_string($con, $_POST['telp']));
		mysqli_query($con, "INSERT INTO dosen (id_dosen, nama_dosen, jabatan, pendidikan, no_telp) VALUES ('$id','$nama','$jabatan','$pendidikan','$telp')")or die(mysqli_error($con));
		echo "<script>alert('Data dosen berhasil di tambahkan');window.location='data.php';</script>";
	} elseif (isset($_POST['edit'])) {
		$id = $_POST['id'];
		$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
		$jabatan = trim(mysqli_real_escape_string($con, $_POST['jabatan']));
		$pendidikan = trim(mysqli_real_escape_string($con, $_POST['pendidikan']));
		$telp = trim(mysqli_real_escape_string($con, $_POST['telp']));
		mysqli_query($con, "UPDATE dosen SET nama_dosen = '$nama', jabatan ='$jabatan', pendidikan ='$pendidikan', no_telp = '$telp'  WHERE id_dosen = '$id'") or die(mysqli_error($con));
		echo "<script>window.location='data.php';</script>";
	}
?> 