<?php 
  session_start(); 
  if (empty($_SESSION['id_student'])){
      echo "<meta http-equiv = 'refresh' content ='0;url = Login_Student.php'>";
  }
?>
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
        $id_student = $_SESSION['id_student'];
        include "../connectdb.php";
        $sql = "SELECT * FROM tb_student WHERE id_student = $id_student";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($result);

        // $sql_time = "SELECT * FROM tb_time";
        // $result_time = mysqli_query($con,$sql_time);
        date_default_timezone_set("Asia/Bangkok");
        $time = date ('H:i');
        $date = date("d-m-Y");
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
          <span class="dashboard">ขออนุญาต</span>
        </div>
      </nav>
      <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
              <form action="save_request.php" method="post">
                  <div class="form-group">
                      <h3>เหตุผลในการขออนุญาต</h3>
                      <div class="form-group">
                      <div class="form-check">
                          <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="reason" value="ออกไปรับประทานอาหารด้านนอก">ออกไปรับประทานอาหารด้านนอก
                          </label>
                      </div>
                      <div class="form-check">
                          <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="reason" value="ออกไปปริ้นงาน">ออกไปปริ้นงาน
                          </label>
                      </div>
                      <div class="form-check">
                          <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="reason" value="ลืมหนังสือ/สมุด">ลืมหนังสือ/สมุด
                          </label>
                      </div>
                      <div class="form-check">
                          <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="reason" value="อื่นๆ">อื่นๆ
                          </label>
                          <input type="text" name="reason_p" class="form-control form-control-sm" placeholder="ระบุ" style="display: none;">
                      </div>
                  </div>

                  <script>
                      document.addEventListener('DOMContentLoaded', function() {
                          const radio = document.querySelectorAll('input[name="reason"]');
                          const textInput = document.querySelector('input[name="reason_p"]');

                          radio.forEach(function(radioBtn) {
                              radioBtn.addEventListener('change', function() {
                                  if (this.value === 'อื่นๆ') {
                                      textInput.style.display = 'inline-block';
                                  } else {
                                      textInput.style.display = 'none';
                                      textInput.value = ''; // Clear the input value if it's not selected
                                  }
                              });
                          });
                      });
                  </script>

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
    <script>
      document.addEventListener('DOMContentLoaded', function() {
          const radio = document.querySelector('input[type="radio"][name="reason"]');
          const textInput = document.querySelector('input[type="text"][name="reason_p"]');

          radio.addEventListener('change', function() {
              if (this.value === 'อื่นๆ') {
                  textInput.style.display = 'inline-block';
              } else {
                  textInput.style.display = 'none';
                  textInput.value = ''; // Clear the input value if it's not selected
              }
          });
      });
    </script>

  </body>
</html>
