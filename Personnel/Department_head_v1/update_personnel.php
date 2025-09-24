<?php
session_start();
$id_personnel = $_POST['id_personnel']; //idบุคลากร
$id_prefix = $_POST['id_prefix']; //idคำนำหน้า
$p_realname = $_POST['p_realname']; //ขื่อ
$p_surname = $_POST['p_surname']; //นามสกุล
$p_password = $_POST['p_password']; //รหัสผ่าน
$id_department = $_SESSION['id_department']; //แผนก
$id_position = $_POST['id_position']; //ตำแหน่ง
$id_hid_personnel = $_POST['id_hid_personnel']; //id
include "../../connectdb.php";

// Check if the new id_student already exists
$check_sql = "SELECT * FROM `tb_personnel` WHERE id_personnel = '$id_personnel' AND id_personnel != '$id_hid_personnel'";
$check_result = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_result) > 0) {
    // If the id_student already exists, show an error message and redirect
    echo '<script language="javascript">';
    echo 'alert("มีรหัสประจำตัวนี้อยู่ในระบบแล้ว")';
    echo '</script>';
    echo "<meta http-equiv='refresh' content='0;url=edit_personnel.php?id=$id_hid_personnel'>";
} else {
    // Update the record
    $sql_update = "UPDATE `tb_personnel` SET `id_personnel` = '$id_personnel', `id_prefix` = '$id_prefix'
    , `p_realname` = '$p_realname', `p_surname` = '$p_surname', `p_password` = '$p_password',
    `id_department` = '$id_department', `id_position` = '$id_position' WHERE `tb_personnel`.`id_personnel` = '$id_hid_personnel';";
    $result_update = mysqli_query($con, $sql_update);
    if ($result_update) {
        // If the update is successful, redirect to data_student.php
        echo "<meta http-equiv='refresh' content='0;url=data_personnel.php'>";
    } else {
        // If there's an error in the update query, handle it appropriately
        echo "Error updating record: " . mysqli_error($con);
    }
}
?>
