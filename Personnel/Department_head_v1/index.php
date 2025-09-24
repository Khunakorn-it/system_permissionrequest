<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style type="text/css">
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: auto;
            max-width: auto;
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
        $id_department_personnel = $_SESSION['id_department'] ;
        $sql_department_personnel = "SELECT * FROM tb_department WHERE id_department = $id_department_personnel";
        $result_department_personnel = mysqli_query($con,$sql_department_personnel);
        $row_department_personnel = mysqli_fetch_assoc($result_department_personnel);

        $sql_dashboard = "SELECT COUNT(r.id_request) as sum_request, s.g_name as gradelevel
        FROM tb_request_join as r
        LEFT JOIN tb_student_join as s ON r.id_student = s.id_student
        WHERE r.id_department = $id_department_personnel
        GROUP BY r.id_gradelevel;";
        $result_dashboard = mysqli_query($con, $sql_dashboard);
        $data = array(); // เก็บข้อมูลในรูปแบบ array
        while ($row = mysqli_fetch_assoc($result_dashboard)) {
            $data[] = $row; // เพิ่มแถวข้อมูลลงใน array
        }
    ?>
    <nav class="navbar navbar-expand-sm bg-danger navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand"><?php echo $_SESSION['position_name']."&nbsp;".$row_department_personnel['d_name'];?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav justify-content-end">
                    <a href="../logout.php" class="btn btn-dark">ออกจากระบบ</a>
                </li>  
            </ul>
        </div>
    </div>
    </nav>
    <div class="container">
        <figure class="highcharts-figure">
            <div id="dashboard"></div>
            <p class="highcharts-description"></p>
        </figure>
            <a href="view_student_request.php" class="btn btn-success mt-2">ดูคำขออนุญาตของนักเรียนนักศึกษา</a>
            <a href="view_student_history.php" class="btn btn-info mt-2">ดูประวัติการขออนุญาตของนักเรียนนักศึกษา</a>
            <a href="data_student.php" class="btn btn-warning mt-2">จัดการข้อมูลนักเรียนนักศึกษาภายในแผนก</a>
            <a href="data_personnel.php" class="btn btn-warning mt-2">จัดการข้อมูลบุคลากรภายในแผนก</a>
            <a href="past_report.php" class="btn btn-primary mt-2">ดูรายงานย้อนหลัง</a>
            <a href="../edit_password.php?lokation=Department_head" class="btn btn-secondary mt-2">เปลี่ยนรหัสผ่าน</a>
    </div>
    <script type="text/javascript">
        var gradelevel = <?php echo json_encode(array_column($data, 'gradelevel')); ?>; // นำเอา user_type ไปเก็บใน JavaScript array
        var sum_request = <?php echo json_encode(array_column($data, 'sum_request'), JSON_NUMERIC_CHECK); ?>; // นำเอา user_count ไปเก็บใน JavaScript array
        Highcharts.chart('dashboard', {
        chart: {
        type:'column'
        },
        title: {
            text: 'รายงานการขออนุญาตของนักเรียนนักศึกษาทั้งหมด',
            align: 'center'
        },
        yAxis: {
            title: {
                text: 'จำนวนคำขอ'
            }
        },

        xAxis: {
            categories: gradelevel
        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        series: [{
            name: 'นักเรียนนักศึกษา',
            data: sum_request
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

        });
    </script>
</body>
</html>
