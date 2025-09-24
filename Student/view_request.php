<?php session_start() ;?>
<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
  <body>
  <?php  
        include "../connectdb.php";
        $Location = "view_request.php";
        date_default_timezone_set("Asia/Bangkok");
        $date = date("d-m-Y");

        $sql_expired = "UPDATE `tb_request` SET `id_requeststatus` = '4', `id_personnel` = '-' WHERE r_dey != '$date' AND id_requeststatus = '1'";
        mysqli_query($con,$sql_expired);

        $id_student = $_SESSION['id_student'];
        $sql = "SELECT * FROM tb_request_join 
        WHERE id_student = $id_student AND r_dey = '$date' 
        ORDER BY `tb_request_join`.`id_request` DESC";  
        $result = mysqli_query($con,$sql);
    ?>
    <div class="sidebar">
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
          <span class="dashboard">ดูสถานะคำขออนุญาต</span>
        </div>
      </nav>
      <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
            <input class="form-control mt-3 fas" id="myInput" type="text" placeholder="&#xf002; ค้นหาข้อมูล">
            <table class="table table-hover text-center mt-3">
                    <thead>
                        <tr>
                            <th>ID_request</th>
                            <th>เวลา</th>
                            <th>สถาณะคำขอ</th>
                            <th>รายละเอียด</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php 
                        while($row = $result->fetch_assoc()):
                            $id_prefix = $row['id_prefix'];
                            //connect database name tb_perfix
                            $sql_prefix = "SELECT * FROM tb_prefix WHERE id_prefix = $id_prefix";
                            $result_prefix = mysqli_query($con,$sql_prefix);
                            $row_prefix = mysqli_fetch_assoc($result_prefix);
                        ?>
                            <tr>
                                <td><?php echo $row['id_request']; ?></td>
                                <td><?php echo $row['Time'];?></td>
                                <td><?php echo $row['requeststatus_name'];?></td>
                                <?php 
                                    if($row['requeststatus_name'] == "อนุมัติแล้ว"){
                                      echo "<td><a href='view_details.php?id=$row[id_request]&Location=$Location' class='btn btn-info'><i class='bx bxs-file-doc'></i> ดูเอกสาร</a></td>" ;
                                    }else{
                                      echo "";
                                    }
                                ?>
                            </tr>
                        <?php endwhile; ?>
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
