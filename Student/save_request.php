<?php
    session_start();
    $id_student = $_SESSION['id_student'];
    $reason = $_POST['reason'];
    $time_out = $_POST['time_out'];
    $time_in = $_POST['time_in'];
    $reason_p = $_POST['reason_p'];
    $time = $time_out." - ".$time_in ;

    date_default_timezone_set('Asia/Bangkok');
    $date = date("d-m-Y");
    include "../connectdb.php";

    if($reason != "อื่นๆ"){
        $sql_student = "SELECT * FROM tb_student WHERE id_student = $id_student";
        $result_student = mysqli_query($con,$sql_student);
        $row_student = mysqli_fetch_assoc($result_student);
        $id_department = $row_student['id_department'];
        $id_personnel = $row_student['id_personnel'];
        $sql_reqest = "INSERT INTO `tb_request` 
        (`id_request`, `id_student`, `reason`, `Time`, `id_department`, `id_requeststatus`, `r_dey`, `id_personnel`) 
        VALUES (NULL, '$id_student', '$reason', '$time', '$id_department', '1', '$date', '-');";
        $result_request = mysqli_query($con,$sql_reqest);

        echo "<meta http-equiv = 'refresh' content ='0;url = index.php'>";
    }else{
        $sql_student = "SELECT * FROM tb_student WHERE id_student = $id_student";
        $result_student = mysqli_query($con,$sql_student);
        $row_student = mysqli_fetch_assoc($result_student);
        $id_department = $row_student['id_department'];
        $id_personnel = $row_student['id_personnel'];
        $sql_reqest = "INSERT INTO `tb_request` 
        (`id_request`, `id_student`, `reason`, `Time`, `id_department`, `id_requeststatus`, `r_dey`, `id_personnel`) 
        VALUES (NULL, '$id_student', '$reason_p', '$time', '$id_department', '1', '$date', '-');";
        $result_request = mysqli_query($con,$sql_reqest);

        echo "<meta http-equiv = 'refresh' content ='0;url = index.php'>";
    }
?>