<?php
session_start();
$id_personnel = $_POST['id_personnel'];
$p_password = $_POST['p_password'];
if($p_password == ""){
    echo '<script language = "javascript">';
    echo 'alert("คุณไม่ได้ใส่รหัสผ่าน")';
    echo '</script>';
    echo "<meta http-equiv = 'refresh' content ='0;url = Login_Personnel.php'>";
}else{
    include "../connectdb.php";
    $sql = "SELECT p.id_personnel, pf.prefix_name, p.p_realname, p.p_surname, p.p_password, d.id_department, d.d_name, pt.id_position, pt.p_name
    FROM tb_personnel as p
    LEFT JOIN tb_prefix as pf ON p.id_prefix = pf.id_prefix
    LEFT JOIN tb_department as d ON p.id_department = d.id_department
    LEFT JOIN tb_position as pt ON p.id_position = pt.id_position 
    WHERE `id_personnel` = '$id_personnel' AND `p_password` = '$p_password'";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);

    if ($num != 1) {
        echo '<script language = "javascript">';
        echo 'alert("รหัสประจำตัวบุคลากร หรือ รหัสผ่าน")';
        echo '</script>';
        echo "<meta http-equiv = 'refresh' content ='0;url = Login_Personnel.php'>";
    } else {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id_personnel'] = $row['id_personnel'];
        $_SESSION['id_position'] = $row['id_position'];
        $_SESSION['position_name'] = $row['p_name'];
        $_SESSION['id_department'] = $row['id_department'];

        // รีเจนเนอเรต session ID
        session_regenerate_id();

        $position = $row['id_position'];
        if ($position == 0) {
            echo "<meta http-equiv = 'refresh' content ='0;url = Administrator'>";
        } elseif ($position == 3) {
            echo "<meta http-equiv = 'refresh' content ='0;url = Advisor'>";
        } elseif ($position == 4) {
            echo "<meta http-equiv = 'refresh' content ='0;url = Department_head'>";
        } elseif ($position == 5) {
            echo "<meta http-equiv = 'refresh' content ='0;url = Executive'>";
        } elseif ($position == 6) {
            echo "<meta http-equiv = 'refresh' content ='0;url = Security_guard'>";
        }
    }
}
?>
