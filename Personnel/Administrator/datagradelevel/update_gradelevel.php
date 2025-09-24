<?php 
    $id_gradelevel = $_POST['id_gradelevel'] ;
    $g_name = $_POST['g_name'];
    echo $g_name ;
    include "../../../connectdb.php" ;
    $sql_gradelevel = "UPDATE `tb_gradelevel` SET `g_name` = '$g_name' WHERE `tb_gradelevel`.`id_gradelevel` = $id_gradelevel ;";
    mysqli_query($con,$sql_gradelevel);
    echo "<meta http-equiv='refresh' content='0;url=data_gradelevel.php'>";
?>