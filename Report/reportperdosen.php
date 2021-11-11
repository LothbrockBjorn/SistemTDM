<?php
require('../fpdf_library/fpdf.php');
require_once"../_config/config.php";

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$tgl_a = $_POST['tgl_a'];
$tgl_b = $_POST['tgl_b'];
$prodi = $_POST['prodi'];
$ta = $_POST['ta'];

$sql = mysqli_query($con, "SELECT * from prodi WHERE nama_prodi = '$prodi'");
$dataprodi = mysqli_fetch_array($sql);
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(163,8,'Lampiran:  Laporan Jumlah Kegiatan Tatap Muka Dosen Program Studi Magister (S2)',0,0);
$pdf->Cell(40,8,$dataprodi['nama_prodi'],0,1);//prodi
$pdf->Cell(25,8,'',0,0);
$pdf->Cell(110,8,'Program Pascasarjana Universitas Islam Riau Semester',0,0);
$pdf->Cell(60,8,$ta,0,1);//semester ta
$pdf->Cell(130,8,'Periode Tanggal : Dari ',0,0,'R');
$pdf->Cell(23,8,$tgl_a,0,0);//bulan periode
$pdf->Cell(16,8,'Sampai',0,0);//bulan periode
$pdf->Cell(23,8,$tgl_b,0,1);//bulan periode
$pdf->Cell(276,8,'',0,1);
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(10,8,'No',1,0,'C');
$pdf->Cell(50,8,'Nama Dosen',1,0,'C');
$pdf->Cell(30,8,'Pendidikan',1,0,'C');
$pdf->Cell(25,8,'Jabatan',1,0,'C');
$pdf->Cell(60,8,'Matakuliah',1,0,'C');
$pdf->Cell(13,8,'JTM',1,1,'C');
$pdf->SetFont('Helvetica','',12);

//seleksi data 

	require "../assets/libs/vendor/autoload.php";

	use Ramsey\Uuid\Uuid;
	use Ramsey\Uuid\Exception\UnstatisfiedDependencyException;

$no=1;
$sql= mysqli_query($con, "SELECT * FROM pengampu_matkul JOIN matkul ON pengampu_matkul.id_matkul=matkul.id_matkul JOIN dosen ON pengampu_matkul.id_dosen1=dosen.id_dosen WHERE pengampu_matkul.kd_prodi='$dataprodi[kd_prodi]' AND ta='$ta' GROUP BY (pengampu_matkul.id_matkul)")or die(mysqli_error($con));

while ($data = mysqli_fetch_array($sql)) {
	$dataid_dsn1 = $data['id_dosen'];
	$datapengampu = $data['id_pengampu'];
	$nama_dosen1=$data['nama_dosen1'];
	$nama_matkul=$data['nama_matkul'];
	$dsn2 = $data['nama_dosen2'];
	//Select jumlah tatap muka untuk dosen 1
$select_count=mysqli_query($con, "SELECT COUNT(*) as id_pengampu FROM tmdb WHERE id_dosen='$dataid_dsn1' And id_pengampu='$datapengampu' AND tanggal BETWEEN '$tgl_a' AND '$tgl_b'")or die (mysqli_error($con));
        $count_data=mysqli_fetch_assoc($select_count);
        $datajtm= $count_data['id_pengampu'];
        // insert ke db untuk menghitung jumlah tatap muka dosen1
  //       $uuid1 = Uuid::uuid4()->toString();
		// $sql = mysqli_query($con, "INSERT INTO jtmperdsn (id_jtmperdsn, nama_dosen, jtm, ta, prodi, matkul) VALUES ('$uuid1','$nama_dosen1','$datajtm','$ta','$prodi','$nama_matkul')")or die(mysqli_error($con));

		//Select info dosen 2
$sqldsn= mysqli_query($con, "SELECT * FROM dosen WHERE nama_dosen ='$dsn2'")or die(mysqli_error($con));
$datadsn2 = mysqli_fetch_array($sqldsn);
$dataid_dsn2 = $datadsn2['id_dosen'];
//Count data jumlah tatap muka dosen 2
$select_count=mysqli_query($con, "SELECT COUNT(*) as id_pengampu FROM tmdb WHERE id_dosen='$dataid_dsn2' And id_pengampu='$datapengampu' AND tanggal BETWEEN '$tgl_a' AND '$tgl_b'")or die (mysqli_error($con));
        $count_data=mysqli_fetch_assoc($select_count);
        $datajtm2= $count_data['id_pengampu'];
        // insert ke db untuk menghitung jumlah tatap muka dosen2
  //       $uuid2 = Uuid::uuid4()->toString();
		// $sql = mysqli_query($con, "INSERT INTO jtmperdsn (id_jtmperdsn, nama_dosen, jtm, ta, prodi, matkul) VALUES ('$uuid2','$dsn2','$datajtm2','$ta','$prodi','$nama_matkul')")or die(mysqli_error($con));

//content
$pdf->Cell(10,7,$no,1,0);
$pdf->Cell(50,7,$data['nama_dosen1'],1,0);
$pdf->Cell(30,7,$data['pendidikan'],1,0);
$pdf->Cell(25,7,$data['jabatan'],1,0);
$pdf->Cell(60,7,$data['nama_matkul'],1,0);
$pdf->Cell(13,7,$datajtm,1,1,'C');
$no++;
$pdf->Cell(10,7,$no,1,0);
$pdf->Cell(50,7,$data['nama_dosen2'],1,0);
$pdf->Cell(30,7,$datadsn2['pendidikan'],1,0);
$pdf->Cell(25,7,$datadsn2['jabatan'],1,0);
$pdf->Cell(60,7,$data['nama_matkul'],1,0);
$pdf->Cell(13,7,$datajtm2,1,1,'C');
$no++;
}


$pdf->Cell(50,10,'',0,1);
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(40,10,'Total Tatap Muka Per Dosen',0,1);
$pdf->Cell(10,7,'No',1,0);
$pdf->Cell(80,7,'Nama Dosen',1,0);
$pdf->Cell(40,7,'Total Tatap Muka',1,1);
$pdf->SetFont('Helvetica','',12);
$not=1;
$sql= mysqli_query($con, "SELECT * FROM tmdb JOIN dosen ON tmdb.id_dosen=dosen.id_dosen WHERE kd_prodi ='$dataprodi[kd_prodi]' AND ta ='$ta' AND tanggal BETWEEN '$tgl_a' AND '$tgl_b' GROUP BY tmdb.id_dosen")or die(mysqli_error($con));
while ($datattl = mysqli_fetch_array($sql)) {
	$datattliddsn=$datattl['id_dosen'];
	$select_count=mysqli_query($con, "SELECT COUNT(*) as id_pengampu FROM tmdb WHERE id_dosen='$datattliddsn' And kd_prodi ='$dataprodi[kd_prodi]' AND ta ='$ta' AND tanggal BETWEEN '$tgl_a' AND '$tgl_b'")or die (mysqli_error($con));
        $count_data = mysqli_fetch_assoc($select_count);
        $datattltm = $count_data['id_pengampu'];
	$pdf->Cell(10,7,$not,1,0);
	$pdf->Cell(80,7,$datattl['nama_dosen'],1,0);
	$pdf->Cell(40,7,$datattltm,1,1,'C');
	$not++;
}




$pdf->Output();
?>