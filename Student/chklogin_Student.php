<?php
session_start();
$id_student = $_POST['id_student'];
$s_password = $_POST['s_password'];
// echo $id_student ;
// echo $s_password ;
include "../connectdb.php";
$sql = "SELECT * FROM `tb_student_join` WHERE `id_student` = '$id_student' AND `s_password` = '$s_password'";
$result = mysqli_query($con,$sql);
$num = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
if ($num != 1){
    echo '<script language = "javascript">';
    echo 'alert("username or password wrong")';
    echo '</script>';
    echo "<meta http-equiv = 'refresh' content ='0;url = Login_student/Login.php'>";
}else{
    $_SESSION['id_student'] = $row['id_student'];
    $_SESSION['position_student'] = $row['p_name'];
    echo "<meta http-equiv = 'refresh' content ='0;url = index.php'>";
} 