<?php
session_start();
$id_personnel = $_POST['id_personnel'];
$id_prefix = $_POST['id_prefix'];
$p_realname = $_POST['p_realname'];
$p_surname = $_POST['p_surname'];
$p_password = $_POST['p_password'];
$id_department = $_SESSION['id_department'];
$id_position = $_POST['id_position'];

include "../../connectdb.php";
$sql = "SELECT * FROM `tb_personnel` WHERE `id_personnel` = '$id_personnel';";
$result = mysqli_query($con,$sql);
$num = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
if ($num != 0){
    echo '<script language = "javascript">';
    echo 'alert("มีข้อมูลในระบบแล้ว")';
    echo '</script>';
    echo "<meta http-equiv = 'refresh' content ='0;url = add_personnel.php'>";
}else{
    $sql_save = "INSERT INTO `tb_personnel` 
    (`id_personnel`, `id_prefix`, `p_realname`, `p_surname`, `p_password`, `id_department`, `id_position`) 
    VALUES ('$id_personnel', '$id_prefix', '$p_realname ', '$p_surname', '$p_password', '$id_department', '$id_position');";
    $result_save = mysqli_query($con,$sql_save);
    echo "<meta http-equiv = 'refresh' content ='0;url = data_personnel.php'>";   
}
?>