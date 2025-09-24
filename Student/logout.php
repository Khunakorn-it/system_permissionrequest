<?php 
    session_start();
    unset($_SESSION['id_student']);
    echo "<meta http-equiv = 'refresh' content ='0;url = Login_student/Login.php'>";
?>