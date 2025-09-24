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
$id_hid_student = $_POST['id_hid_student'];

include "../../connectdb.php";

// Check if the new id_student already exists
$check_sql = "SELECT * FROM `tb_student` WHERE id_student = '$id_student' AND id_student != '$id_hid_student'";
$check_result = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_result) > 0) {
    // If the id_student already exists, show an error message and redirect
    echo '<script language="javascript">';
    echo 'alert("มีรหัสประจำตัวนี้อยู่ในระบบแล้ว")';
    echo '</script>';
    echo "<meta http-equiv='refresh' content='0;url=edit_student.php?id=$id_hid_student'>";
} else {
    // Update the record
    $sql_update = "UPDATE `tb_student` SET `id_student` = '$id_student', `id_prefix` = '$id_prefix',
    `s_realname` = '$s_realname', `s_surname` = '$s_surname', `s_password` = '$s_password',
    `id_personnel` = '$id_personnel', `id_department` = '$id_department', `id_position` = '$id_position',
    `id_gradelevel` = '$id_gradelevel' WHERE `tb_student`.`id_student` = '$id_hid_student';";
    $result_update = mysqli_query($con, $sql_update);
    if ($result_update) {
        // If the update is successful, redirect to data_student.php
        echo "<meta http-equiv='refresh' content='0;url=data_student.php'>";
    } else {
        // If there's an error in the update query, handle it appropriately
        echo "Error updating record: " . mysqli_error($con);
    }
}
?>
