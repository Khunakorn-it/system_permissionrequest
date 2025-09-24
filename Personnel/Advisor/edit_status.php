<?php 
    session_start();
    include "../../connectdb.php";
    // ตรวจสอบว่ามีค่า $_SESSION['id_personnel'], $_GET['id_request'], และ $_GET['status'] หรือไม่
    if(isset($_SESSION['id_personnel'], $_GET['id_request'], $_GET['status'], $_GET['Location'])) {
        $id_personnel = $_SESSION['id_personnel'];
        $id_request = $_GET['id_request'];
        $id_status = $_GET['status'];
        $Location = $_GET['Location'];
        echo $Location ;
        
        // ทำคำสั่ง SQL query โดยใช้ prepared statement เพื่อป้องกันการโจมตี SQL injection
        $sql_reqest = "UPDATE `tb_request` 
                        SET `id_requeststatus` = ?, `id_personnel` = ? 
                        WHERE `tb_request`.`id_request` = ?";
        $stmt = $con->prepare($sql_reqest);
        $stmt->bind_param('iii', $id_status, $id_personnel, $id_request);
        $stmt->execute();
        
        // รีเฟรชหน้าเว็บหลังจากทำการอัพเดทข้อมูลเสร็จสิ้น
        echo "<meta http-equiv='refresh' content='0;url=$Location'>";
    } else {
        echo "ข้อมูลไม่ถูกต้อง";
    }
?>
