<?php
session_start();
if (empty($_SESSION['id_personnel'])) {
  echo "<meta http-equiv = 'refresh' content ='0;url = ../Login_Personnel.php'>";
}
?>
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
    $id_department_personnel = $_SESSION['id_department'];
    $sql_department_personnel = "SELECT * FROM tb_department WHERE id_department = $id_department_personnel";
    $result_department_personnel = mysqli_query($con, $sql_department_personnel);
    $row_department_personnel = mysqli_fetch_assoc($result_department_personnel);

    $id_department = $_SESSION['id_department'];

    $sql_student = "SELECT * FROM tb_student WHERE id_department = $id_department";
    $result_student = mysqli_query($con, $sql_student);
    $num_student = mysqli_num_rows($result_student);

    $sql_personnel = "SELECT * FROM tb_personnel WHERE id_department = $id_department";
    $result_personnel = mysqli_query($con, $sql_personnel);
    $num_personnel = mysqli_num_rows($result_personnel);

    $sql_dashboard = "SELECT COUNT(r.id_request) as sum_request, s.g_name as gradelevel
        FROM tb_request_join as r
        LEFT JOIN tb_student_join as s ON r.id_student = s.id_student
        WHERE r.id_department = $id_department_personnel
        GROUP BY r.id_gradelevel;";
    $result_dashboard = mysqli_query($con, $sql_dashboard);
    $data = array(); // เก็บข้อมูลในรูปแบบ array
    while ($row = mysqli_fetch_assoc($result_dashboard)) {
      $data[] = $row; // เพิ่มแถวข้อมูลลงใน array
    }
    $con_percent = $con;
    function percent($con, $d)
    {
      $id_department_personnel = $_SESSION['id_department'];
      $sql_information = "SELECT COUNT(id_request) as sum_request FROM tb_request_join WHERE id_department = $id_department_personnel";
      $result_information = mysqli_query($con, $sql_information);
      $row_information = mysqli_fetch_assoc($result_information);
      $all_number = $row_information['sum_request'];
      if ($all_number != 0) {
        if ($d != "อื่นๆ") {
          $sql_data = "SELECT COUNT(id_request) as sum_request FROM tb_request_join WHERE reason = '$d' AND id_department = $id_department_personnel";
          $result_data = mysqli_query($con, $sql_data);
          $row_data = mysqli_fetch_assoc($result_data);
          $all_data = $row_data['sum_request'];
        } else {
          $sql_data = "SELECT COUNT(id_request) as sum_request FROM tb_request_join WHERE reason != 'ออกไปรับประทานอาหารด้านนอก' AND reason != 'ออกไปปริ้นงาน' AND reason != 'ลืมหนังสือ/สมุด' AND id_department = $id_department_personnel";
          $result_data = mysqli_query($con, $sql_data);
          $row_data = mysqli_fetch_assoc($result_data);
          $all_data = $row_data['sum_request'];
        }
        $calculate = number_format((intval($all_data) * 100) / intval($all_number), 2);
        echo $calculate . "%";
      } else {
        echo "0%";
      }
    }
    ?>
    <div class="logo-details">
      <i class='bx bx-user-circle'></i>
      <span class="logo_name"><?php echo $_SESSION['position_name']; ?></span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="index.php" class="active">
          <i class='bx bx-bar-chart-alt-2'></i>
          <span class="links_name">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="view_student_request.php">
          <i class='bx bx-comment-dots'></i>
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
        <span class="dashboard">Dashboard</span>
      </div>
    </nav>
    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">นักศึกษา</div>
            <div class="number"><?php echo $num_student; ?></div>
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
            <div class="number"><?php echo $num_personnel; ?></div>
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
          <figure class="highcharts-figure">
            <div id="dashboard"></div>
            <h2>เหตุผลที่นักศึกษาขออนุญาตออกนอกวิทยาลัย</h2>
            <h3>ออกไปรับประทานอาหารด้านนอก <?php $per = percent($con_percent, "ออกไปรับประทานอาหารด้านนอก"); ?></h3>
            <h3>ออกไปปริ้นงาน <?php $per = percent($con_percent, "ออกไปปริ้นงาน"); ?></h3>
            <h3>ลืมหนังสือ/สมุด <?php $per = percent($con_percent, "ลืมหนังสือ/สมุด"); ?></h3>
            <h3>อื่นๆ <?php $per = percent($con_percent, "อื่นๆ"); ?></h3>
          </figure>
        </div>
      </div>
    </div>
  </section>

  <script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
      sidebar.classList.toggle("active");
      if (sidebar.classList.contains("active")) {
        sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
      } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    };
  </script>
  <script type="text/javascript">
    var gradelevel = <?php echo json_encode(array_column($data, 'gradelevel')); ?>; // นำเอา user_type ไปเก็บใน JavaScript array
    var sum_request = <?php echo json_encode(array_column($data, 'sum_request'), JSON_NUMERIC_CHECK); ?>; // นำเอา user_count ไปเก็บใน JavaScript array
    Highcharts.chart('dashboard', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'รายงานการขออนุญาตของนักศึกษาทั้งหมด',
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