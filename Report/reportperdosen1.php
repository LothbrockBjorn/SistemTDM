	<?php
require('../fpdf_library/fpdf.php');
require_once"../_config/config.php";
$nama_prodi= $_POST['prodi'];
$sql_getprodi =  mysqli_query($con, "SELECT * FROM prodi WHERE nama_prodi = '$nama_prodi'")or die (mysqli_error($con));
$dataprodi = mysqli_fetch_assoc($sql_getprodi);
$kd_prodi = $dataprodi['kd_prodi'];
$ta = $_POST['ta'];
$sql_getsem =  mysqli_query($con, "SELECT * FROM ta WHERE id_ta = '$ta'")or die (mysqli_error($con));
$datasem = mysqli_fetch_assoc($sql_getsem);
$nama_ta = $datasem['nama_ta'];
$datasem = $datasem['sem'];
$tgl_a = $_POST['tgl_a'];
$tgl_b = $_POST['tgl_b'];
$now = date('d-m-Y');

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
$pdf->Cell(95,10,' LAPORAN',0,0);
$pdf->SetFont('times','',14);
$pdf->Cell(40,8,' Program Studi    : ',0,0);
$pdf->Cell(60,8,$nama_prodi,0,1);
$pdf->Cell(70,8,'');
$pdf->SetFont('times','',14);
$pdf->Cell(95,8,' Jumlah Kegiatan Tatap Muka Dosen',0,0);
$pdf->SetFont('times','',14);
$pdf->Cell(30,8,' Dari tanggal : ',0,0);
$pdf->Cell(25,8, $tgl_a,0,0);
$pdf->Cell(12,8,' S/D ',0,0);
$pdf->Cell(25,8,$tgl_b,0,1);
$pdf->SetFont('Helvetica','B',14);
$pdf->Cell(276,4,'',0,1,'C');
$pdf->Cell(276,8,'LAMPIRAN : LAPORAN JUMLAH KEGIATAN TATAP MUKA DOSEN ',0,1,'C');
$pdf->SetFont('Helvetica','B',14);
$pdf->Cell(276,8,'PROGRAM PASCASARJANA UNIVERSITAS ISLAM RIAU',0,1,'C');
$pdf->Cell(140,8,'SEMESTER ',0,0,'R');
$pdf->Cell(17,7,$datasem,0,0);
$pdf->Cell(5,7,' / ',0,0,'L');
$pdf->Cell(0,7,$nama_ta,0,1,'L');
$pdf->SetFont('times','',12);
$pdf->Cell(276,7,'Alamat: Jl. Kaharudidn Nasution No.113, Pekanbaru 28284 Riau',0,1,'C');
$pdf->Line(20,76,280,76);
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
// line nomor
$pdf->Line(175,18,270,18);


$pdf->Cell(8,5,'',0,1,'C');
//content table...
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,8,'No',1,0,'C');
$pdf->Cell(70,8,'Nama Dosen',1,0,'C');
$pdf->Cell(25,8,'Pendidikan',1,0,'C');
$pdf->Cell(45,8,'Jabatan',1,0,'C');
$pdf->Cell(70,8,'Matakuliah',1,0,'C');
$pdf->Cell(17,8,'Sks',1,0,'C'); 
$pdf->Cell(40,8,'Jumlah Tatap muka',1,1,'C'); 

// untuk garis vertical untuk halaman pertama dengan header
$tika = 89;
$tikb = 97;
//set awal titik garis vertical dengan halaman tanpa header
$tikav2 = 10;
$tikbv2 = 18;
//mendefinisikan value page berguna untuk parameter titik kordinat garis vertikal
$page = 2;		
$no=1;

$sql_get_namadosen = mysqli_query($con, "SELECT * FROM tmdb join matkul on tmdb.id_matkul = matkul.id_matkul join dosen on tmdb.id_dosen = dosen.id_dosen WHERE tmdb.id_ta = '$ta' AND tmdb.kd_prodi = '$kd_prodi' AND tanggal BETWEEN '$tgl_a' AND '$tgl_b' group by (tmdb.id_dosen)")or die (mysqli_error($con));

