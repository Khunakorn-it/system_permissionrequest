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
    $sql = "SELECT * FROM tb_position ";
    $result = mysqli_query($con,$sql);
?>
    <div class="container-fluid mt-3">
        <h1 class="textcenter">ตารางแสดงข้อมูลตำแหน่ง</h1>
        <a href="../" class="btn btn-danger" >ออก</a>
        <input class="form-control mt-3" id="myInput" type="text" placeholder="ค้นหาข้อมูล">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>รหัสตำแหน่ง</th>
                    <th>ชื่อตำแหน่ง</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php
                    while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $row['id_position'];?></td>
                    <td><?php echo $row['p_name'];?></td>
                    <td>
                        <div class="btn-group">
                            <a href="edit_position.php?id=<?php echo $row['id_position'];?>" class="btn btn-primary">แก้ไข</a>
                            <a href="delete_position.php?id=<?php echo $row['id_position']; ?>" class="btn btn-danger" onclick="return confirm('Are your Sure to Delete')">ลบ</a>
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