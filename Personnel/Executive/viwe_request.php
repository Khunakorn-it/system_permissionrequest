<?php session_start() ;?>
<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Responsiive Admin Dashboard | CodingLab</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </head>
  <body>
    <script src="../../Highcharts/highcharts.js"></script>
    <script src="../../Highcharts/modules/data.js"></script>
    <script src="../../Highcharts/modules/series-label.js"></script>
    <script src="../../Highcharts/modules/exporting.js"></script>
    <script src="../../Highcharts/modules/export-data.js"></script>
    <script src="../../Highcharts/modules/accessibility.js"></script>
    <div class="sidebar">
    <?php
        $date = $_GET['dey']; 
        include "../../connectdb.php";
        $sql_sum = "SELECT * FROM tb_request_join WHERE r_dey = '$date'";
        $result_sum = mysqli_query($con,$sql_sum);
        $row_sum = mysqli_num_rows($result_sum);

        $sql_department ="SELECT COUNT(d_name) as sum_department  FROM tb_request_join WHERE r_dey = '$date'  GROUP BY d_name";
        $result_sum_department = mysqli_query($con,$sql_department);
        $row_sum_department = mysqli_num_rows($result_sum_department);
        
        $sql_reqest_dey = "SELECT r_dey, d_name, COUNT(id_request) AS sum_request
        FROM tb_request_join
        WHERE r_dey = '$date'
        GROUP BY r_dey, d_name;";
        $result_reqest_dey = mysqli_query($con,$sql_reqest_dey);
        $data = array(); // เก็บข้อมูลในรูปแบบ array
            while ($row = mysqli_fetch_assoc($result_reqest_dey)) {
                $data[] = $row; // เพิ่มแถวข้อมูลลงใน array
            }
            $con_percent = $con;
            function percent($con,$d){
              $date = $_GET['dey'];
              $sql_information = "SELECT COUNT(id_request) as sum_request FROM tb_request_join WHERE r_dey = '$date'";
              $result_information = mysqli_query($con,$sql_information);
              $row_information = mysqli_fetch_assoc($result_information);
              $all_number = $row_information['sum_request'];
          
              if($all_number != 0) { // ตรวจสอบว่า $all_number ไม่เป็นศูนย์ก่อนทำการหาร
                  if($d != "อื่นๆ"){
                      $sql_data = "SELECT COUNT(id_request) as sum_request FROM tb_request_join WHERE reason = '$d' AND r_dey = '$date'";
                      $result_data = mysqli_query($con,$sql_data);
                      $row_data = mysqli_fetch_assoc($result_data);
                      $all_data = $row_data['sum_request'];
                      
                  } else {
                      $sql_data = "SELECT COUNT(id_request) as sum_request FROM tb_request_join WHERE reason != 'ออกไปรับประทานอาหารด้านนอก' AND reason != 'ออกไปปริ้นงาน' AND reason != 'ลืมหนังสือ/สมุด' AND r_dey = '$date'";
                      $result_data = mysqli_query($con,$sql_data);
                      $row_data = mysqli_fetch_assoc($result_data);
                      $all_data = $row_data['sum_request'];
                  }
                  $calculate = number_format((intval($all_data) * 100) / intval($all_number),2);
                  echo $calculate."%";
              } else {
                  echo "0%";
              }
          }
    ?>
      <div class="logo-details">
        <i class='bx bx-user-circle'></i>
        <span class="logo_name"><?php echo $_SESSION['position_name'] ;?></span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="index.php" class="active">
            <i class='bx bx-bar-chart-alt-2' ></i>
            <span class="links_name">รายงานสถิติรวม</span>
          </a>
        </li>
        <li>
          <a href="past_report.php">
            <i class='bx bx-bar-chart-alt'></i>
            <span class="links_name">รายงานสถิติรายวัน</span>
          </a>
        </li>
        <li>
          <a href="data_request.php">
            <i class="bx bx-coin-stack"></i>
            <span class="links_name">รายงานสถิติย้อนหลัง</span>
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
          <span class="dashboard">รายงานสถิติย้อนหลังของวันที่ <?php echo $date; ?></span>
        </div>
      </nav>
      <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
              <div class="box-topic">จำนวนการขออนุญาตของวันที่ </div>
              <div class="number"><?php echo $row_sum ;?></div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">ครั้ง</span>
              </div>
            </div>
            <i class='bx bx-user student cart'></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">จำนวนแผนกที่มีนักศึกษาขออนุญาต </div>
              <div class="number"><?php echo $row_sum_department;?></div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">แผนก</span>
              </div>
            </div>
            <i class='bx bx-home cart'></i>
          </div>
        </div>
        <div class="sales-boxes">
          <div class="recent-sales box">
            <figure class="highcharts-figure">
                <div id="dashboard"></div>
                <h2>เหตุผลที่นักศึกษาขออนุญาตออกนอกวิทยาลัย</h2>
                <h3>ออกไปรับประทานอาหารด้านนอก <?php $per = percent($con_percent,"ออกไปรับประทานอาหารด้านนอก");?></h3>
                <h3>ออกไปปริ้นงาน <?php $per = percent($con_percent,"ออกไปปริ้นงาน");?></h3>
                <h3>ลืมหนังสือ/สมุด <?php $per = percent($con_percent,"ลืมหนังสือ/สมุด");?></h3>
                <h3>อื่นๆ <?php $per = percent($con_percent,"อื่นๆ");?></h3>
                <a href="data_request.php" class="btn btn-danger"><i class='bx bxs-chevron-left' ></i> กลับ</a>
            </figure>

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
    <script type="text/javascript">
                var data = '<?php echo $date; ?>';
                var d_name = <?php echo json_encode(array_column($data, 'd_name')); ?>; // นำเอา user_type ไปเก็บใน JavaScript array
                var sum_request = <?php echo json_encode(array_column($data, 'sum_request'), JSON_NUMERIC_CHECK); ?>; // นำเอา user_count ไปเก็บใน JavaScript array
                Highcharts.chart('dashboard', {
                chart: {
                type:'column'
                },
                title: {
                    text: 'รายงานจำนวนการขออนุญาตออกนอกวิทยาลัยของนักเรียนนักศึกษาวันที่ ' + data,
                    align: 'center'
                },
                yAxis: {
                    title: {
                        text: 'จำนวนการขออนุญาต'
                    }
                },

                xAxis: {
                    categories: d_name
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
