<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php //เชื่อมdatabase
    include "../../connectdb.php";
    $id_department = $_SESSION['id_department'];
    $id_student = $_GET['id'];
    $sql = "SELECT * FROM tb_student_join
    WHERE id_student = '$id_student'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    //เชื่อมdatabaseชื่อ tb_prefix
    $sql_prefix ="SELECT * FROM `tb_prefix` ";
    $result_prefix = mysqli_query($con,$sql_prefix);
    //เชื่อมdatabaseชื่อ tb_gradelevel
    $sql_gradelevel ="SELECT * FROM `tb_gradelevel` ORDER BY `tb_gradelevel`.`g_name` ASC";
    $result_gradelevel = mysqli_query($con,$sql_gradelevel);
    //เชื่อมdatabaseชื่อ tb_department
    $sql_department ="SELECT * FROM `tb_department`";
    $result_department = mysqli_query($con,$sql_department);
    //เชื่อมdatabaseชื่อ tb_department
    $sql_position ="SELECT * FROM `tb_position` WHERE id_position BETWEEN 1 AND 2 ";
    $result_position = mysqli_query($con,$sql_position);
    //เชื่อมdatabaseชื่อ tb_personnel_loin
    $sql_personnel = "SELECT * FROM tb_personnel_join WHERE id_department = $id_department";
    $result_personnel = mysqli_query($con,$sql_personnel);
?>    
    <div class="container">
        <h1>แก้ไขข้อมูล</h1>
        <form action="update_student.php" method="post">
            <div class="form-group">
                <label for="id_student">รหัสประจำตัว</label>
                <input type="text" class="form-control" id="id_student" name="id_student" value="<?php echo $row['id_student'];?>">
            </div>
            <div class="form-group">
                <label for="prefix">คำนำหน้า</label>
                <select class="form-control" id="prefix" name="id_prefix">
                <?php while($row_prefix = $result_prefix->fetch_assoc()):?>
                    <option value="<?php echo $row_prefix['id_prefix'] ;?>" <?php echo ($row_prefix['prefix_name'] == $row['prefix_name']) ? 'selected' : ''; ?>>
                        <?php echo $row_prefix['prefix_name'];?>
                    </option>
                <?php endwhile ?>
                </select>
            </div>
            <div class="form-group">
                <label for="s_realnam">ชื่อ</label>
                <input type="text" class="form-control" id="s_realname" name="s_realname" value="<?php echo $row['s_realname'];?>">
            </div>
            <div class="form-group">
                <label for="s_surname">นามสกุล</label>
                <input type="text" class="form-control" id="s_surname" name="s_surname" value="<?php echo $row['s_surname'];?>">
            </div>
            <div class="form-group">
                <label for="s_password">รหัสผ่าน</label>
                <input type="text" class="form-control" id="s_password" name="s_password" value="<?php echo $row['s_password'];?>">
            </div>
            <div class="form-group">
                <label for="gradelevel">ระดับชั้น</label>
                <select class="form-control" id="gradelevel" name="id_gradelevel">
                <?php while($row_gradelevel = $result_gradelevel->fetch_assoc()):?>
                    <option value="<?php echo $row_gradelevel['id_gradelevel'] ;?>" <?php echo ($row_gradelevel['g_name'] == $row['g_name']) ? 'selected' : ''; ?>>
                        <?php echo $row_gradelevel['g_name'];?>
                    </option>
                <?php endwhile ?>
                </select>
            </div>
            <div class="form-group">
                <label for="position">ตำแหน่ง</label>
                <select class="form-control" id="id_position" name="id_position">
                <?php while($row_position = $result_position->fetch_assoc()):?>
                    <option value="<?php echo $row_position['id_position'] ;?>" <?php echo ($row_position['p_name'] == $row['p_name']) ? 'selected' : ''; ?>>
                        <?php echo $row_position['p_name'];?>
                    </option>
                <?php endwhile ?>
                </select>
            </div>
            <div class="form-group">
                <label for="personnel">ครูที่ปรึกษา</label>
                <select class="form-control" id="id_personnel" name="id_personnel">
                <?php while($row_personnel = $result_personnel->fetch_assoc()):?>
                    <option value="<?php echo $row_personnel['id_personnel'] ;?>" <?php echo ($row_personnel['id_personnel'] == $row['id_personnel']) ? 'selected' : ''; ?>>
                        <?php echo $row_personnel['prefix_name'].$row_personnel['p_realname'].$row_personnel['p_surname'];?>
                    </option>
                <?php endwhile ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <input type="hidden" name="id_hid_student" value="<?php echo $row['id_student'];?>">
        </form>
    </div>
</body>
</html>
