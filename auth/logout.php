<?php
require_once "../_config/config.php";

unset($_SESSION['user']);
unset($_SESSION['lvl_prodi']);
echo "<script>window.location='".base_url('auth/login.php')."';</script>";
?>