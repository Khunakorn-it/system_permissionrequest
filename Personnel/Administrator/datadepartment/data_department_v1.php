<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <style>
        th{
            text-align: center;
        }
        td{
            text-align: center;
        }
        .textcenter { 
            text-align: center
        }
    </style>
</head>
<body>
<?php //เชื่อมdatabase
    include "../../../connectdb.php";
    $sql = "SELECT * FROM tb_department WHERE id_department != 1 ";
    $result = mysqli_query($con,$sql);
?>
    <div class="container-fluid mt-3">
        <h1 class="textcenter">ตารางแสดงข้อมูลแผนก</h1>
        <a href="add_department.php" class="btn btn-success" >เพิ่มข้อมูล</a>
        <a href="../index.php" class="btn btn-danger" >ออก</a>
        <input class="form-control mt-3" id="myInput" type="text" placeholder="ค้นหาข้อมูล">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>รหัสแผนก</th>
                    <th>ชื่อแผนก</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php
                    while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $row['id_department'];?></td>
                    <td><?php echo $row['d_name'];?></td>
                    <td>
                        <div class="btn-group">
                            <a href="edit_department.php?id=<?php echo $row['id_department'];?>" class="btn btn-primary">แก้ไข</a>
                            <a href="delete_department.php?id=<?php echo $row['id_department']; ?>" class="btn btn-danger" onclick="return confirm('Are your Sure to Delete')">ลบ</a>
                        </div>
                    </td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
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