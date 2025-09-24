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
    <script src="../../../Highcharts/highcharts.js"></script>
    <script src="../../../Highcharts/modules/data.js"></script>
    <script src="../../../Highcharts/modules/series-label.js"></script>
    <script src="../../../Highcharts/modules/exporting.js"></script>
    <script src="../../../Highcharts/modules/export-data.js"></script>
    <script src="../../../Highcharts/modules/accessibility.js"></script>
    <div class="sidebar">
    <?php 
        $id_personnel = $_SESSION['id_personnel'];
        include "../../connectdb.php";
        $sql_personnel = "SELECT * FROM tb_personnel_join WHERE id_personnel = '$id_personnel'";
        $result = mysqli_query($con,$sql_personnel);
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
          <span class="dashboard">ตั้งค่าข้อมูลส่วนตัว</span>
        </div>
      </nav>
      <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
            <div class="container">
                    <h2>ข้อมูลส่วนตัว</h2>
                        <form action="update_profile.php" method="post">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="email">รหัสประจำตัว</label>
                                    <input type="text" class="form-control" id="id_personnel" name="id_personnel" disabled value="<?php echo $row['id_personnel'] ;?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="prefix">คำนำหน้า</label>
                                    <select class="form-control" id="prefix" name="id_prefix">
                                        <?php while($row_prefix = $result_prefix->fetch_assoc()):?>
                                            <option value="<?php echo $row_prefix['id_prefix'] ;?>" <?php echo ($row_prefix['prefix_name'] == $row['prefix_name']) ? 'selected' : ''; ?>>
                                                <?php echo $row_prefix['prefix_name'];?>
                                            </option>
                                        <?php endwhile ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="email">ชื่อ</label>
                                    <input type="text" class="form-control" id="p_realname" name="p_realname" value="<?php echo $row['p_realname'] ;?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="email">นามสกุล</label>
                                    <input type="text" class="form-control" id="p_surname" name="p_surname" value="<?php echo $row['p_surname'] ;?>">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <label for="email">รหัสผ่าน</label>
                                    <input type="text" class="form-control" id="p_password" name="p_password" value="<?php echo $row['p_password'] ;?>">
                                </div>
                                <div class="col-md-3">
                                        <label for="department">แผนก</label>
                                        <input type="text" class="form-control" id="id_personnel" name="id_department" disabled value="<?php echo $row['d_name'] ;?>">
                                        <input type="hidden" name="id_department" value="<?php echo $row['id_department'];?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="department">ตำแหน่ง</label>
                                    <input type="text" class="form-control" id="id_personnel" name="id_position" disabled value="<?php echo $row['p_name'] ;?>">
                                    <input type="hidden" name="id_position" value="<?php echo $row['id_position'];?>">
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
