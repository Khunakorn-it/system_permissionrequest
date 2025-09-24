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
        $id_department = $_SESSION['id_department'];
        include "../../connectdb.php";
        $sql = "SELECT * FROM tb_student_join WHERE id_department = $id_department ORDER BY g_name ASC";
        $result = mysqli_query($con,$sql);
        $num = mysqli_num_rows($result);
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
                <a href="add_student.php" class="btn btn-success" ><i class='fas fa-user-plus'></i> เพิ่มข้อมูล</a>
                <input class="form-control mt-3" id="myInput" type="text" placeholder="ค้นหาข้อมูล">
                <table class="table table-hover mt-3">
                    <thead>
                        <tr>
                            <th>รหัสประจำตัวนักศึกษา</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>รหัสผ่าน</th>
                            <th>ระดับชั้น</th>
                            <th>แผนก</th>
                            <th>ตำแหน่ง</th>
                            <th>รหัสประจำตัวครูที่ปรึกษา</th>
                            <th>ครูที่ปรึกษา</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php
                            while($row = $result->fetch_assoc()):
                                $id_prefix = $row['id_prefix'];
                                if($id_prefix == ""){
                                    $prefix_name = "";
                                }else{
                                    $sql_prefix = "SELECT * FROM tb_prefix WHERE id_prefix = $id_prefix";
                                    $result_prefix = mysqli_query($con,$sql_prefix);
                                    $row_prefix = mysqli_fetch_assoc($result_prefix);
                                    $prefix_name = $row_prefix['prefix_name'];
                                }
                        ?>
                        <tr>
                            <td><?php echo $row['id_student'];?></td>
                            <td><?php echo $row['prefix_name'].$row['s_realname']."&nbsp;".$row['s_surname'];?></td>
                            <td><?php echo $row['s_password'];?></td>
                            <td><?php echo $row['g_name'];?></td>
                            <td><?php echo $row['d_name'];?></td>
                            <td><?php echo $row['p_name'];?></td>
                            <td><?php echo $row['id_personnel'];?></td>
                            <td><?php echo $prefix_name.$row['p_realname']."&nbsp;".$row['p_surname'];?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="view_student_history_request.php?id=<?php echo $row['id_student'];?>" class="btn btn-warning"><i class='bx bx-show'></i> ดูประวัติ</a>
                                    <a href="edit_student.php?id=<?php echo $row['id_student'];?>" class="btn btn-primary"><i class='far fa-edit'></i> แก้ไข</a>
                                    <a href="delete_student.php?id=<?php echo $row['id_student']; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบใช่หรือไม')"><i class="far fa-trash-alt"></i> ลบ</a>
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
