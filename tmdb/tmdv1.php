<?php
session_start();
$servername = "us-cdbr-east-04.cleardb.com";
$username = "b4ee75cba9cbc3";
$password = "bc8484ff";
$dbname = "heroku_a169840466e5521";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

$requestData= $_REQUEST;


$columns = array( 
	 'nama_matkul', 
	 'nama_dosen',
	 'kelas',
	 'tanggal',
	 'nama_prodi',
	 'nama_ta',
	 'sem',
);

//----------------------------------------------------------------------------------
//join 2 tabel dan bisa lebih, tergantung kebutuhan
//seleksi untuk otoritas adp dan ktu
if (isset($_SESSION['lvl_prodi']) !='') {
    $lvl_prodi = $_SESSION['lvl_prodi'];

    $sql_prodi = "SELECT * from prodi WHERE lvl_prodi = '$lvl_prodi'";
    $dataprodi = mysqli_query($conn, $sql_prodi);
    $dtp = mysqli_fetch_array($dataprodi);
    $kd_prodi = $dtp['kd_prodi'];
	    

$sql = " SELECT * ";
$sql.= " FROM tmdb";
$sql.= " JOIN matkul ON tmdb.id_matkul=matkul.id_matkul";
$sql.= " JOIN dosen ON tmdb.id_dosen=dosen.id_dosen";
$sql.= " JOIN prodi ON tmdb.kd_prodi=prodi.kd_prodi";
$sql.= " JOIN ta ON tmdb.id_ta=ta.id_ta";
$sql.= " JOIN pengampu_matkul ON tmdb.id_pengampu=pengampu_matkul.id_pengampu";
$sql.= " WHERE ta.status = 'Aktif' AND tmdb.kd_prodi = '$kd_prodi' ";
}else{
$sql = " SELECT * ";
$sql.= " FROM tmdb";
$sql.= " JOIN matkul ON tmdb.id_matkul=matkul.id_matkul";
$sql.= " JOIN dosen ON tmdb.id_dosen=dosen.id_dosen";
$sql.= " JOIN prodi ON tmdb.kd_prodi=prodi.kd_prodi";
$sql.= " JOIN ta ON tmdb.id_ta=ta.id_ta";
$sql.= " JOIN pengampu_matkul ON tmdb.id_pengampu=pengampu_matkul.id_pengampu";
$sql.= " WHERE ta.status = 'Aktif' ";
}


$query=mysqli_query($conn, $sql) or die("data_server.php: get dataku");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;


if( !empty($requestData['search']['value']) ) {
	//----------------------------------------------------------------------------------
	$sql.=" AND ( nama_matkul LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR nama_dosen LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR tanggal LIKE '".$requestData['search']['value']."%' )";
}

//----------------------------------------------------------------------------------
$query=mysqli_query($conn, $sql) or die("data_server.php: get dataku");
$totalFiltered = mysqli_num_rows($query);
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";	
$query=mysqli_query($conn, $sql) or die("data_server.php: get dataku");
	

//----------------------------------------------------------------------------------
$data = array();
$no = 1;
while( $row=mysqli_fetch_array($query) ) {
	$nestedData=array(); 

	$nestedData[] = $no;
	$nestedData[] = $row["nama_dosen"];
	$nestedData[] = $row["nama_matkul"];
	$nestedData[] = $row["kelas"];
	$nestedData[] = $row["tanggal"];
	$nestedData[] = $row["nama_prodi"];
	$nestedData[] = $row["sem"]. ' / ' .$row["nama_ta"];
	$nestedData[] = '<center>
            <a href="edit.php?id='.$row['id_tmdb'].'" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>  
            <a href="del.php?id='.$row['id_tmdb'].'" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a></center>';  
	
	$data[] = $nestedData;
	$no++;
}
// <input type="button" name="detail" value="Detail" data-toggle="modal" data-target="#myModal" id="'.$row['id_tmdb'].'" class="btn btn-info btn-xs detail_data">
//----------------------------------------------------------------------------------
$json_data = array(
	"draw"            => intval( $requestData['draw'] ),  
	"recordsTotal"    => intval( $totalData ), 
	"recordsFiltered" => intval( $totalFiltered ), 
	"data"            => $data );
//----------------------------------------------------------------------------------
echo json_encode($json_data);
?>
