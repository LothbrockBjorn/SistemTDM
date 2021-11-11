<?php

require_once"../_config/config.php";

$id =@$_GET['id'];

$cekstatus = mysqli_query($con, "SELECT * FROM ta WHERE id_ta = '$id'")or die(mysqli_error($con));
$statusnow = mysqli_fetch_array($cekstatus);
$datastatusnow = $statusnow['status'];
if ($datastatusnow == 'Aktif') {
	$datastatusthen = 'Tidak aktif';
}else{
	$datastatusthen = 'Aktif';
}
$sql = mysqli_query($con, "UPDATE ta SET  status = '$datastatusthen'  WHERE id_ta ='$id'")or die(mysqli_error($con));
		echo "<script>window.location='data.php';</script>";
?>