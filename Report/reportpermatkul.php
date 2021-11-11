	<?php
require('../fpdf_library/fpdf.php');
require_once"../_config/config.php";
$prodi=$_POST['prodi'];
$ta = $_POST['ta'];
// $sem = $_POST['sem'];
$now = date('d-m-Y');

$sqlta= mysqli_query($con, "SELECT * FROM ta WHERE id_ta = '$ta'");
$datata= mysqli_fetch_array($sqlta);
$nama_ta= $datata['nama_ta'];
$sem= $datata['sem'];

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('times','B',18);
$pdf->Image('img/logo.png',40,5,-300);
$pdf->Cell(70,10,'');
$pdf->Cell(95,8,' UNVERSITAS ISLAM RIAU',0,0);
$pdf->SetFont('times','',14);
$pdf->Cell(40,8,' No Dokumen     : ',0,0);
$pdf->Cell(60,8,'',0,1);
$pdf->Cell(70,8,'');
$pdf->Cell(95,8,' Jalan Kaharudin Nasution 113 Pekanbaru',0,0);
$pdf->Cell(40,8,' Tanggal Terbit   : ',0,0);
$pdf->Cell(60,8,$now,0,1);
$pdf->Cell(70,8,'');
$pdf->SetFont('times','B',16);
$pdf->Cell(95,10,' FORMULIR',0,0);
$pdf->SetFont('times','',14);
$pdf->Cell(40,8,' No Revisi           : ',0,0);
$pdf->Cell(60,8,'',0,1);
$pdf->Cell(70,8,'');
$pdf->SetFont('times','B',14);
$pdf->Cell(95,10,' SISTEM PENJAMIN MUTU INTERNAL',0,0);
$pdf->SetFont('times','',14);
$pdf->Cell(40,8,' Halaman             : ',0,0);
$pdf->Cell(60,8,'',0,1);
$pdf->SetFont('Helvetica','B',18);
$pdf->Cell(276,14,'FORMULIR MONITORING TATAP MUKA PER MATA KULIAH',0,1,'C');
$pdf->Image('img/logo.png',20,55,-470);
$pdf->SetFont('Helvetica','B',14);
$pdf->Cell(276,7,'PROGRAM PASCASARJANA',0,1,'C');
$pdf->Cell(85,7,'',0,0,'C');
$pdf->Cell(70,7,'PROGRAM STUDI MAGISTER',0,0,'C');
$pdf->Cell(70,7,$prodi,0,1);
$pdf->Cell(276,7,'UNIVERSITAS ISLAM RIAU',0,1,'C');
$pdf->SetFont('times','',12);
$pdf->Cell(276,7,'Alamat: Jl. Kaharudidn Nasution No.113, Pekanbaru 28284 Riau',0,1,'C');
$pdf->Line(20,85,280,85);
$pdf->Line(80,8,270,8);
$pdf->Line(80,26,270,26);
$pdf->Line(80,43,270,43);
//line vertical1
$pdf->Line(80,43,80,8);
$pdf->Line(175,43,175,8);
// $pdf->Line(215,43,215,8);
$pdf->Line(270,43,270,8);
//line horizontal short
$pdf->Line(175,18,270,18);
$pdf->Line(175,34,270,34);
$pdf->Cell(276,4,'',0,1);
$pdf->SetFont('Helvetica','B',13);
$pdf->Cell(276,6,'TATAP MUKA PER MATA KULIAH',0,1,'C');
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(97,6,'',0,0);
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(18,6,'Periode',0,0);
// $pdf->SetFont('Helvetica','',12);
// $pdf->Cell(24,6,$_POST['tgl_a'],0,0);//tanggal mulai
// $pdf->SetFont('Helvetica','B',12);
// $pdf->Cell(10,6,'s/d',0,0);
// $pdf->SetFont('Helvetica','',12);
// $pdf->Cell(24,6,$_POST['tgl_b'],0,0);//tanggal sampai
// $pdf->SetFont('Helvetica','B',12);
$pdf->Cell(8,6,'TA',0,0);
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(22,6,$nama_ta,0,0);
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(22,6,'Semester',0,0);
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(18,6,$sem,0,1);
$pdf->Cell(60,4,'',0,1);//adjust line


