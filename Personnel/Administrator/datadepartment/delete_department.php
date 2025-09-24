<?php
$id_department = $_GET['id'];
include "../../../connectdb.php";
$sql = "DELETE FROM tb_department WHERE id_department = $id_department";
$result = mysqli_query($con,$sql);
echo "<meta http-equiv = 'refresh' content ='0;url = data_department.php'>";
?>