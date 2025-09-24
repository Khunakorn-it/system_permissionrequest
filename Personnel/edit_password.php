<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php 
        $lokation = $_GET['lokation'];
    ?>
    <div class="container">
        <h2>เปลี่ยนรหัสผ่าน</h2>
        <form action="save_edit_password.php" method="post">
            <div class="form-group">
                <label for="usr">รหัสผ่านเดิม</label>
                <input type="text" class="form-control" name="p_password">
            </div>
            <div class="form-group">
                <label for="pwd">รหัสใหม่</label>
                <input type="text" class="form-control" name="p_password_new">
            </div>
            <button type="submit" class="btn btn-success">ยืนยัน</button>
            <a href="<?php echo $lokation ;?>" class="btn btn-danger">ยกเลิก</a>
            <input type="hidden" name="lokation" value="<?php echo $lokation ;?>">
        </form>
    </div>
</body>
</html>