$pdf->SetFont('Arial','B',10);
$pdf->Cell(8,16,'No',1,0,'C');
$pdf->Cell(44,16,'Matakuliah',1,0,'C');
$pdf->Cell(20,16,'Smt/Kelas',1,0,'C');
$pdf->Cell(10,16,'Sks',1,0,'C');
$pdf->Cell(45,16,'Nama Dosen Pengampu',1,0,'C');
//masih ada lanjutannya.
$pdf->Cell(24,8,'Jumlah Tatap',0,0,'C'); 
$pdf->Cell(84,8,'Bulan',1,0,'C'); 
$pdf->Cell(23,16,'Jumlah CTM',1,0,'C'); 
$pdf->Cell(21,16,'Sisa TM',1,0,'C'); 
$pdf->Cell(1,8,'',0,1,'C'); 
$pdf->Cell(126,8,'',0,0,'C'); 
$pdf->Cell(25,8,'Muka Ideal',0,0,'C'); 
if ($sem == 'Genap') {
	$pdf->Cell(14,8,'Jan',1,0,'C'); 
	$pdf->Cell(14,8,'Feb',1,0,'C'); 
	$pdf->Cell(14,8,'Mar',1,0,'C'); 
	$pdf->Cell(14,8,'Apr',1,0,'C'); 
	$pdf->Cell(14,8,'Mei',1,0,'C'); 
	$pdf->Cell(14,8,'Jun',1,0,'C'); 
}else if ($sem == 'Ganjil') {
	$pdf->Cell(14,8,'Jul',1,0,'C'); 
	$pdf->Cell(14,8,'Ags',1,0,'C'); 
	$pdf->Cell(14,8,'Sep',1,0,'C'); 
	$pdf->Cell(14,8,'Okt',1,0,'C'); 
	$pdf->Cell(14,8,'Nov',1,0,'C'); 
	$pdf->Cell(14,8,'Des',1,0,'C'); 
}

$pdf->Cell(46,8,'',0,1); 

//garis jtmi
$pdf->Line(113,104,163,104);
$pdf->Line(113,120,163,120);

//query
// $nama_matkul = $_POST['matakuliah'];
$no=1;

// $tgl_a = $_POST['tgl_a'];
// $tgl_b = $_POST['tgl_b'];
// $sqlmatkul = mysqli_query($con, "SELECT * FROM matkul WHERE nama_matkul = '$nama_matkul'");
//  while ($data = mysqli_fetch_array($sqlmatkul)) {
//  	$id_matkul = $data['id_matkul'];
//  }
$sqlsesi= mysqli_query($con, "SELECT * FROM prodi WHERE nama_prodi = '$prodi'");
						$datasesi= mysqli_fetch_array($sqlsesi);
						$kd_prodi= $datasesi['kd_prodi'];
$sql= mysqli_query($con, "SELECT * FROM tmds JOIN pengampu_matkul ON tmds.id_pengampu = pengampu_matkul.id_pengampu JOIN matkul ON pengampu_matkul.id_matkul = matkul.id_matkul WHERE tmds.id_ta ='$ta' AND tmds.kd_prodi='$kd_prodi' AND matkul.sem= '$sem'")or die(mysqli_error($con));
 while ($row = mysqli_fetch_array($sql)){
//content
$pdf->SetFont('Arial','',10);
$pdf->Cell(8,16,$no,1,0,'C');//nomor
$pdf->Cell(44,16,$row['nama_matkul'],1,0,'C');//matakuliah
$pdf->Cell(20,16,$row['kelas'],1,0,'C');//sem kelas
$pdf->Cell(10,16,$row['sks'],1,0,'C');//sks
$id_dosen1 = $row['id_dosen1'];
$id_dosen2 = $row['id_dosen2'];

// manggil nama dosen 1 dan 2
$sql_namadosen = mysqli_query($con, "SELECT nama_dosen from dosen where id_dosen = '$id_dosen1'")or die(mysql_error($con));
$i = mysqli_fetch_assoc($sql_namadosen);
$sql_namadosen2 = mysqli_query($con, "SELECT nama_dosen from dosen where id_dosen = '$id_dosen2'")or die(mysql_error($con));
$j = mysqli_fetch_assoc($sql_namadosen2);
// end manggil nama dosen 1 dan 2

$pdf->Cell(45,8,$i['nama_dosen'],1,0,'C');//dosen1
if ($row['sks'] == 3) {
	$jtmi1=10;
	$jtmi2=8;
}elseif($row['sks'] == 2){
	$jtmi1=8;
	$jtmi2=8;
}
$pdf->Cell(24,8,$jtmi1,1,0,'C'); //jumlah tmi dosen1


//seleksi tmd bulan perdosen untuk permatakuliah uuntuk dosen1
 	// $query_id_dosen =  mysqli_query($con, "SELECT id_dosen FROM dosen WHERE nama_dosen = '$row[nama_dosen1]'")or die(mysqli_error($con));
 	// 	$dosen = mysqli_fetch_array($query_id_dosen);
 		$id_dosen = $row['id_dosen1'];
 		$id_pengampu=$row['id_pengampu'];
if ($row['sem'] == 'Ganjil') {
	//query b1
	$sqlbulan1 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '7'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan1); 
	$jumlahb1 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb1,1,0,'C'); //b1 d1
	//query b2
	$sqlbulan2 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '8'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan2); 
	$jumlahb2 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb2,1,0,'C'); //b2 d1
	//query b3
	$sqlbulan3 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '9'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan3); 
	$jumlahb3 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb3,1,0,'C'); //b3 d1
	//query b4
	$sqlbulan4 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '10'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan4); 
	$jumlahb4 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb4,1,0,'C'); //b4 d1
	//query b5
	$sqlbulan5 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '11'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan5); 
	$jumlahb5 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb5,1,0,'C'); //b5 d1
	//query b6
	$sqlbulan6 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '12'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan6); 
	$jumlahb6 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb6,1,0,'C'); //b6 d1
	$jctm = ($jumlahb1+$jumlahb2+$jumlahb3+$jumlahb4+$jumlahb5+$jumlahb6);
	$pdf->Cell(23,8,$jctm,1,0,'C'); //jctm d1
	$stm = $jtmi1-$jctm;
