<?php
// Koneksi Database
$host = 'localhost';
$username = 'root';
$password = '';
$Dbname = 'dbasekpv2';
$db = new mysqli($host,$username,$password,$Dbname);

// cari dan tampilkan data ke AutoComplete
$searchTerm = $_GET['term'];
$query = $db->query("SELECT * FROM matkul WHERE nama_matkul LIKE '%".$searchTerm."%' ORDER BY nama_matkul ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['nama_matkul'];
}
echo json_encode($data);
?>