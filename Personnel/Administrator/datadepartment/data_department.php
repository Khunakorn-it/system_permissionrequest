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
    <div class="sidebar">
    <?php 
        include "../../../connectdb.php";
        $sql = "SELECT * FROM tb_department";
        $result = mysqli_query($con,$sql);
    ?>
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
          <span class="dashboard">จัดการข้อมูลแผนก</span>
        </div>
      </nav>
      <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
                  <a href="add_department.php" class="btn btn-success" ><i class='bx bx-message-square-add'></i> เพิ่มข้อมูล</a>
                  <input class="form-control mt-3 fas" id="myInput" type="text" placeholder="&#xf002; ค้นหาข้อมูล">
                  <table class="table table-hover">
                      <thead>
                          <tr>
                              <th>รหัสแผนก</th>
                              <th>ชื่อแผนก</th>
                              <th>จัดการ</th>
                          </tr>
                      </thead>
                      <tbody id="myTable">
                          <?php
                              while($row = $result->fetch_assoc()):
                          ?>
                          <tr>
                              <td><?php echo $row['id_department'];?></td>
                              <td><?php echo $row['d_name'];?></td>
                              <td>
                                  <div class="btn-group">
                                      <a href="edit_department.php?id=<?php echo $row['id_department'];?>" class="btn btn-primary"><i class='far fa-edit'></i> แก้ไข</a>
                                      <a href="delete_department.php?id=<?php echo $row['id_department']; ?>" class="btn btn-danger" onclick="return confirm('Are your Sure to Delete')"><i class="far fa-trash-alt"></i> ลบ</a>
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
  </body>
</html>
