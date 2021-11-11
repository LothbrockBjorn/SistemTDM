<?php
include_once('../_header.php');
require_once"../_config/config.php";

if (isset($_SESSION['lvl_prodi']) != '') {
$lvl_prodi=$_SESSION['lvl_prodi'];
$sqlsesi= mysqli_query($con, "SELECT * FROM prodi WHERE lvl_prodi = '$lvl_prodi'");
$datasesi= mysqli_fetch_array($sqlsesi);
$kd_prodi= $datasesi['kd_prodi'];

$select = mysqli_query($con, "SELECT * FROM ta WHERE status = 'Aktif'"); 
$data = mysqli_fetch_array($select);
$ta = $data['nama_ta'];
$id_ta = $data['id_ta'];
// echo $id_ta;
// echo $kd_prodi;

$select_count=mysqli_query($con, "SELECT COUNT(*) as id_tmdb FROM tmdb WHERE id_ta = '$id_ta' AND kd_prodi = '$kd_prodi'");
$count_data=mysqli_fetch_assoc($select_count);
$data= $count_data['id_tmdb'];
// echo $data;

$select_count1=mysqli_query($con, "SELECT COUNT(*) as id_tmdb FROM tmds WHERE id_ta = '$id_ta' AND kd_prodi = '$kd_prodi'");
$count_data1=mysqli_fetch_assoc($select_count1);
$datatmds= $count_data1['id_tmdb'];
// echo $datatmds;

}else{

$select = mysqli_query($con, "SELECT * FROM ta WHERE status = 'Aktif'"); 
$data = mysqli_fetch_array($select);
$ta = $data['nama_ta'];
$id_ta = $data['id_ta'];

$select_count=mysqli_query($con, "SELECT COUNT(*) as id_tmdb FROM tmdb WHERE id_ta = '$id_ta'");
$count_data=mysqli_fetch_assoc($select_count);
$data= $count_data['id_tmdb'];
// echo $data;

$select_count1=mysqli_query($con, "SELECT COUNT(*) as id_tmdb FROM tmds WHERE id_ta = '$id_ta'");
$count_data1=mysqli_fetch_assoc($select_count1);
$datatmds= $count_data1['id_tmdb'];
// echo $datatmds;

}
?>
  	<div class="row">
        <div class="col-lg-12">
        	<div class="pull-right">
                <!-- <?php 
            if ($_SESSION['level']== 3 ){?>
            <a href="tambahprodi.php" class="btn btn-warning"><i class="glyphicon glyphicon-plus"></i> Tambah Prodi</a>
                <?php } ?> -->
            <a href="user.php" class="btn btn-default"><i class="glyphicon glyphicon-user"></i></a>
            <style type="text/css">
                .pull-right a{
                    transition: 0.3s;
                    border: 1.9px solid #322F2D;
                    border-radius: 5px;
                }
                .pull-right a:hover{
                    background-color: #e28743;
                    border: 1.9px solid #e28743;
                    /*background-position: center;*/
                }
            </style>
        	</div>
            <h1>Dashboard</h1>
        	
            <p>Selamat datang <mark><?=$_SESSION['user'];?></mark>di Aplikasi sistem TMD ( Tatapmuka dosen )</p>
            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>

            
                <div class="container" style="width: 100%;display: flex;justify-content: flex-start;align-items: center;flex-wrap: wrap;margin-top: 20px;">
                    <div class="serviceBx" style="background-color: #ba671e">
                        <div>
                        <div class="space">
                            <img src="icon2.png">
                            <h2>Tahun Ajar</h2>
                        </div>
                        
                            <h1 style="display:flex; align-items: flex-end; justify-content: flex-end;font-size: 50px;color: #fff"><?=$ta?>
                        </div>
                    </div>

                    <div class="serviceBx" style="background-color: #0c5585">
                        <div>
                        <div class="space">
                            <img src="chat.png">
                            <h2>Data Tatap muka</h2>
                        </div>
                            <h1 style="display:flex; align-items: flex-end; justify-content: flex-end;margin-top: -20px;font-size: 50px;color: #000"><?=$data ?><p style="font-size: 30px;margin-left: 3px;color: white;"> data</p></h1>
                            <a href="../tmdb/data.php" class="btn btn-primary" style="float: right">View More</a>
                        </div>
                    </div>

                        <div class="serviceBx" style="background-color: #184d18;">
                        <div>
                        <div class="space">
                            <img src="book.png">
                            <h2>TMD/Matakuliah</h2>
                        </div>
                        <h1 style="display:flex; align-items: flex-end; justify-content: flex-end;margin-top: -20px;font-size: 50px;color: #000"><?=$datatmds?> <p style="font-size: 30px;margin-left: 3px;color: white;"> data</p></h1>
                            <a href="../tmds/data.php" class="btn btn-success" style="float: right;">View More</a>
                        </div>
                    </div>
                </div>

<style type="text/css">
.container .serviceBx
{
    position: relative;
    /*background: #000;*/
    width: 300px;
    height: 220px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: 30px;
    border-radius: 7px;
}
.container .serviceBx .space{
    display: flex;
    justify-content: flex-start;
    align-items: center;
}
.container .serviceBx .space img
{
    max-width: 100px;
}
.container .serviceBx h2
{
    color: white;
    font-size: 20px;
    font-weight: 500;
    letter-spacing: 1px;
    /*background: white;*/
}
.container .serviceBx btn::hover{
    background-color: white;
    color: black;
}
</style>
    
<?php
include_once('../_footer.php');
?>