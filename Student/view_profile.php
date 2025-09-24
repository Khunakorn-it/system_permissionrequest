<?php session_start() ;?>
<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>ระบบขออนุญาตออกนอกวิทยาลัยในเวลาเรียน</title>
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
        $id_student = $_SESSION['id_student'];
        include "../connectdb.php";
        $sql_student = "SELECT * FROM tb_student_join WHERE id_student = '$id_student'";
        $result = mysqli_query($con,$sql_student);
        $row = mysqli_fetch_assoc($result);

        $sql_prefix ="SELECT * FROM `tb_prefix`";
        $result_prefix = mysqli_query($con,$sql_prefix);

        $sql_department ="SELECT * FROM `tb_department`";
        $result_department = mysqli_query($con,$sql_department);

        $sql_position ="SELECT * FROM `tb_position` WHERE id_position != 1 AND id_position != 2 ";
        $result_position = mysqli_query($con,$sql_position);
    ?>
      <div class="logo-details">
        <i class='bx bx-user-circle'></i>
        <span class="logo_name"><?php echo $_SESSION['position_student'] ;?></span>
      </div>
      <ul class="nav-links">
      <li>
            <a href="index.php" class="active">
              <i class='bx bx-book-content'></i>
              <span class="links_name">ขออนุญาต</span>
            </a>
          </li>
          <li>
            <a href="view_request.php" class="active">
              <i class='bx bx-book-reader'></i>
              <span class="links_name">ดูสถานะคำขออนุญาต</span>
            </a>
          </li>
          <li>
            <a href="view_history_student.php" class="active">
              <i class='bx bx-history'></i>
              <span class="links_name">ดูประวัติการขออนุญาต</span>
            </a>
          </li>
          <li>
            <a href="view_profile.php">
              <i class="bx bx-cog"></i>
              <span class="links_name">ตั้งค่าข้อมูลส่วนตัว</span>
            </a>
          </li>
          <li class="log_out">
            <a href="logout.php">
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
          <span class="dashboard">ตั้งค่าข้อมูลส่วนตัว</span>
        </div>
      </nav>
      <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
            <div class="container">
                    <h2>ข้อมูลส่วนตัว</h2>
                        <form action="save_edit_password.php" method="post">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="email">รหัสประจำตัว</label>
                                    <input type="text" class="form-control" id="id_student" name="id_student" disabled value="<?php echo $row['id_student'] ;?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="prefix">คำนำหน้า</label>
                                    <input type="text" class="form-control" id="prefix_name" name="prefix_name" disabled value="<?php echo $row['prefix_name'] ;?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="email">ชื่อ</label>
                                    <input type="text" class="form-control" id="s_realname" name="s_realname" disabled value="<?php echo $row['s_realname'] ;?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="email">นามสกุล</label>
                                    <input type="text" class="form-control" id="s_surname" name="s_surname" disabled value="<?php echo $row['s_surname'] ;?>">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <label for="email">รหัสผ่าน</label>
                                    <input type="text" class="form-control" id="s_password" name="s_password" value="<?php echo $row['s_password'] ;?>">
                                </div>
                                <div class="col-md-3">
                                        <label for="department">แผนก</label>
                                        <input type="text" class="form-control" id="id_student" name="id_department" disabled value="<?php echo $row['d_name'] ;?>">
                                        <input type="hidden" name="id_department" value="<?php echo $row['id_department'];?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="department">ระดับชั้น</label>
                                    <input type="text" class="form-control" id="id_student" name="id_gradelevel" disabled value="<?php echo $row['g_name'] ;?>">
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            <button type="submit" class="btn btn-success mt-3"><i class='bx bx-save'></i> บันทึก</button>
                        </form>
                  </div>
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
