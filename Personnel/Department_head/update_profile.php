<?php
session_start();
$id_personnel = $_SESSION['id_personnel']; //idบุคลากร
$id_prefix = $_POST['id_prefix']; //idคำนำหน้า
$p_realname = $_POST['p_realname']; //ขื่อ
$p_surname = $_POST['p_surname']; //นามสกุล
$p_password = $_POST['p_password']; //รหัสผ่าน
$id_department = $_POST['id_department']; //แผนก
$id_position = $_POST['id_position']; //ตำแหน่ง
$id_hid_personnel = $_SESSION['id_personnel']; //id

include "../../connectdb.php";
$sql_update = "UPDATE `tb_personnel` SET `id_personnel` = '$id_personnel', `id_prefix` = '$id_prefix'
, `p_realname` = '$p_realname', `p_surname` = '$p_surname', `p_password` = '$p_password',
`id_department` = '$id_department', `id_position` = '$id_position' WHERE `tb_personnel`.`id_personnel` = '$id_hid_personnel';";
$result_update = mysqli_query($con, $sql_update);
echo "<meta http-equiv='refresh' content='0;url=view_profile.php'>";
?>