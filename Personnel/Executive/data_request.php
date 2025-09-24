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
    <style>
        .textcenter { 
            text-align: center
        }
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 360px;
            max-width: 1000px;
            margin: 1em auto;
        }
        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>
  </head>
  <body>
    <script src="../../Highcharts/highcharts.js"></script>
    <script src="../../Highcharts/modules/data.js"></script>
    <script src="../../Highcharts/modules/series-label.js"></script>
    <script src="../../Highcharts/modules/exporting.js"></script>
    <script src="../../Highcharts/modules/export-data.js"></script>
    <script src="../../Highcharts/modules/accessibility.js"></script>
    <?php
        include "../../connectdb.php";
       $sql = "SELECT r_dey, COUNT(id_request) AS sum_request
       FROM tb_request_join
       GROUP BY r_dey;";
       $result = mysqli_query($con,$sql);
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
            <span class="links_name">รายงานสถิติรวม</span>
          </a>
        </li>
        <li>
          <a href="past_report.php">
            <i class='bx bx-bar-chart-alt'></i>
            <span class="links_name">รายงานสถิติรายวัน</span>
          </a>
        </li>
        <li>
          <a href="past_report.php">
            <i class="bx bx-coin-stack"></i>
            <span class="links_name">รายงานสถิติย้อนหลัง</span>
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
          <span class="dashboard">รายงานสถิติย้อนหลัง</span>
        </div>
      </nav>
      <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
              <input class="form-control mt-3" id="myInput" type="text" placeholder="ค้นหาข้อมูล">
              <table class="table table-hover">
                  <thead>
                      <tr>
                          <th>วันเดือนปี</th>
                          <th>จำนวนการขออนุญาต</th>
                          <th>รายละเอียด</th>
                      </tr>
                  </thead>
                  <tbody id="myTable">
                      <?php
                          while($row_request = $result->fetch_assoc()):
                      ?>
                      <tr>
                          <td><?php echo $row_request['r_dey'];?></td>
                          <td><?php echo $row_request['sum_request'];?></td>
                          <td>
                              <div class="btn-group">
                                  <a href="viwe_request.php?dey=<?php echo $row_request['r_dey'];?>" class="btn btn-primary"><i class='bx bx-book-open'></i> รายงานสถิติ</a>
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
