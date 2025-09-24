<?php 
  session_start(); 
  if (empty($_SESSION['id_personnel'])){
      echo "<meta http-equiv = 'refresh' content ='0;url = ../Login_Personnel.php'>";
  }
?>
<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Responsiive Admin Dashboard | CodingLab</title>
    <link rel="stylesheet" href="styledata.css" />
    <!-- Boxicons CDN Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0081d5079a.js" crossorigin="anonymous"></script>
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <script src="../../../Highcharts/highcharts.js"></script>
    <script src="../../../Highcharts/modules/data.js"></script>
    <script src="../../../Highcharts/modules/series-label.js"></script>
    <script src="../../../Highcharts/modules/exporting.js"></script>
    <script src="../../../Highcharts/modules/export-data.js"></script>
    <script src="../../../Highcharts/modules/accessibility.js"></script>
    <div class="sidebar">
    <?php 
        date_default_timezone_set('Asia/Bangkok');
        $date = date("d-m-Y");
        $id_personnel = $_SESSION['id_personnel'];
        $id_department = $_SESSION['id_department'];
        include "../../connectdb.php";
        $sql_personnel = "SELECT * FROM tb_personnel WHERE id_personnel = $id_personnel";
        $result_personnel = mysqli_query($con, $sql_personnel);
        $row_personnel = mysqli_fetch_assoc($result_personnel);
        
        // Update records where r_dey is not equal to the current date and id_requeststatus is 1
        $sql_expired = "UPDATE `tb_request` SET `id_requeststatus` = '4', `id_personnel` = '-' WHERE r_dey != '$date' AND id_requeststatus = '1'";
        mysqli_query($con,$sql_expired);
        // connect database name tb_request_join 
        $sql_request = "SELECT rj.id_request, sj.prefix_name, sj.id_student, sj.s_realname, sj.s_surname,
        sj.g_name, rj.Time, rj.r_dey, rj.reason, rj.requeststatus_name, sj.id_department, rj.d_name, 
        rj.id_personnel
        FROM tb_student_join as sj
        LEFT JOIN tb_request_join as rj ON sj.id_student = rj.id_student
        LEFT JOIN tb_personnel_join as pj ON sj.id_personnel = pj.id_personnel
        WHERE sj.id_department = $id_department AND rj.requeststatus_name = 'รออนุมัติ'";
        $result_request = mysqli_query($con, $sql_request);
    ?>
      <div class="logo-details">
        <i class='bx bx-user-circle'></i>
        <span class="logo_name"><?php echo $_SESSION['position_name'] ;?></span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="index.php">
            <i class='bx bx-comment-dots' ></i>
            <span class="links_name">คำขออนุญาตนักศึกษา</span>
          </a>
        </li>
        <li>
          <a href="view_student_history.php">
            <i class='bx bx-revision'></i>
            <span class="links_name">ประวัติการขออนุญาต</span>
          </a>
        </li>
        <li>
          <a href="data_student.php">
            <i class='bx bx-user'></i>
            <span class="links_name">จัดการข้อมูลนักศึกษา</span>
          </a>
        </li>
        <li>
          <a href="view_profile.php">
            <i class="bx bx-cog"></i>
            <span class="links_name">ตั้งค่าข้อมูลส่วนตัว</span>
          </a>
        </li>
        <li class="log_out">
          <a href="../logout.php">
            <i class="bx bx-log-out"></i>
            <span class="links_name">ออกจากระบบ</span>
          </a>
        </li>
      </ul>
    </div>
    <section class="home-section">
      <nav>
        <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="dashboard">คำขออนุญาตนักศึกษา</span>
        </div>
      </nav>
      <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
                <input class="form-control" id="myInput" type="text" placeholder="ค้นหาข้อมูล">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>ID_Request</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>ระดับชั้น</th>
                            <th>เวลา</th>
                            <th>วันที่</th>
                            <th>แผนก</th>
                            <th>ดูรายละเอียด</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php while($row_request = $result_request->fetch_assoc()):?>
                            <tr>
                                <td><?php echo $row_request['id_request'];?></td>
                                <td><?php echo $row_request['prefix_name'].$row_request['s_realname']."&nbsp;".$row_request['s_surname'];?></td>
                                <td><?php echo $row_request['g_name'] ;?></td>
                                <td><?php echo $row_request['Time'] ;?></td>
                                <td><?php echo $row_request['r_dey'] ;?></td>
                                <td><?php echo $row_request['d_name']?></td>
                                <td>
                                  <div class="btn-group">
                                    <a href="edit_status.php?id_request=<?php echo $row_request['id_request'];?>&status=2&Location=index.php" class="btn btn-success"><i class='bx bx-check'></i> อนุมัติ</a>
                                    <a href="edit_status.php?id_request=<?php echo $row_request['id_request'];?>&status=3&Location=index.php" class="btn btn-danger"><i class='bx bx-x'></i> ไม่อนุมัติ</a>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_<?php echo $row_request['id_request']; ?>">
                                        ดูรายละเอียด
                                    </button>
                                  </div>
                                    <!-- Button to Open the Modal -->
                                    

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
                                                    <h4>เวลา <?php echo $row_request['Time'] ;?></h4>
                                                    <h4>วันที่ <?php echo $row_request['r_dey'] ;?></h4>
                                                    <h4>รายละเอียด <br><?php echo $row_request['reason'] ;?></h4>
                                                    <h4>สถานะคำขอ <?php echo $row_request['requeststatus_name'];?></h4>
                                                </div>
                                                <!-- Modal Footer -->
                                                <div class="modal-footer">
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
          </div>
        </div>
      </div>
    </section>

    <script>
      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".sidebarBtn");
      sidebarBtn.onclick = function () {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
          sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      };
    </script>
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
