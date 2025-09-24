<?php session_start() ;?>
<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>ระบบขออนุญาตออกนอกวิทยาลัย</title>
    <link rel="stylesheet" href="../styledata.css" />
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
    <?php 
        $id_gradelevel = $_GET['id'];
        include "../../../connectdb.php";
        $sql_gradelevel = "SELECT * FROM tb_gradelevel WHERE id_gradelevel = $id_gradelevel";
        $result_gradelevel = mysqli_query($con,$sql_gradelevel);
        $row = mysqli_fetch_assoc($result_gradelevel);
    ?>
    <div class="sidebar">
      <div class="logo-details">
        <i class='bx bx-user-circle'></i>
        <span class="logo_name"><?php echo $_SESSION['position_name'] ;?></span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="../index.php" class="active">
            <i class='bx bx-bar-chart-alt-2'></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="../datastudent/data_student.php">
            <i class='bx bx-user'></i>
            <span class="links_name">จัดการข้อมูลนักศึกษา</span>
          </a>
        </li>
        <li>
          <a href="../datapersonnel/data_personnel.php">
            <i class='bx bx-user'></i>
            <span class="links_name">จัดการข้อมูลบุคลากร</span>
          </a>
        </li>
        <li>
          <a href="data_department.php">
            <i class='bx bx-home-circle'></i>
            <span class="links_name">จัดการข้อมูลแผนก</span>
          </a>
        </li>
        <li>
          <a href="../dataposition/data_position.php">
            <i class="bx bx-coin-stack"></i>
            <span class="links_name">จัดการข้อมูลตำแหน่ง</span>
          </a>
        </li>
        <li>
          <a href="../datagradelevel/data_gradelevel.php">
            <i class='bx bx-menu-alt-left'></i>
            <span class="links_name">จัดการข้อมูลระดับชั้น</span>
          </a>
        </li>
        <li>
          <a href="../view_profile.php">
            <i class="bx bx-cog"></i>
            <span class="links_name">ตั้งค่าข้อมูลส่วนตัว</span>
          </a>
        </li>
        <li class="log_out">
          <a href="../../logout.php">
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
          <span class="dashboard">จัดการข้อมูลระดับชั้น</span>
        </div>
      </nav>
      <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
                <h2>แก้ไขข้อมูลระดับชั้น</h2>
                <form action="update_gradelevel.php" method="post">
                    <div class="form-group">
                        <label for="usr">ชื่อตำแหน่ง</label>
                        <input type="text" class="form-control" id="usr" name="g_name" value="<?php echo $row['g_name'] ;?>">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class='bx bx-save' ></i> บันทึก</button>
                    <a href="data_gradelevel.php" class="btn btn-danger"><i class='bx bx-x' ></i> ยกเลิก</a>
                        <input type="hidden" name="id_gradelevel" value="<?php echo $_GET['id'];?>">
                </form>
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
  </body>
</html>
