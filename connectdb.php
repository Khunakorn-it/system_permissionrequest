<?php 
$con = mysqli_connect("localhost", "ftp","1")or die("ERROR1");
mysqli_select_db($con, "permission_system") or die("ERROR2");

mysqli_query($con,"SET NAMES utf8");
date_default_timezone_set("Asia/Bangkok");
?>
