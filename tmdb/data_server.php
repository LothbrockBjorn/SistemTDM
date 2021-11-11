<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbasekpv2";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
$requestData= $_REQUEST;



$columns = array( 
	0 => 'nama_matkul', 
	1 => 'nama_dosen',
	2 => 'tanggal',
	3 => 'kd_prodi',
	4 => 'ta'
);

$sql = " SELECT tmdb.id_tmbd, matkul.nama_matkul, dosen.nama_dosen, tanggal, prodi.kd_prodi, ta ";
$sql.= " FROM tmdb";
$sql.= " JOIN matkul ON tmdb.id_matkul=matkul.id_matkul";
$sql.= " JOIN dosen ON tmdb.id_dosen=dosen.id_dosen";
$sql.= " JOIN prodi ON tmdb.kd_prodi=prodi.kd_prodi";
$query=mysqli_query($con, $sql) or die("data_server.php: get dataku");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;


//----------------------------------------------------------------------------------
//query sql join 2 tabel
$sql = " SELECT tmdb.id_tmbd, matkul.nama_matkul, dosen.nama_dosen, tanggal, prodi.nama_prodi, ta ";
$sql.= " FROM tmdb";
$sql.= " JOIN matkul ON tmdb.id_matkul=matkul.id_matkul";
$sql.= " JOIN dosen ON tmdb.id_dosen=dosen.id_dosen";
$sql.= " JOIN prodi ON tmdb.kd_prodi=prodi.kd_prodi";
$sql.= " WHERE 1=1";

if( !empty($requestData['search']['value']) ) {
	//----------------------------------------------------------------------------------
	$sql.=" AND ( nama_matkul LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR nama_dosen LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR ta LIKE '".$requestData['search']['value']."%' )";
	$sql.=" OR nama_prodi LIKE '".$requestData['search']['value']."%' )";
	$sql.=" OR tanggal LIKE '".$requestData['search']['value']."%' )";


//----------------------------------------------------------------------------------
$query=mysqli_query($conn, $sql) or die("data_server.php: get dataku");
$totalFiltered = mysqli_num_rows($query);
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";	
$query=mysqli_query($conn, $sql) or die("data_server.php: get dataku");

//----------------------------------------------------------------------------------
$data = array();
$i=1+$requestData['start'];//tambahan
while( $row=mysqli_fetch_array($query) ) {
	$nestedData=array(); 
	
	//tambahan
	$nestedData[] = "<input type='checkbox'  class='deleteRow' value='".$row['id_tmdb']."'  /> #".$i ;
	$nestedData[] = $row["nama_matkul"];
	$nestedData[] = $row["nama_dosen"];
	$nestedData[] = $row["tanggal"];
	$nestedData[] = $row["nama_prodi"];
	$nestedData[] = $row["ta"];
	
	$data[] = $nestedData;
	$i++;//tambahan
}
//----------------------------------------------------------------------------------
$json_data = array(
			"draw"            => intval( $requestData['draw'] ),  
			"recordsTotal"    => intval( $totalData ), 
			"recordsFiltered" => intval( $totalFiltered ), 
			"data"            => $data );
//----------------------------------------------------------------------------------
echo json_encode($json_data);
?>
