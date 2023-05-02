<!doctype html>
<?php session_start(); ?>
<html lang="en">
  <head>
    <title>Hệ thống quản lý</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Material Kit CSS -->
    <link href="assets/css/material-kit.css?v=2.1.1" rel="stylesheet" />
    <!-- Fav icon -->
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  </head>
  <body background="./assets/images/cover.jpg">
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container">
          <span class="navbar-brand">HỆ THỐNG QUẢN LÝ QUÁN CAFE</span>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </nav>
      <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
              <form class="form" method="POST" action="login.php?do=login" onsubmit="return validateForm()">
                <div class="card card-login card-hidden">
                  <div class="card-header card-header-primary text-center">
                    <h3 class="card-title">Đăng nhập</h3>
                  </div>
                  <div class="card-body">
                    <span class="bmd-form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">account_box</i>
                          </span>
                        </div>
                        <input type="text" class="form-control" placeholder="Tài khoản" name="username" id="username" value="">
                      </div>
                    </span>
                    <span class="bmd-form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">lock</i>
                          </span>
                        </div>
                        <input type="password" class="form-control" placeholder="Mật khẩu" name="password" id="password" value="">
                      </div>
                    </span>
                  </div>
                  <div class="card-footer justify-content-center">
                  <input type="submit" class="btn btn-primary" name="loginBtn" id="loginBtn" value="ĐĂNG NHẬP" />
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
  <footer class="footer footer-default" >
    <div class="container">
      <div class="copyright float-left">
          &copy;
          <script>
              document.write(new Date().getFullYear())
          </script>
      </div>
      <div class="copyright float-right">
          Made with <i class="material-icons">all_inclusive</i> love by
          <a href="">Uyen</a>
      </div>
    </div>
  </footer>
  </body>

  <?php
  if(isset($_POST['loginBtn'])){
    include('sql_conn.php'); //Kết nối tới Database
      $sql = "SELECT * FROM employees";
      $result = mysqli_query($conn, $sql);
      if ($result->num_rows > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if ($row["account"] == $_POST['username']) { //Kiểm tra account
              if ($row["password"] == sha1($_POST['password'])) { //Kiểm tra password
                  $_SESSION['account'] = $row['account']; //Lưu tên đăng nhập
                    if($row['user_group'] == "admin" || $row['user_group']=="order"){
                      $_SESSION['user_group']=$row['user_group'];
                      header('Location: index.php');
                    }
                    else
                      header('Location: emp.php');
              } else {
                echo "<script>alert('Mật khẩu không chính xác.');</script>";
              }
            }                                              
          }
        }else{
          echo "<script>alert('Tài khoản không tồn tại.');</script>";
        }
        die();
  }
  ?>

<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="assets/js/plugins/moment.min.js"></script>
<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
<script src="assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Google Maps Plugin  -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="assets/js/plugins/bootstrap-selectpicker.js" type="text/javascript"></script>
<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="assets/js/plugins/jasny-bootstrap.min.js" type="text/javascript"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
<script src="assets/js/material-kit.js?v=2.1.1" type="text/javascript"></script></body>
</html>