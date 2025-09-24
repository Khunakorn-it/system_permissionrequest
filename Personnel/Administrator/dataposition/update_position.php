<?php 
    $id_position = $_POST['id_position'] ;
    $p_name = $_POST['p_name'];
    include "../../../connectdb.php" ;
    $sql_position = "UPDATE `tb_position` SET `p_name` = '$p_name' WHERE `tb_position`.`id_position` = $id_position ;";
    mysqli_query($con,$sql_position);
    echo "<meta http-equiv='refresh' content='0;url=data_position.php'>";
?>