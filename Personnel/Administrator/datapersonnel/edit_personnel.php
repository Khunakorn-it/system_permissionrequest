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
        $id_personnel = $_GET['id'];
        $sql = "SELECT * FROM tb_personnel_join WHERE id_personnel = '$id_personnel'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($result);
        //เชื่อมdatabaseชื่อ tb_prefix
        $sql_prefix ="SELECT * FROM `tb_prefix`";
        $result_prefix = mysqli_query($con,$sql_prefix);
        //เชื่อมdatabaseชื่อ tb_department
        $sql_department ="SELECT * FROM `tb_department`";
        $result_department = mysqli_query($con,$sql_department);
        //เชื่อมdatabaseชื่อ tb_department
        $sql_position ="SELECT * FROM `tb_position` WHERE id_position != 1 AND id_position != 2 ";
        $result_position = mysqli_query($con,$sql_position);
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
          <a href="data_student.php">
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
          <a href="../datadepartment/data_department.php">
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
          <span class="dashboard">จัดการข้อมูลบุคลากร</span>
        </div>
      </nav>
      <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
                <h1>แก้ไขข้อมูลบุคลากร</h1>
                <form action="update_personnel.php" method="post">
                    <div class="form-group">
                        <label for="id_personnel">รหัสประจำตัวบุคลากร</label>
                        <input type="text" class="form-control" id="id_personnel" name="id_personnel" value="<?php echo $row['id_personnel'];?>">
                    </div>
                    <div class="form-group">
                        <label for="prefix">คำนำหน้า</label>
                        <select class="form-control" id="prefix" name="id_prefix">
                          <?php while($row_prefix = $result_prefix->fetch_assoc()):?>
                              <option value="<?php echo $row_prefix['id_prefix'] ;?>" <?php echo ($row_prefix['prefix_name'] == $row['prefix_name']) ? 'selected' : ''; ?>>
                                  <?php echo $row_prefix['prefix_name'];?>
                              </option>
                          <?php endwhile ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="p_realname">ชื่อ</label>
                        <input type="text" class="form-control" id="p_realname" name="p_realname" value="<?php echo $row['p_realname'];?>">
                    </div>
                    <div class="form-group">
                        <label for="p_surname">นามสกุล</label>
                        <input type="text" class="form-control" id="p_surname" name="p_surname" value="<?php echo $row['p_surname'];?>">
                    </div>
                    <div class="form-group">
                        <label for="p_password">รหัสผ่าน</label>
                        <input type="text" class="form-control" id="p_password" name="p_password" value="<?php echo $row['p_password'];?>">
                    </div>
                    <div class="form-group">
                        <label for="department">แผนก</label>
                        <select class="form-control" id="id_department" name="id_department">
                        <?php while($row_department = $result_department->fetch_assoc()):?>
                            <option value="<?php echo $row_department['id_department'] ;?>" <?php echo ($row_department['d_name'] == $row['d_name']) ? 'selected' : ''; ?>>
                                <?php echo $row_department['d_name'];?>
                            </option>
                        <?php endwhile ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="position">ตำแหน่ง</label>
                        <select class="form-control" id="id_position" name="id_position">
                        <?php while($row_position = $result_position->fetch_assoc()):?>
                            <option value="<?php echo $row_position['id_position'] ;?>" <?php echo ($row_position['p_name'] == $row['p_name']) ? 'selected' : ''; ?>>
                                <?php echo $row_position['p_name'];?>
                            </option>
                        <?php endwhile ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class='bx bx-save' ></i> บันทึก</button>
                    <a href="data_personnel.php" class="btn btn-danger"><i class='bx bx-x' ></i> ยกเลิก</a>
                    <input type="hidden" name="id_hid_personnel" value="<?php echo $row['id_personnel'];?>">
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
