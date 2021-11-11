<?php
// Koneksi Database
$host = 'localhost';
$username = 'root';
$password = '';
$Dbname = 'dbasekpv2';
$db = new mysqli($host,$username,$password,$Dbname);


$searchTerm = $_GET['term'];
$query = $db->query("SELECT * FROM dosen WHERE nama_dosen LIKE '%".$searchTerm."%' ORDER BY nama_dosen ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['nama_dosen'];
}
echo json_encode($data);
?>