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
    <title>ระบบขออนุญาตออกนอกวิทยาลัย</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Boxicons CDN Link -->
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
    <div class="sidebar">
    <?php 
        include "../../connectdb.php";
        $sql_student = "SELECT * FROM tb_student";
        $result_student = mysqli_query($con, $sql_student);
        $num_student = mysqli_num_rows($result_student);

        $sql_personnel = "SELECT * FROM tb_personnel";
        $result_personnel = mysqli_query($con, $sql_personnel);
        $num_personnel = mysqli_num_rows($result_personnel);

        $sql_dashboard = "SELECT 'Student' AS user_type, COUNT(id_student) AS user_count FROM tb_student_join
                UNION ALL
                SELECT 'Personnel' AS user_type, COUNT(id_personnel) AS user_count FROM tb_personnel_join;";
        $result_dashboard = mysqli_query($con, $sql_dashboard);
        $data = array(); // เก็บข้อมูลในรูปแบบ array
        while ($row = mysqli_fetch_assoc($result_dashboard)) {
            $data[] = $row; // เพิ่มแถวข้อมูลลงใน array
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
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="datastudent/data_student.php">
            <i class='bx bx-user'></i>
            <span class="links_name">จัดการข้อมูลนักศึกษา</span>
          </a>
        </li>
        <li>
          <a href="datapersonnel/data_personnel.php">
            <i class='bx bx-user'></i>
            <span class="links_name">จัดการข้อมูลบุคลากร</span>
          </a>
        </li>
        <li>
          <a href="datadepartment/data_department.php">
            <i class='bx bx-home-circle'></i>
            <span class="links_name">จัดการข้อมูลแผนก</span>
          </a>
        </li>
        <li>
          <a href="dataposition/data_position.php">
            <i class="bx bx-coin-stack"></i>
            <span class="links_name">จัดการข้อมูลตำแหน่ง</span>
          </a>
        </li>
        <li>
          <a href="datagradelevel/data_gradelevel.php">
            <i class='bx bx-menu-alt-left'></i>
            <span class="links_name">จัดการข้อมูลระดับชั้น</span>
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
          <span class="dashboard">Dashboard</span>
        </div>
      </nav>
      <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
              <div class="box-topic">นักศึกษา</div>
              <div class="number"><?php echo $num_student ;?></div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">คน</span>
              </div>
            </div>
            <i class='bx bx-user student cart'></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">บุคลากร</div>
              <div class="number"><?php echo $num_personnel ;?></div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">คน</span>
              </div>
            </div>
            <i class='bx bx-user cart'></i>
          </div>
        </div>
        <div class="sales-boxes">
          <div class="recent-sales box">
            <!-- contain -->
            <figure class="highcharts-figure">
                <div id="dashboard"></div>
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
        var userTypes = <?php echo json_encode(array_column($data, 'user_type')); ?>; // นำเอา user_type ไปเก็บใน JavaScript array
        var userCounts = <?php echo json_encode(array_column($data, 'user_count'), JSON_NUMERIC_CHECK); ?>; // นำเอา user_count ไปเก็บใน JavaScript array
        Highcharts.chart('dashboard', {
        chart: {
        type:'column'
        },
        title: {
            text: 'รายงานจำนวนผู้ใช้งานระบบ',
            align: 'center'
        },
        yAxis: {
            title: {  
                text: 'จำนวนผู้ใช้'
            }
        },

        xAxis: {
            categories: userTypes
        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        series: [{
            name: 'ผู้ใช้',
            data: userCounts
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
