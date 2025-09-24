<?php
session_start();
$id_student = $_POST['id_student'];
$id_prefix = $_POST['id_prefix'];
$s_realname = $_POST['s_realname'];
$s_surname = $_POST['s_surname'];
$s_password = $_POST['s_password'];
$id_gradelevel = $_POST['id_gradelevel'];
$id_department = $_SESSION['id_department'];
$id_personnel = $_POST['id_personnel'];
$id_position = $_POST['id_position'];

include "../../connectdb.php";
$sql = "SELECT * FROM `tb_student` WHERE `id_student` = '$id_student';";
$result = mysqli_query($con,$sql);
$num = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
echo $num ;
if ($num != 0){
    echo '<script language = "javascript">';
    echo 'alert("มีข้อมูลในระบบแล้ว")';
    echo '</script>';
    echo "<meta http-equiv = 'refresh' content ='0;url = add_student.php'>";
}else{
    $sql_save = "INSERT INTO `tb_student` 
    (`id_student`, `id_prefix`, `s_realname`, `s_surname`, `s_password`, `id_personnel`, `id_department`, `id_position`, `id_gradelevel`) 
    VALUES ('$id_student', '$id_prefix', '$s_realname', '$s_surname', '$s_password', '$id_personnel', '$id_department', '$id_position', '$id_gradelevel');";
    $result_save = mysqli_query($con,$sql_save);
    echo "<meta http-equiv = 'refresh' content ='0;url = data_student.php'>";   
}
?>