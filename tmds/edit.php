<?php
require_once"../_config/config.php";

$id = $_GET['id'];
		$select=mysqli_query($con, "SELECT * from tmds where id_tmds='$id'");
        			while($row=mysqli_fetch_array($select))
        			{
        				$id_pengampu=$row['id_pengampu'];
        				$jtmi = $row['jtmi'];
        				$ta = $row['ta'];	
        			}
        $select_count=mysqli_query($con, "SELECT COUNT(*) as id_pengampu FROM tmdb WHERE id_pengampu='$id_pengampu'");
        $count_data=mysqli_fetch_assoc($select_count);
        $data= $count_data['id_pengampu'];
        $date = date('Y-m-d H:i:s');
		mysqli_query($con, "UPDATE tmds SET jctm = '$data', updated = '$date' WHERE id_tmds = '$id'") or die(mysqli_error($con));
		echo "<script>window.location='data.php';</script>";
	?>