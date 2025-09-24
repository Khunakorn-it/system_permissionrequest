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
    $id_department = $_SESSION['id_department'];
    include "../../connectdb.php";
    $sql = "SELECT * FROM tb_personnel_join WHERE id_department = $id_department";
    $result = mysqli_query($con,$sql);
    $num = mysqli_num_rows($result);
?>
    <div class="container-fluid">
        <h1 class="textcenter">ข้อมูลบุคลากรของแผนก</h1>
        <a href="add_personnel.php" class="btn btn-success" >เพิ่มข้อมูล</a>
        <a href="index.php" class="btn btn-danger" >ออก</a>
        <input class="form-control mt-3" id="myInput" type="text" placeholder="ค้นหาข้อมูล">
        <table class="table table-hover mt-3">
            <thead>
                <tr>
                    <th>รหัสประจำบุคลากร</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>รหัสผ่าน</th>
                    <th>แผนก</th>
                    <th>ตำแหน่ง</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_personnel'];?></td>
                    <td><?php echo $row['prefix_name'].$row['p_realname']."&nbsp;".$row['p_surname'];?></td>
                    <td><?php echo $row['p_password'];?></td>
                    <td><?php echo $row['d_name'];?></td>
                    <td><?php echo $row['p_name'];?></td>
                    <td>
                        <div class="btn-group">
                            <a href="edit_personnel.php?id=<?php echo $row['id_personnel'];?>" class="btn btn-primary">แก้ไข</a>
                            <a href="delete_personnel.php?id=<?php echo $row['id_personnel']; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบใช่หรือไม')">ลบ</a>
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