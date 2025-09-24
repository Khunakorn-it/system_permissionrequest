<?php 
    session_start();
    unset($_SESSION['id_personnel']);
    echo "<meta http-equiv = 'refresh' content ='0;url = Login_Personnel.php'>";
?>