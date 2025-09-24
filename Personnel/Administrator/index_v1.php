<?php 
session_start(); 
if (empty($_SESSION['id_personnel'])){
    echo "<meta http-equiv = 'refresh' content ='0;url = ../Login_Personnel.php'>";
}
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
    <script src="https://kit.fontawesome.com/0081d5079a.js" crossorigin="anonymous"></script>
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
        $sql_student = "SELECT * FROM tb_student";
        $result_student = mysqli_query($con, $sql_student);
        $num_student = mysqli_num_rows($result_student);

        $sql_personnel = "SELECT * FROM tb_personnel";
        $result_personnel = mysqli_query($con, $sql_personnel);
        $num_personnel = mysqli_num_rows($result_personnel);

        $sql_dashboard = "SELECT 'Student' AS user_type, COUNT(id_student) AS user_count FROM tb_student_join
                UNION ALL
                SELECT 'Personnel' AS user_type, COUNT(id_personnel) AS user_count FROM tb_personnel_join;";
        $result_dashboard = mysqli_query($con, $sql_dashboard);
        $data = array(); // เก็บข้อมูลในรูปแบบ array
        while ($row = mysqli_fetch_assoc($result_dashboard)) {
            $data[] = $row; // เพิ่มแถวข้อมูลลงใน array
        }
    ?>        
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
            <a class="navbar-brand"><?php echo $_SESSION['position_name']; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="../logout.php" class="btn btn-dark">ออกจากระบบ</a>
                    </li>
                </ul>
            </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 bg-danger">
                <ul class="nav flex-column ">
                        <li class="nav-item ">
                            <a class="nav-link text-white" href="datastudent/data_student.php">ข้อมูลนักเรียนและนักศึกษา</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="datapersonnel/data_personnel.php">ข้อมูลบุคลากร</a>
                        </li>
                        <li>
                            <a class="nav-link text-white" href="datadepartment/data_department.php">ข้อมูลแผนก</a>
                        </li>
                        <li>
                            <a class="nav-link text-white" href="dataposition/data_position.php">ข้อมูลตำแหน่ง</a>
                        </li>
                        <li>
                            <a class="nav-link text-white" href="datagradelevel/data_gradelevel.php">ข้อมูลระดับชั้น</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../edit_password.php?lokation=Administrator"><i class='fas fa-key'></i> เปลี่ยนรหัสผ่าน</a>
                        </li>
                </ul>
            </div>
            <div class="col-md-10 mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="jumbotron">
                                <h1 class="text-center">จำนวนนักเรียน <?php echo $num_student ;?> คน</h1>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="jumbotron">
                                <h1 class="text-center">จำนวนบุคลากร <?php echo $num_personnel ;?> คน</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <figure class="highcharts-figure">
                            <div id="dashboard"></div>
                            <p class="highcharts-description">
                            </p>
                        </figure>
                    </div>
                </div>
            </div>
    </div>
    
    <script type="text/javascript">
        var userTypes = <?php echo json_encode(array_column($data, 'user_type')); ?>; // นำเอา user_type ไปเก็บใน JavaScript array
        var userCounts = <?php echo json_encode(array_column($data, 'user_count'), JSON_NUMERIC_CHECK); ?>; // นำเอา user_count ไปเก็บใน JavaScript array
        Highcharts.chart('dashboard', {
        chart: {
        type:'column'
        },
        title: {
            text: 'รายงานจำนวนผู้ใช้ระบบ',
            align: 'center'
        },
        yAxis: {
            title: {
                text: 'จำนวนผู้ใช้ในระบบ'
            }
        },

        xAxis: {
            categories: userTypes
        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        series: [{
            name: 'ผู้ใช้งานระบบ',
            data: userCounts
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
