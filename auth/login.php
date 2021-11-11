<?php
require_once "../_config/config.php";

if(isset($_SESSION['user'])){
    echo "<script>window.location='".base_url()."';</script>";
}else{
?>

<!DOCTYPE html>
<html>
<head>  
	<title>Login STMD</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
   <?php
    if(isset($_POST['login'])){
      $user = trim(mysqli_real_escape_string($con, $_POST['user']));
      $password = sha1(trim(mysqli_real_escape_string($con, $_POST['password'])));
      $level = trim(mysqli_real_escape_string($con, $_POST['level']));
      $sql_login = mysqli_query($con, "SELECT * FROM users WHERE username ='$user' AND password='$password' AND level='$level'") or die (mysqli_error($con));
          if (mysqli_num_rows($sql_login) > 0){
              $_SESSION['user'] = $user;
              $_SESSION['level'] = $level;
              // seleksi level prodi
              if ($_SESSION['level'] == '2') {
                  $lev = mysqli_fetch_assoc($sql_login);
                  $_SESSION['lvl_prodi'] = $lev['lvl_prodi'];
              }else{
                $_SESSION['lvl_prodi'] = null;
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
	<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="img/Logo.png" style="width :50%; display: flex; justify-content: flex-start; text-align: center; ">
		</div>
		<div class="login-content">
			<form action="" method="post">
				<img src="img/avatar.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" name="user" class="input">
           		   </div>
           		</div>
              <div class="input-div pass">
                 <div class="i"> 
                    <i class="fas fa-lock"></i>
                 </div>
                 <div class="div">
                    <h5>Password</h5>
                    <input type="password" name="password" class="input">
                 </div>
              </div>
              <br>
              <div class="input-div one">
                 <div class="i">
                    <i class="fas fa-user"></i>
                 </div>
                 <div class="div">
                    <h5>Login Sebagai</h5>
                    <select class="input" name="level" required style="
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    border: none;
                    outline: none;
                    background: none;
                    padding: 0.5rem 0.7rem;
                    font-size: 1.2rem;
                    color: #555;
                    font-family: 'poppins', sans-serif;">
                          <option value=""></option>
                          <option value="1">UPM</option>
                          <option value="2">Administrator Prodi</option>
                          <option value="3">KTU</option>
                          <option value="4">Wakil Direktur</option>
                          <!-- <option value="5">Admin</option> -->
                    </select>
                 </div>
              </div>
           		
            	<!-- <a href="#">Forgot Password?</a> -->
            	<input type="submit" name="login" value="Login" class="btn" style="background-image: linear-gradient(to right, #00732e, #00c74f, #00732e);">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
<script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script> 
<!-- <link href="<?=base_url('/assets/css/bootstrap.min.css');?>" rel="stylesheet"> -->

</body>
</html>
<?php
}
?>