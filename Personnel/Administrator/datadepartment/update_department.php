<?php 
    $id_department = $_POST['id_department'] ;
    $d_name = $_POST['d_name'];
    include "../../../connectdb.php" ;
    $sql_department = "UPDATE `tb_department` SET `d_name` = '$d_name' WHERE `tb_department`.`id_department` = '$id_department';";
    mysqli_query($con,$sql_department);
    echo "<meta http-equiv='refresh' content='0;url=data_department.php'>";
?>