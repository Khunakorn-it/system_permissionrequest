<?php
$id_personnel = $_GET['id'];
//echo $id_student;
include "../../../connectdb.php";
$sql = "DELETE FROM `tb_personnel` WHERE `tb_personnel`.`id_personnel` = '$id_personnel'";
$result = mysqli_query($con,$sql);
echo "<meta http-equiv = 'refresh' content ='0;url = data_personnel.php'>";
?>