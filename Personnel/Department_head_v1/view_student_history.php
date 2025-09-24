<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
    <?php
        session_start();
        $id_personnel = $_SESSION['id_personnel'];
        $id_department = $_SESSION['id_department'];
        include "../../connectdb.php";
        $sql_personnel = "SELECT * FROM tb_personnel WHERE id_personnel = $id_personnel";
        $result_personnel = mysqli_query($con, $sql_personnel);
        $row_personnel = mysqli_fetch_assoc($result_personnel);
        // connect database name tb_request_join 
        $sql_request = "SELECT r.id_request, id_student, p.prefix_name, s_realname, s_surname,	
        Time, r_dey, reason, requeststatus_name, r.d_name, g.g_name, r.id_personnel, 
        ps.prefix_name as prefix_personnel, ps.p_realname, ps.p_surname, ps.p_name
        FROM tb_request_join as r
        LEFT JOIN tb_prefix as p ON r.id_prefix = p.id_prefix
        LEFT JOIN tb_gradelevel as g ON r.id_gradelevel = g.id_gradelevel
        LEFT JOIN tb_personnel_join as ps ON r.id_personnel = ps.id_personnel
        WHERE r.id_department = $id_department AND r.requeststatus_name != 'รออนุมัติ'";
        $result_request = mysqli_query($con, $sql_request);
    ?>

    <div class="container">
        <h1 class="text-center">ประวัติการขออนุญาตของนักเรียนนักศึกษา</h1>
        <a href="index.php" class="btn btn-danger">ออก</a>
        <input class="form-control" id="myInput" type="text" placeholder="ค้นหาข้อมูล">
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th>ID_Request</th>
                    <th>รหัสประจำตัวนักศึกษา</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>ระดับชั้น</th>
                    <th>เวลา</th>
                    <th>วันที่</th>
                    <th>ดูรายละเอียด</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php while($row_request = $result_request->fetch_assoc()):?>
                    <tr>
                        <td><?php echo $row_request['id_request'];?></td>
                        <td><?php echo $row_request['id_student'] ;?></td>
                        <td><?php echo $row_request['prefix_name'].$row_request['s_realname']."&nbsp;".$row_request['s_surname'];?></td>
                        <td><?php echo $row_request['g_name'] ;?></td>
                        <td><?php echo $row_request['Time'] ;?></td>
                        <td><?php echo $row_request['r_dey'] ;?></td>
                        <td>
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_<?php echo $row_request['id_request']; ?>">
                                ดูรายละเอียด
                            </button>

                            <!-- The Modal -->
                            <div class="modal" id="myModal_<?php echo $row_request['id_request']; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">รายละเอียด</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Modal Body -->
                                        <div class="modal-body text-left">
                                            <h4>ID_Request <?php echo $row_request['id_request'];?></h4>
                                            <h4>ชื่อ-นามสกุล <?php echo $row_request['prefix_name'].$row_request['s_realname']."&nbsp;".$row_request['s_surname'];?></h4>
                                            <h4>ระดับชั้น <?php echo $row_request['g_name'] ;?></h4>
                                            <h4>แผนก <?php echo $row_request['d_name'];?></h4>
                                            <h4>เวลา <?php echo $row_request['Time'] ;?></h4>
                                            <h4>วันที่ <?php echo $row_request['r_dey'] ;?></h4>
                                            <h4>รายละเอียด <br><?php echo $row_request['reason'] ;?></h4> 
                                            <h4>สถานะคำขอ <?php echo $row_request['requeststatus_name'];?></h4>
                                        </div>
                                        <!-- Modal Footer -->
                                        <div class="modal-footer">
                                            <a href="edit_status.php?id_request=<?php echo $row_request['id_request'];?>&status=2" class="btn btn-success">อนุมัติ</a>
                                            <a href="edit_status.php?id_request=<?php echo $row_request['id_request'];?>&status=3" class="btn btn-info">ไม่อนุมัติ</a>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endwhile?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        });
    </script>
</body>
</html>
