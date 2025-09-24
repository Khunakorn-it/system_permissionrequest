<?php
$id_gradelevel = $_GET['id'];
//echo $id_student;
include "../../../connectdb.php";
$sql = "DELETE FROM `tb_gradelevel` WHERE `tb_gradelevel`.`id_gradelevel` = '$id_gradelevel'";
$result = mysqli_query($con,$sql);
echo "<meta http-equiv = 'refresh' content ='0;url = data_gradelevel.php'>";
?>