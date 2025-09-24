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
    $id_personnel = $_GET['id'];
    $sql = "SELECT * FROM tb_personnel_join WHERE id_personnel = '$id_personnel'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    //เชื่อมdatabaseชื่อ tb_prefix
    $sql_prefix ="SELECT * FROM `tb_prefix`";
    $result_prefix = mysqli_query($con,$sql_prefix);
    //เชื่อมdatabaseชื่อ tb_department
    $sql_department ="SELECT * FROM `tb_department`";
    $result_department = mysqli_query($con,$sql_department);
    //เชื่อมdatabaseชื่อ tb_department
    $sql_position ="SELECT * FROM `tb_position` WHERE id_position = 3 or id_position = 4 ";
    $result_position = mysqli_query($con,$sql_position);
?>    
    <div class="container">
        <h1>แก้ไขข้อมูล</h1>
        <form action="update_personnel.php" method="post">
            <div class="form-group">
                <label for="id_personnel">รหัสประจำตัวบุคลากร</label>
                <input type="text" class="form-control" id="id_personnel" name="id_personnel" value="<?php echo $row['id_personnel'];?>">
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
                <label for="p_realname">ชื่อ</label>
                <input type="text" class="form-control" id="p_realname" name="p_realname" value="<?php echo $row['p_realname'];?>">
            </div>
            <div class="form-group">
                <label for="p_surname">นามสกุล</label>
                <input type="text" class="form-control" id="p_surname" name="p_surname" value="<?php echo $row['p_surname'];?>">
            </div>
            <div class="form-group">
                <label for="p_password">รหัสผ่าน</label>
                <input type="text" class="form-control" id="p_password" name="p_password" value="<?php echo $row['p_password'];?>">
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
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <a href="data_personnel.php" class="btn btn-danger">ยกเลิก</a>
            <input type="hidden" name="id_hid_personnel" value="<?php echo $row['id_personnel'];?>">
        </form>
    </div>
</body>
</html>
