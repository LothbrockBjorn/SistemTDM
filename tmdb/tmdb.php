<?php
session_start();
// memanggil file config.php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'dbasekpv2';

// koneksi ke database
$database = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($database->connect_error) {
    die('Oops!! database Not Connect : ' . $database->connect_error);
}

// Alternative SQL join in Datatables
$id_table = 'id_tmdb';

$columns = array(
             'nama_matkul',
             // 'kelas',
             'nama_dosen',
             'tanggal',
             'nama_prodi',
             'id_ta',
             'sem'
           );
// gunakan join disini
if (isset($_SESSION['lvl_prodi']) !='') {
    $lvl_prodi = $_SESSION['lvl_prodi'];

    $sql_prodi = "SELECT * from prodi WHERE lvl_prodi = '$lvl_prodi'";
    $dataprodi = $database->query($sql_prodi);
    $dtp = mysqli_fetch_array($dataprodi);
    $kd_prodi = $dtp['kd_prodi'];
    //untuk per administrasi prodi
$from = "tmdb T INNER JOIN matkul M ON T.id_matkul = M.id_matkul INNER JOIN dosen D ON T.id_dosen = D.id_dosen INNER JOIN prodi P ON T.kd_prodi = P.kd_prodi WHERE T.kd_prodi = '$kd_prodi'";
}else{
    //untuk get data semua prodi
$from = "tmdb T INNER JOIN matkul M ON T.id_matkul = M.id_matkul INNER JOIN dosen D ON T.id_dosen = D.id_dosen";
// $from.= "JOIN pengampu_matkul E ON T.id_pengampu = E.id_pengampu";
// $from.= " INNER JOIN ta ON T.id_ta = ta.id_ta";
$from.= " INNER JOIN prodi P ON T.kd_prodi = P.kd_prodi";
// 
// INNER JOIN pengampu_matkul E ON T.id_pengampu = E.id_pengampu
}
$id_table = $id_table != '' ? $id_table . ',' : '';
// custom SQL
$sql = "SELECT {$id_table} ".implode(',', $columns)." FROM {$from}";

// search
if (isset($_SESSION['lvl_prodi']) != '') {

    $lvl_prodi = $_SESSION['lvl_prodi'];

    $sql_prodi = "SELECT * from prodi WHERE lvl_prodi = '$lvl_prodi'";
    $dataprodi = $database->query($sql_prodi);
    $dtp = mysqli_fetch_array($dataprodi);
    $kd_prodi = $dtp['kd_prodi'];

    if (isset($_GET['search']['value']) && $_GET['search']['value'] != '') {
    $search = $_GET['search']['value'];
    $where  = '';
    $kondisi = '';
    // create parameter pencarian kesemua kolom yang tertulis
    // di $columns
    for ($i=0; $i < count($columns); $i++) {
        // $kondisi .= "T.kd_prodi = '$kd_prodi'";
        $where .= 'T.kd_prodi = "'.$kd_prodi.'" AND ' . $columns[$i] . ' LIKE "%'.$search.'%"';
        // agar tidak menambahkan 'OR' diakhir Looping
        if ($i < count($columns)-1) {
            $where .= ' OR ';
        }
    }

    $sql .= ' AND ' . $where;
}

}else{

   if (isset($_GET['search']['value']) && $_GET['search']['value'] != '') {
    $search = $_GET['search']['value'];
    $where  = '';
    // create parameter pencarian kesemua kolom yang tertulis
    // di $columns
    for ($i=0; $i < count($columns); $i++) {
        $where .= $columns[$i] . ' LIKE "%'.$search.'%"';

        // agar tidak menambahkan 'OR' diakhir Looping
        if ($i < count($columns)-1) {
            $where .= ' OR ';
        }
    }

    $sql .= ' WHERE ' . $where;
} 
}



//SORT Kolom
$sortColumn = isset($_GET['order'][0]['column']) ? $_GET['order'][0]['column'] : 0;
$sortDir    = isset($_GET['order'][0]['dir']) ? $_GET['order'][0]['dir'] : 'asc';

$sortColumn = $columns[$sortColumn];

$sql .= " ORDER BY {$sortColumn} {$sortDir}";

// var_dump($sql);
$count = $database->query($sql);
// hitung semua data
$totaldata = $count->num_rows;

$count->close();

// memberi Limit
$start  = isset($_GET['start']) ? $_GET['start'] : 0;
$length = isset($_GET['length']) ? $_GET['length'] : 10;


$sql .= " LIMIT {$start}, {$length}";

$data  = $database->query($sql);

// create json format
$datatable['draw']            = isset($_GET['draw']) ? $_GET['draw'] : 1;
$datatable['recordsTotal']    = $totaldata;
$datatable['recordsFiltered'] = $totaldata;
$datatable['data']            = array();

while ($row = $data->fetch_assoc()) {

    $fields = array();
    for ($i=0; $i < count($columns); $i++) {
        # code...
        // $fields[] = $row["{$columns[$i]}"];
        $fields[] = $row['nama_matkul'];
        // $fields[] = $row['kelas'];
        $fields[] = $row['nama_dosen'];
        $fields[] = $row['tanggal'];
        $fields[] = $row['nama_prodi'];
        $fields[] = $row['id_ta'];
        $fields[] = $row['sem'];
        $fields[] = '<center>
        <a href="modal.php?id='.$row['id_tmdb'].'" data-toggle="modal" data-target="#modalpreview" data-backdrop="static" data-keyboard="false" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="edit.php?id='.$row['id_tmdb'].'" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>  
            <a href="del.php?id='.$row['id_tmdb'].'" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a></center>';  
    }
    

    $datatable['data'][] = $fields;
}

$data->close();
echo json_encode($datatable); 
    