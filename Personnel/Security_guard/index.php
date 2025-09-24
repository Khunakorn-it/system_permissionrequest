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
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <style>
        .textcenter { 
            text-align: center
        }
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 360px;
            max-width: 1000px;
            margin: 1em auto;
        }
        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>
  </head>
  <body>
    <?php
        date_default_timezone_set('Asia/Bangkok');
        $date = date("d-m-Y");
        include "../../connectdb.php";
        // connect database name tb_request_join 
        $sql_request = "SELECT r.id_request, id_student, p.prefix_name, s_realname, s_surname,	
        Time, r_dey, reason, requeststatus_name, r.d_name, g.g_name, r.id_personnel, 
        ps.prefix_name as prefix_personnel, ps.p_realname, ps.p_surname, ps.p_name
        FROM tb_request_join as r
        LEFT JOIN tb_prefix as p ON r.id_prefix = p.id_prefix
        LEFT JOIN tb_gradelevel as g ON r.id_gradelevel = g.id_gradelevel
        LEFT JOIN tb_personnel_join as ps ON r.id_personnel = ps.id_personnel
        WHERE requeststatus_name = 'อนุมัติแล้ว' AND r_dey = '$date'
        ORDER BY Time ASC;";
        $result_request = mysqli_query($con, $sql_request);
    ?>
    <div class="sidebar">
      <div class="logo-details">
        <i class='bx bx-user-circle'></i>
        <span class="logo_name"><?php echo $_SESSION['position_name'] ;?></span>
      </div>
      <ul class="nav-links">
        <li>
            <a href="index.php" class="active">
              <i class='bx bx-book-content'></i>
              <span class="links_name">ดูข้อมูลนักศึกษา</span>
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
          <span class="dashboard">ดูข้อมูลนักศึกษาของวันที่ <?php echo $date ;?></span>
        </div>
      </nav>
      <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
              <input class="form-control mt-2" id="myInput" type="text" placeholder="ค้นหาข้อมูล">           
              <table class="table table-hover text-center">
                  <thead>
                      <tr>
                          <th>ID_Request</th>
                          <th>รหัสประจำตัวนักศึกษา</th>
                          <th>ชื่อ-นามสกุล</th>
                          <th>ระดับชั้น</th>
                          <th>เวลา</th>
                          <!-- <th>วันที่</th> -->
                          <th>รายละเอียด</th>
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
                              <!-- <td><?php //echo $row_request['r_dey'] ;?></td> -->
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
                                                  <h4>ชื่อ-นามสกุล <?php echo $row_request['prefix_name']."&nbsp;".$row_request['s_realname']."&nbsp;".$row_request['s_surname'];?></h4>
                                                  <h4>ระดับชั้น <?php echo $row_request['g_name'] ;?></h4>
                                                  <h4>แผนก <?php echo $row_request['d_name'];?></h4>
                                                  <h4>วันที่ <?php echo $row_request['r_dey'];?></h4>
                                                  <h4>เวลา <?php echo $row_request['Time'] ;?></h4>
                                                  <h4>รายละเอียด <br><?php echo $row_request['reason'] ;?></h4>
                                                  <h4>ผู้อนุมัติ <?php echo $row_request['prefix_personnel'].$row_request['p_realname']."&nbsp;".$row_request['p_surname'] ;?><br>ตำแหน่ง <?php echo $row_request['p_name'];?></h4>
                                                  <h4>สถานะคำขอ <?php echo $row_request['requeststatus_name'];?></h4>
                                                  <h4></h4>
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