$pdf->Cell(21,8,$stm,1,0,'C'); //stm d1
}elseif ($row['sem'] == 'Genap') {
	//query b1
	$sqlbulan1 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '1'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan1); 
	$jumlahb1 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb1,1,0,'C'); //b1 d1
	//query b2
	$sqlbulan2 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '2'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan2); 
	$jumlahb2 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb2,1,0,'C'); //b2 d1
	//query b3
	$sqlbulan3 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '3'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan3); 
	$jumlahb3 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb3,1,0,'C'); //b3 d1
	//query b4
	$sqlbulan4 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '4'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan4); 
	$jumlahb4 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb4,1,0,'C'); //b4 d1
	//query b5
	$sqlbulan5 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '5'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan5); 
	$jumlahb5 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb5,1,0,'C'); //b5 d1
	//query b6
	$sqlbulan6 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '6'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan6); 
	$jumlahb6 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb6,1,0,'C'); //b6 d1
	$jctm = ($jumlahb1+$jumlahb2+$jumlahb3+$jumlahb4+$jumlahb5+$jumlahb6);
	$pdf->Cell(23,8,$jctm,1,0,'C'); //jctm d1
	$stm = $jtmi1-$jctm;
	$pdf->Cell(21,8,$stm,1,0,'C'); //stm d1
	
}


$pdf->Cell(1,8,'',0,1);//end line tidak perlu di isi variablenya. 
$pdf->Cell(82,8,'',0,0);// design tidak perlu di isi variable. 
$pdf->Cell(45,8,$j['nama_dosen'],1,0,'C'); //nama dosen2
$pdf->Cell(24,8,$jtmi2,1,0,'C'); //jumlah tmi dosen2

// $query_id_dosen =  mysqli_query($con, "SELECT id_dosen FROM dosen WHERE nama_dosen = '$row[nama_dosen2]'")or die(mysqli_error($con));
//  		$dosen = mysqli_fetch_array($query_id_dosen);
 		$id_dosen = $row['id_dosen2'];
 	$id_pengampu=$row['id_pengampu'];
if ($row['sem'] == 'Ganjil') {
	//query b1
	$sqlbulan1 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '7'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan1); 
	$jumlahb1 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb1,1,0,'C'); //b1 d2
	//query b2
	$sqlbulan2 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '8'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan2); 
	$jumlahb2 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb2,1,0,'C'); //b2 d2
	//query b3
	$sqlbulan3 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '9'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan3); 
	$jumlahb3 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb3,1,0,'C'); //b3 d2
	//query b4
	$sqlbulan4 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '10'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan4); 
	$jumlahb4 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb4,1,0,'C'); //b4 d2
	//query b5
	$sqlbulan5 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '11'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan5); 
	$jumlahb5 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb5,1,0,'C'); //b5 d2
	//query b6
	$sqlbulan6 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '12'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan6); 
	$jumlahb6 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb6,1,0,'C'); //b6 d2
	$jctm = ($jumlahb1+$jumlahb2+$jumlahb3+$jumlahb4+$jumlahb5+$jumlahb6);
	$pdf->Cell(23,8,$jctm,1,0,'C'); //jctm d2
	$stm = $jtmi2-$jctm;
	$pdf->Cell(21,8,$stm,1,1,'C'); //stm d2

}elseif ($row['sem'] == 'Genap') {
	//query b1
	$sqlbulan1 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '1'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan1); 
	$jumlahb1 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb1,1,0,'C'); //b1 d2
	//query b2
	$sqlbulan2 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '2'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan2); 
	$jumlahb2 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb2,1,0,'C'); //b2 d2
	//query b3
	$sqlbulan3 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '3'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan3); 
	$jumlahb3 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb3,1,0,'C'); //b3 d2
	//query b4
	$sqlbulan4 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '4'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan4); 
	$jumlahb4 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb4,1,0,'C'); //b4 d2
	//query b5
	$sqlbulan5 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '5'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan5); 
	$jumlahb5 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb5,1,0,'C'); //b5 d2
	//query b6
	$sqlbulan6 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM tmdb WHERE id_pengampu = '$id_pengampu' AND id_dosen = '$id_dosen' AND id_ta ='$ta' AND kd_prodi='$kd_prodi' AND MONTH(tanggal) = '6'")or die(mysqli_error($con));
	$data=mysqli_fetch_array($sqlbulan6); 
	$jumlahb6 =  $data['jumlah'];
	$pdf->Cell(14,8,$jumlahb6,1,0,'C'); //b6 d2
	$jctm = ($jumlahb1+$jumlahb2+$jumlahb3+$jumlahb4+$jumlahb5+$jumlahb6);
	$pdf->Cell(23,8,$jctm,1,0,'C'); //jctm d2
	$stm = $jtmi2-$jctm;
	$pdf->Cell(21,8,$stm,1,1,'C'); //stm d2
	
}

$no++;
}

$pdf->Output();
?>