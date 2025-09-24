<?php
    session_start();
    $id_student = $_SESSION['id_student'];
    $s_password = $_POST['s_password'];

    include "../connectdb.php";
    $sql_update = "UPDATE tb_student SET s_password = '$s_password' WHERE id_student = '$id_student'";
    mysqli_query($con,$sql_update);
    echo "<meta http-equiv = 'refresh' content ='0;url = view_profile.php'>";
?>