<?php
$id_student = $_GET['id'];
//echo $id_student;
include "../../../connectdb.php";
$sql = "DELETE FROM `tb_student` WHERE `tb_student`.`id_student` = '$id_student'";
$result = mysqli_query($con,$sql);
echo "<meta http-equiv = 'refresh' content ='0;url = data_student.php'>";
?>