// perulangan pertama
while ($data = mysqli_fetch_array($sql_get_namadosen)){
$pdf->Cell(10,8,$no,0,0,'C');
$pdf->Cell(70,8,$data['nama_dosen'],0,0,'C');
$pdf->Cell(25,8,$data['pendidikan'],0,0,'C');
$pdf->Cell(45,8,$data['jabatan'],0,0,'C');

$sql_matkul = mysqli_query($con , "SELECT * FROM tmdb join matkul on tmdb.id_matkul = matkul.id_matkul JOIN ta ON tmdb.id_ta = ta.id_ta WHERE tmdb.kd_prodi = '$kd_prodi' AND ta.status = 'Aktif' AND id_dosen = '$data[id_dosen]' AND tanggal BETWEEN '$tgl_a' AND '$tgl_b' group by (tmdb.id_matkul)")or die(mysqli_error($con));

$jk = 1;

$totaldata = mysqli_num_rows($sql_matkul);

// perulangan kedua jika 1 dosen memiliki lebih 1 matakuliah....
while ($data_matkul = mysqli_fetch_array($sql_matkul)){
	 
	 //untuk jika matakuliah yang di ampu sama dengan 1
		if (mysqli_num_rows($sql_matkul) == 1) {
			$pdf->Cell(70,8,$data_matkul['nama_matkul'],1,0,'C');
			$pdf->Cell(17,8,$data['sks'],1,0,'C'); 
			// $pdf->Cell(17,8,$tiktb,1,0,'C'); 
			//select count data jtm
			$sql_jtm = mysqli_query($con , "SELECT count(*) As jtm FROM tmdb where id_matkul = '$data_matkul[id_matkul]' and id_dosen = '$data[id_dosen]' and id_ta ='$ta' ")or die(mysqli_error($con));
			$data_jtm = mysqli_fetch_assoc($sql_jtm);
			$pdf->Cell(40,8,$data_jtm['jtm'],1,1,'C'); 
			if ($pdf->pageNo() == 1) {
				$pdf->Line(10,$tika,10,$tikb);
				$pdf->Line(20,$tika,20,$tikb);
				$pdf->Line(90,$tika,90,$tikb);
				$pdf->Line(115,$tika,115,$tikb);
			}elseif ($pdf->pageNo() > 1) { 
			
				$pdf->Line(10,$tikav2,10,$tikbv2);
				$pdf->Line(20,$tikav2,20,$tikbv2);
				$pdf->Line(90,$tikav2,90,$tikbv2);
				$pdf->Line(115,$tikav2,115,$tikbv2);
		}
		}
		else if(mysqli_num_rows($sql_matkul) > 1){
			if ($jk > 1) {
					//memberikan space dari nomor ke matakuliah jika matkul yang di ampu lebih dari 1
					$pdf->Cell(150,8,'',0,0,'C');
				}					
				$pdf->Cell(70,8,$data_matkul['nama_matkul'],1,0,'C');
				$pdf->Cell(17,8,$data['sks'],1,0,'C'); 	
				// $pdf->Cell(17,8,$tikav2,1,0,'C'); 	
				//select count data jtm
				$sql_jtm = mysqli_query($con , "SELECT count(*) As jtm FROM tmdb where id_matkul = '$data_matkul[id_matkul]' and id_dosen = '$data[id_dosen]' and id_ta ='$ta' ")or die(mysqli_error($con));
				$data_jtm = mysqli_fetch_assoc($sql_jtm);
				$pdf->Cell(40,8,$data_jtm['jtm'],1,1,'C'); 
				// $pdf->Cell(40,8,$tikb,1,1,'C'); 
				// $pdf->Cell(8,1,$pdf->PageNo(),1,0,'C'); 
				//vertical line untuk matakuliah yang lebih dari 1
					if ($pdf->PageNo() == 1){
						$pdf->Line(10,$tika,10,$tikb);
						$pdf->Line(20,$tika,20,$tikb);
						$pdf->Line(90,$tika,90,$tikb);
						$pdf->Line(115,$tika,115,$tikb);
					}	
					else if ($pdf->PageNo() > 1){  
						if ($pdf->PageNo() != $page){ //perlu perbaikan untuk new value titik kordinat garis halaman baru
							$tikav2 = 10;
							$tikbv2 = 18;
						}
						$pdf->Line(10,$tikav2,10,$tikbv2);
						$pdf->Line(20,$tikav2,20,$tikbv2);
						$pdf->Line(90,$tikav2,90,$tikbv2);
						$pdf->Line(115,$tikav2,115,$tikbv2);
						
					}

					$page = $pdf->pageNo();
		}
			//penambahan nilai untuk titik
			$tika = $tika+8;
			$tikb = $tikb+8;

			$tikav2 = $tikav2+8;
			$tikbv2 = $tikbv2+8;

			$jk++;
		}

		//akhir looping matakuiah

		if ($pdf->PageNo() == 1){
		$tiktb = $tika;
		}
		if ($pdf->PageNo() > 1){
		$pdf->Line(10,10,160,10);
		$tiktb = $tikav2;
		}
		//horizontal line
		$pdf->Line(10,$tiktb,160,$tiktb);
	
	$no++;
}


//garis jtmi
// $pdf->Line(137,81,161,81);
// $pdf->Line(137,97,161,97);

//end conten table...

$pdf->Output();
?>