<?php
$g_name = $_POST['g_name'];
include "../../../connectdb.php";
$sql = "INSERT INTO `tb_gradelevel` (`g_name`) VALUES ('$g_name');";
mysqli_query($con,$sql);
echo "<meta http-equiv = 'refresh' content ='0;url = data_gradelevel.php'>";  
?>