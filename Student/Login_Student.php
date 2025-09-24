<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ระบบขออนุญาตออกนอกวิทยาลัยในเวลาเรียน</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0081d5079a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css.css">
    <style>
        img.logo{
            width: 6%;
            height: 6%;
        }
        h2{
            color: #fff;
        }
    </style>
    <title>Loginstudent</title>
</head>
<body>
    <nav class="navbar navbar-expand-md bg-danger navbar-danger">
        <!-- Brand -->
        <img src="../Image/school/logo.png" class="navbar-brand text-light logo">
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="../index.php"><h2>ระบบขออนุญาตออกนอกวิทยาลัย</h2></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#"></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#"></a>
            </li>
        </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="alert alert-info">
                    <h1 class="text-center">นักศึกษา</h1>
                    <form action="chklogin_Student.php" method="post">
                        <div class="form-group">
                            <label>รหัสประจำตัวนักศึกษา</label>
                            <input type="text" class="form-control" id="id_student" placeholder="" name="id_student">
                        </div>
                        <div class="form-group">
                            <label for="pwd">รหัสผ่าน</label>
                            <input type="password" class="form-control" id="s_password" placeholder="" name="s_password">
                        </div>
                        <button type="submit" class="btn btn-primary"><i class='fas fa-sign-in-alt'></i> เข้าสู่ระบบ</button>
                        <a href="../index.php" class="btn btn-danger">ออก</a>
                    </form>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>
</html>