<?php 
    session_start();
    $id_personnel = $_SESSION['id_personnel'];
    $id_request = $_GET['id_request'];
    $id_status = $_GET['status'];

    include "../../connectdb.php";
    $sql_reqest = "UPDATE `tb_request` 
    SET `id_requeststatus` = '$id_status', `id_personnel` = '$id_personnel' 
    WHERE `tb_request`.`id_request` = $id_request";
    mysqli_query($con,$sql_reqest);
    echo "<meta http-equiv = 'refresh' content ='0;url = view_student_request.php'>";
?>