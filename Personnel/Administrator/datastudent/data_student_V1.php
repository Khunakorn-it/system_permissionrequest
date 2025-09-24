<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0081d5079a.js" crossorigin="anonymous"></script>
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
    $sql = "SELECT * FROM tb_student_join as s";
    $result = mysqli_query($con,$sql);
    $num = mysqli_num_rows($result);
?>
    <div class="container-fluid">
        <h1 class="textcenter">ข้อมูลนักเรียนนักศึกษา</h1>
        <a href="add_student.php" class="btn btn-success"><i class='fas fa-user-plus'></i> เพิ่มข้อมูล</a>
        <a href="../" class="btn btn-danger" ><i class="fas fa-home"></i> ออก</a>
        <input class="form-control mt-3 fas" id="myInput" type="text" placeholder="&#xf002; ค้นหาข้อมูล">
        <table class="table table-hover mt-3">
            <thead>
                <tr>
                    <th>รหัสประจำตัวนักศึกษา</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>รหัสผ่าน</th>
                    <th>ระดับชั้น</th>
                    <th>แผนก</th>
                    <th>ตำแหน่ง</th>
                    <th>รหัสประจำตัวครูที่ปรึกษา</th>
                    <th>ครูที่ปรึกษา</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php
                    while($row = $result->fetch_assoc()):
                        $id_prefix = $row['id_prefix'];
                        if($id_prefix == ""){
                            $prefix_name = "";
                        }else{
                            $sql_prefix = "SELECT * FROM tb_prefix WHERE id_prefix = $id_prefix";
                            $result_prefix = mysqli_query($con,$sql_prefix);
                            $row_prefix = mysqli_fetch_assoc($result_prefix);
                            $prefix_name = $row_prefix['prefix_name'];
                        }
                ?>
                <tr>
                    <td><?php echo $row['id_student'];?></td>
                    <td><?php echo $row['prefix_name'].$row['s_realname']."&nbsp;".$row['s_surname'];?></td>
                    <td><?php echo $row['s_password'];?></td>
                    <td><?php echo $row['g_name'];?></td>
                    <td><?php echo $row['d_name'];?></td>
                    <td><?php echo $row['p_name'];?></td>
                    <td><?php echo $row['id_personnel'];?></td>
                    <td><?php echo $prefix_name.$row['p_realname']."&nbsp;".$row['p_surname'];?></td>
                    <td>
                        <div class="btn-group">
                            <a href="edit_student.php?id=<?php echo $row['id_student'];?>" class="btn btn-primary"><i class='far fa-edit'></i> แก้ไข</a>
                            <a href="delete_student.php?id=<?php echo $row['id_student']; ?>" class="btn btn-danger" onclick="return confirm('Are your Sure to Delete')"><i class="far fa-trash-alt"></i> ลบ</a>
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