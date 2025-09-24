<?php session_start() ;?>
<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ระบบขออนุญาตออกนอกวิทยาลัย</title>
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
        date_default_timezone_set("Asia/Bangkok");
        $time = date ('H:i');
        $date = date("d-m-Y");
        $id_request = $_GET['id'];
        include "../connectdb.php";
        $sql_reqest = "SELECT * FROM tb_request_join WHERE id_request = '$id_request'";
        $result_request = mysqli_query($con,$sql_reqest);
        $row_request = mysqli_fetch_assoc($result_request) ; 
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
          <span class="dashboard">แก้ไขคำขออนุญาต</span>
        </div>
      </nav>
      <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
              <form action="save_request.php" method="post">
                  <div class="form-group">
                      <h3>เหตุผลในการขออนุญาต</h3>
                      <textarea class="form-control" rows="5" name="reason" value="<?php echo $time ;?>"></textarea>
                  </div>
                  <h3>เวลาที่ขออนุญาตตั้งแต่เวลา</h3>
                  <div class="row">
                      <div class="col-md-4">
                          <label for="in">เวลาออก</label>
                          <input type="Time" class="form-control" id="time_in" name="time_out" value="<?php echo $time ;?>">
                      </div>
                      <div class="col-md-4">
                          <label for="in">เวลาเข้า</label>
                          <input type="Time" class="form-control" id="time_in" name="time_in">
                      </div>
                  </div>
                  <button type="submit" type="button" class="btn btn-primary mt-2">ขออนุญาต</button>
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
