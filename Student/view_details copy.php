<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../Boostrap4/bootstrap.min.css">
    <script src="../Boostrap4/jquery.min.js"></script> 
    <script src="../Boostrap4/popper.min.js"></script> 
    <script src="../Boostrap4/bootstrap.min.js"></script>
    <title>ระบบขออนุญาตออกนอกวิทยาลัยในเวลาเรียน</title>
</head>
<body>
    <?php
        session_start();
        $id_request = $_GET['id'];
        include "../connectdb.php";
        $id_student = $_SESSION['id_student'];
        //connect database name tb_request_join
        $sql_student = "SELECT * FROM `tb_request_join` WHERE id_request = $id_request";
        $result_student = mysqli_query($con,$sql_student);
        $row = mysqli_fetch_assoc($result_student);
        //echo $row['id_personnel'] ;
        //connect database name tb_perfix
        $id_prefix = $row['id_prefix'];
        $sql_prefix = "SELECT * FROM tb_prefix";
        $result_prefix = mysqli_query($con,$sql_prefix);
        $row_prefix = mysqli_fetch_assoc($result_prefix);
        //connect database name tb_gradelevel
        $id_gradelevel = $row['id_gradelevel'];
        $sql_gradelevel = "SELECT * FROM tb_gradelevel WHERE id_gradelevel = $id_gradelevel";
        $result_gradelevel = mysqli_query($con,$sql_gradelevel);
        $row_gradelevel = mysqli_fetch_assoc($result_gradelevel);
        //เช็ค id_personnel
        if($row['id_personnel'] == "-" or $row['id_personnel'] == ""){
            echo '<script language = "javascript">';
            echo 'alert("ยังไม่ได้รับการอนุมัติ")';
            echo '</script>';
            echo "<meta http-equiv = 'refresh' content ='0;url = view_history_student.php'>";
        }else{
            $id_personnel = $row['id_personnel'];
            //connect database name tb_personnel 
            $sql_personnel = "SELECT * FROM tb_personnel WHERE id_personnel = $id_personnel";
            $result_personnet = mysqli_query($con,$sql_personnel);
            $row_personnel = mysqli_fetch_assoc($result_personnet);
            //connect database name tb_prefix personnel
            $id_prefix_personnel = $row_personnel['id_prefix'];
            $sql_prefix_personnel = "SELECT * FROM tb_prefix WHERE id_prefix = $id_prefix_personnel";
            $result_prefix_personnel = mysqli_query($con,$sql_prefix_personnel);
            $row_prefix_personnel = mysqli_fetch_assoc($result_prefix_personnel);
            //connect database name tb_position 
            $id_position = $row_personnel['id_position'];
            $sql_position = "SELECT * FROM tb_position WHERE id_position = $id_position";
            $result_position = mysqli_query($con,$sql_position);
            $row_position = mysqli_fetch_assoc($result_position);
        }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="jumbotron">
                    <img src="../Image/school/logo.png" class="mx-auto d-block mt-3" alt="Cinque Terre" width="150" height="120">
                    <h4>บันทึกขออนุญาตออกนอกบริเวณวิทยาลัยเทคนิคกระบี่</h4>
                    <h4>วันที่ <?php echo $row['r_dey'];?></h4>
                    <h4>รหัสประจำตัวนักศึกษา <?php echo $row['id_student'];?></h4>
                    <h4>ชื่อ-นามสกุล <?php echo $row_prefix['prefix_name'].$row['s_realname']."&nbsp;".$row['s_surname'];?></h4>
                    <h4>แผนก<?php echo "&nbsp;".$row['d_name'];?> ระดับชั้น <?php echo $row_gradelevel['g_name'] ;?></h4>
                    <h4>เหตุผลในการขออนุญาต <?php echo $row['reason'] ;?></p></h4>
                    <h4>ผู้อนุมัติ <?php echo $row_prefix_personnel['prefix_name'].$row_personnel['p_realname']."&nbsp;".$row_personnel['p_surname'];?></h4>
                    <h4>ตำแหน่ง <?php echo  $row_position['p_name'] ;?></h4>
                    <a href="view_request.php" class="btn btn-dark">กลับ</a>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>
</html>