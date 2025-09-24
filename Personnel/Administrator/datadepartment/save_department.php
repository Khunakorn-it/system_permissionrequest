<?php
$d_name = $_POST['d_name'];
include "../../../connectdb.php";
$sql = "INSERT INTO `tb_department` (`d_name`) VALUES ('$d_name');";
mysqli_query($con,$sql);
echo "<meta http-equiv = 'refresh' content ='0;url = data_department.php'>";  
?>