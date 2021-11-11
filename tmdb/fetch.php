<?php
if(isset($_POST['get_option']))
{
 $host = 'localhost';
 $user = 'root';
 $pass = '';
 $db   = 'dbasekp';
 $conn = mysqli_connect($host, $user, $pass, $db);


 $state = $_POST['get_option'];

 $find=mysqli_query($conn, "select pengampu1,pengampu2 from pengampu_matkul where matakuliah='$state'");
 while($row=mysqli_fetch_array($find))
 {
  echo "<option>".$row['nama_dosen1']."</option>";
  echo "<option>".$row['nama_dosen2']."</option>";
 }
 exit;
}
?>