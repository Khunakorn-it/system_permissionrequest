<?php
    session_start();

    $id_personnel = $_SESSION['id_personnel'];
    $p_password = $_POST['p_password'];
    $p_password_new = $_POST['p_password_new'];
    $lokation = $_POST['lokation'];
    
    include "../connectdb.php";
    $sql = "SELECT * FROM tb_personnel_join WHERE id_personnel = $id_personnel";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    
    if($row['p_password'] == $p_password){
        $sql_update = "UPDATE tb_personnel SET p_password = $p_password_new WHERE id_personnel = $id_personnel";
        mysqli_query($con,$sql_update);
        echo '<script language = "javascript">';
        echo 'alert("เปลี่ยนรหัสผ่านสำเร็จ")';
        echo '</script>';
        echo "<meta http-equiv = 'refresh' content ='0;url = $lokation'>";
    }else{
        echo '<script language = "javascript">';
        echo 'alert("รหัสผ่านเดิมไม่ถูกต้อง")';
        echo '</script>';
        echo "<meta http-equiv = 'refresh' content ='0;url = $lokation'>";
    }
?>