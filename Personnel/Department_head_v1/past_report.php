<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php
        include "../../connectdb.php";
        $id_department = $_SESSION['id_department'];
        $sql = "SELECT r_dey, COUNT(id_request) AS sum_request
        FROM tb_request_join
        WHERE id_department = $id_department
        GROUP BY r_dey;";
        $result = mysqli_query($con,$sql);
    ?>
    <div class="container">
    <h1 class="text-center">ตารางแสดงจำนวนการขออนุญาตของแต่ล่ะวัน</h1>
        <a href="index.php" class="btn btn-danger" >ออก</a>
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
                            <a href="viwe_request.php?dey=<?php echo $row_request['r_dey'];?>" class="btn btn-primary">ดูรายละเอียด</a>
                        </div>
                    </td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</body>
</html>