<?php
$id_position = $_GET['id'];
include "../../../connectdb.php";
$sql = "DELETE FROM tb_position WHERE id_position = $id_position";
$result = mysqli_query($con,$sql);
echo "<meta http-equiv = 'refresh' content ='0;url = data_position.php'>";
?>