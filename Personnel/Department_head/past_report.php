<?php session_start() ;?>
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
    <script src="../../Highcharts/highcharts.js"></script>
    <script src="../../Highcharts/modules/data.js"></script>
    <script src="../../Highcharts/modules/series-label.js"></script>
    <script src="../../Highcharts/modules/exporting.js"></script>
    <script src="../../Highcharts/modules/export-data.js"></script>
    <script src="../../Highcharts/modules/accessibility.js"></script>
    <?php 
       include "../../connectdb.php";
       $id_department = $_SESSION['id_department'];
       $sql = "SELECT r_dey, COUNT(id_request) AS sum_request
       FROM tb_request_join
       WHERE id_department = $id_department
       GROUP BY r_dey;";
       $result = mysqli_query($con,$sql);
       $id_department = $_SESSION['id_department'];
       $date = date("d-m-Y");
       $sql_dashboard = "SELECT COUNT(r.id_request) as sum_request, s.g_name as gradelevel
           FROM tb_request_join as r
           LEFT JOIN tb_student_join as s ON r.id_student = s.id_student
           WHERE r.id_department = $id_department AND r.r_dey = '$date'
           GROUP BY r.id_gradelevel;";
           $result_dashboard = mysqli_query($con, $sql_dashboard);
           $data = array(); // เก็บข้อมูลในรูปแบบ array
           while ($row = mysqli_fetch_assoc($result_dashboard)) {
               $data[] = $row; // เพิ่มแถวข้อมูลลงใน array
           }
    ?>
    <div class="sidebar">
      <div class="logo-details">
        <i class='bx bx-user-circle'></i>
        <span class="logo_name"><?php echo $_SESSION['position_name'] ;?></span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="index.php" class="active">
            <i class='bx bx-bar-chart-alt-2' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="view_student_request.php">
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
          <a href="data_personnel.php">
            <i class='bx bx-user'></i>
            <span class="links_name">จัดการข้อมูลบุคลากร</span>
          </a>
        </li>
        <li>
          <a href="past_report.php">
            <i class="bx bx-coin-stack"></i>
            <span class="links_name">ดูรายงานย้อนหลัง</span>
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
          <span class="dashboard">ดูรายงานย้อนหลัง</span>
        </div>
      </nav>
      <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
                <figure class="highcharts-figure">
                    <div id="dashboard">
                    </div>
                </figure>
                <input class="form-control" id="myInput" type="text" placeholder="ค้นหาข้อมูล">
                <table class="table table-hover mt-3">
                    <thead>
                        <tr>
                            <th>วันเดือนปี</th>
                            <th>จำนวนการขออนุญาต</th>
                            <th>รายละเอียด</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php
                            while($row_request = $result->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?php echo $row_request['r_dey'];?></td>
                            <td><?php echo $row_request['sum_request'];?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="viwe_request.php?dey=<?php echo $row_request['r_dey'];?>" class="btn btn-primary">ดูรายละเอียด</a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile ?>
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
    <script type="text/javascript">
                var data = '<?php echo $date; ?>';
                var gradelevel = <?php echo json_encode(array_column($data, 'gradelevel')); ?>; // นำเอา user_type ไปเก็บใน JavaScript array
                var sum_request = <?php echo json_encode(array_column($data, 'sum_request'), JSON_NUMERIC_CHECK); ?>; // นำเอา user_count ไปเก็บใน JavaScript array
                Highcharts.chart('dashboard', {
                chart: {
                type:'column'
                },
                title: {
                    text: 'รายงานการขออนุญาตของวันที่ '+ data,
                    align: 'center'
                },
                yAxis: {
                    title: {
                        text: 'จำนวนคำขอ'
                    }
                },

                xAxis: {
                    categories: gradelevel
                },

                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                series: [{
                    name: 'นักเรียนนักศึกษา',
                    data: sum_request
                }],

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }

                });
    </script>
  </body>
</html>
