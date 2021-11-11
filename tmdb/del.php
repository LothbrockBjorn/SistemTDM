<?php
require_once"../_config/config.php";

$id = $_GET['id'];

$select_id = mysqli_query($con, "SELECT id_pengampu FROM tmdb where id_tmdb = '$id'")or die (mysqli_error($con));
$data_id = mysqli_fetch_assoc($select_id); 
$id_pengampu = $data_id['id_pengampu'];

mysqli_query($con, "DELETE FROM tmdb WHERE id_tmdb ='$id'") or die (mysqli_error($con));


//update delete pengurangan data tmds

$select_count=mysqli_query($con, "SELECT COUNT(*) as id_pengampu FROM tmdb WHERE id_pengampu='$id_pengampu'");
        $count_data=mysqli_fetch_assoc($select_count);
        $data= $count_data['id_pengampu'];
         $date = date('Y-m-d H:i:s');

		mysqli_query($con, "UPDATE tmds SET jctm = '$data', updated = '$date' WHERE id_pengampu = '$id_pengampu'") or die(mysqli_error($con));
		echo "<script>alert('Data berhasil di di hapus!');window.location='data.php';</script>";

?>