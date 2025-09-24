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
    <?php 
        include "../../connectdb.php";
        $id_department = $_SESSION['id_department'];
        //เชื่อมdatabaseชื่อ tb_prefix
        $sql_prefix ="SELECT * FROM `tb_prefix`";
        $result_prefix = mysqli_query($con,$sql_prefix);
        //เชื่อมdatabaseชื่อ tb_gradelevel
        $sql_gradelevel ="SELECT * FROM `tb_gradelevel` ORDER BY `tb_gradelevel`.`g_name` ASC";
        $result_gradelevel = mysqli_query($con,$sql_gradelevel);
        //เชื่อมdatabaseชื่อ tb_department
        $sql_position ="SELECT * FROM `tb_position` WHERE id_position BETWEEN 1 AND 2 ";
        $result_position = mysqli_query($con,$sql_position);
        //เชื่อมdatabaseชื่อ tb_personnel_loin
        $sql_personnel = "SELECT * FROM tb_personnel_join WHERE id_department = $id_department AND p_name != 'หัวหน้าแผนก'";
        $result_personnel = mysqli_query($con,$sql_personnel);
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
          <span class="dashboard">จัดการข้อมูลนักศึกษา</span>
        </div>
      </nav>
      <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
                <h1>เพิ่มข้อมูลนักศึกษา</h1>
                  <form action="save_student.php" method="post">
                  <div class="form-group">
                      <label for="id_student">รหัสประจำตัว</label>
                      <input type="text" class="form-control" id="id_student" name="id_student">
                  </div>
                  <div class="form-group">
                      <label for="prefix">คำนำหน้า</label>
                      <select class="form-control" id="prefix" name="id_prefix">
                      <?php while($row_prefix = $result_prefix->fetch_assoc()):?>
                          <option value="<?php echo $row_prefix['id_prefix'] ;?>">
                              <?php echo $row_prefix['prefix_name'];?>
                          </option>
                      <?php endwhile ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="s_realnam">ชื่อ</label>
                      <input type="text" class="form-control" id="s_realname" name="s_realname">
                  </div>
                  <div class="form-group">
                      <label for="s_surname">นามสกุล</label>
                      <input type="text" class="form-control" id="s_surname" name="s_surname">
                  </div>
                  <div class="form-group">
                      <label for="s_password">รหัสผ่าน</label>
                      <input type="text" class="form-control" id="s_password" name="s_password">
                  </div>
                  <div class="form-group">
                      <label for="gradelevel">ระดับชั้น</label>
                      <select class="form-control" id="gradelevel" name="id_gradelevel">
                      <?php while($row_gradelevel = $result_gradelevel->fetch_assoc()):?>
                          <option value="<?php echo $row_gradelevel['id_gradelevel'] ;?>">
                              <?php echo $row_gradelevel['g_name'];?>
                          </option>
                      <?php endwhile ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="position">ตำแหน่ง</label>
                      <select class="form-control" id="id_position" name="id_position">
                      <?php while($row_position = $result_position->fetch_assoc()):?>
                          <option value="<?php echo $row_position['id_position'] ;?>">
                              <?php echo $row_position['p_name'];?>
                          </option>
                      <?php endwhile ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="personnel">ครูที่ปรึกษา</label>
                      <select class="form-control" id="id_personnel" name="id_personnel">
                      <?php while($row_personnel = $result_personnel->fetch_assoc()):?>
                          <option value="<?php echo $row_personnel['id_personnel'] ;?>">
                              <?php echo $row_personnel['prefix_name'].$row_personnel['p_realname'].$row_personnel['p_surname'];?>
                          </option>
                      <?php endwhile ?>
                      </select>
                  </div>
                  <button type="submit" class="btn btn-primary"><i class='bx bx-save'></i> บันทึก</button>
                  <a href="data_student.php" class="btn btn-danger"><i class='bx bx-x' ></i> ยกเลิก</a>
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
