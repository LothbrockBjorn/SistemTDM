<?php
require_once "../_config/config.php";

if(isset($_SESSION['user'])){
    echo "<script>window.location='".base_url()."';</script>";
}else{
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login - Aplikasi Monitoring TM dosen</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url('/assets/css/bootstrap.min.css');?>" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <div class="container">
            <div align="center" style="margin-top: 210px;">
                <?php
                if(isset($_POST['login'])){
                $user = trim(mysqli_real_escape_string($con, $_POST['user']));
                $password = sha1(trim(mysqli_real_escape_string($con, $_POST['password'])));
                $level = trim(mysqli_real_escape_string($con, $_POST['level']));
                $sql_login = mysqli_query($con, "SELECT * FROM users WHERE username ='$user' AND password='$password'") or die (mysqli_error($con));
                    if (mysqli_num_rows($sql_login) > 0){
                        $_SESSION['user'] = $user;
                        $_SESSION['level'] = $level;
                        // seleksi level prodi
                        if ($level == 2) {
                            $lev = mysqli_fetch_assoc($sql_login);
                            $_SESSION['lvl_prodi'] = $lev['lvl_prodi'];
                        }
                        echo "<script>window.location='".base_url()."'</script>";
                    } else{?>
                        <div class="row">
                            <div class="col-lg-6 col-lg-offset-3">
                                <div class="alert alert-danger alert-dismissable" role="alert">
                                    <a href="" class="close" data-dismiss="alert" arial-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <strong>Login gagal</strong> Username / Password salah
                                </div>
                            </div>   
                        </div>
                    <?php
                    }
                }
                ?>
                <form action="" method="post" class="navbar-form">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-user"></i>
                        </span>
                        <input type="text" name="user" class="form-control" placeholder="Username" autofocus required>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-lock"></i>
                        </span>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                      <div class="input-group">
                        <span class="input-group-addon">
                        <label>Log in Sebagai User</label>
                        <select name="level" class="text-input" required>
                          <option value="">--Pilih Level User--</option>
                          <option value="1">UPM</option>
                          <option value="2">Administrator TU</option>
                          <option value="3">K.T.U</option>
                          <option value="4">Wakil Direktur</option>
                          <option value="5">Admin</option>
                        </select>
                        </span>
                        </div>
                    <div class="input-group">
                        <input type="submit" name="login" value="Login" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>  
    </div>
</body>
<script src="<?=base_url('assets/js/jquery.js')?>"></script>
<script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
</html>
<?php
}
?>