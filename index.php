<!doctype html>
<?php session_start(); 
  if(!isset($_SESSION['account']))
    header('Location: login.php');
?>
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
    <link rel="stylesheet" href="assets/css/plus_minus.css">
    <!-- SweetAlert2 -->
    <script src="assets/js/sweetalert2.all.min.js"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <!-- Card a href style -->
    <style type="text/css">
      a.custom-card,
      a.custom-card:hover {
          color: inherit;
      }

      #myBtn {
      display: none;
      position: fixed;
      bottom: 20px;
      right: 30px;
      z-index: 50;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 15px;
      border-radius: 4px;
      }

      #myBtn:hover {
      background-color: red;
      }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-primary sticky-top">
    <div class="container">
      <a class="navbar-brand">HỆ THỐNG QUẢN LÝ</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav col-auto mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Đặt hàng</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">Thống kê</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="product.php">Sản phẩm <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="employee.php">Nhân viên</a>
          </li>
        </ul>
        <ul class="navbar-nav col-auto">
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <?php 
                include ('sql_conn.php');
                if (isset($_SESSION['account']) && $_SESSION['account']){ //Kiểm tra session
                       $name = "SELECT * FROM employees WHERE account = '".$_SESSION['account']."'";
                       $queryName = mysqli_query($conn, $name); //Thực hiện câu truy vấn
                        if ($queryName->num_rows > 0) { //Kiểm tra số dòng
                         while ($row = mysqli_fetch_assoc($queryName)) { //Nếu có kết quả thì đưa tất cả vào bảng
                          if ($row['user_group']=="admin" || $row['user_group']=="order") {
                            echo "Xin chào ".$row['fullname'];
                          } else {
                            header('Location: login.php');
                          }
                        }
                       }        
                     }else{
                    header('Location: login.php'); 
                }
                ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="emp.php">Trang cá nhân</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="logout.php">Đăng xuất</a>
                </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <main role="main" class="container md">                                  
    <div class="my-3 p-3 bg-white rounded shadow-sm">
      <div class="row">
      <?php
      header("Content-type: text/html; charset=utf-8");
        $show = "SELECT * FROM product";
        $show_query = mysqli_query($conn, $show);
        if($show_query->num_rows > 0)
          while($row = mysqli_fetch_assoc($show_query)){
          $gia = number_format($row['price'], 0); 
          $ten = substr($row['name'], 0, 20).'...';
      ?>
      <!-- Hien thi the san pham -->
      <div class="col-md-3">
        <a data-toggle="modal" data-target="#<?php echo $row['id']; ?>" class="custom-card">
          <div class="card mb-4 shadow-sm" style="display: inline-block">
            <img class="card-img-top" height="200" width="120" src="<?php echo $row['thumb_img']; ?>">
            <div class="card-body">
              <h5 class="card-title"><?php echo $ten; ?></h5>
              <h4 class="card-text" id="currency" style="color: green;"><?php echo $gia; ?> đ</h4>
              <div class="d-flex justify-content-between align-items-center">
                <p class="text-mute" style="color: red;"><?php echo $row['species']; ?></p>
              </div>
            </div>
          </div>
        </a>
      </div>
      <!-- modal hiển thị thông tin sản phẩm -->
      <div class="modal fade" id="<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <!-- <h4 class="modal-title" id="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></h4> -->
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <form method="get" action="addcart.php">
                <div class="row">
                  <div class="col-md-6">
                    <img src="<?php echo $row['thumb_img']; ?>" alt="<?php echo $row['id']; ?>" width="500" class="img-fluid" alt="Responsive image">
                  </div>
                  <div class="col-md-6">
                    <h3><?php echo $row['name']; ?></h3>
                    <h5 style="color: green;"><?php echo $gia; ?> đ</h5>
                    <p><?php echo $row['species']; ?></p>  
                    <div class="def-number-input number-input safari_only">
                      <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus " type="button" ></button>
                      <input class="quantity" min="0" name="quantity" value="1" type="number">
                      <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus" type="button" ></button>
                    </div>
                    
                    <div class="form-inline">
                      <button type="submit" name="id" class="btn btn-danger" value="<?php echo $row['id']; ?>">Thêm vào giỏ</button>
                    </div>
                  </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
        }
      ?>
      </div>
    </div>
  <button type="submit" id="myBtn" data-toggle="modal" data-target="#paymentModal" class="btn btn-success">Thanh toán</button> 
  <!-- Script nút thanh toán  -->                          
  <script>
  //Get the button
  var mybutton = document.getElementById("myBtn");

  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
    if (document.body.scrollTop >= 0 || document.documentElement.scrollTop >= 0) {
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "block";
    }
  }
  </script>
  <!-- Modal thanh toán -->
  <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">Tên</th>
                <th scope="col">Số lượng</th>
                <th scope="col" class="text-right">Thành tiền</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>      
          <?php
            error_reporting(0);
            $total = 0;
            foreach($_SESSION['cart'] as $key=>$value){
            $cart_select = "SELECT * FROM product WHERE id = '".$key."'";
            $cart_query = mysqli_query($conn, $cart_select);
            if($cart_query->num_rows > 0)
              while($row0 = mysqli_fetch_assoc($cart_query)){ 
                echo'
                      <tr>
                        <td><img src="'.$row0['thumb_img'].'" class="img-fluid" width="60"></td>
                        <th>'.$row0['name'].'</th>
                        <td class="text-center">'.$_SESSION['cart'][$row0['id']].'</td>
                        <td class="text-right">'.number_format($_SESSION['cart'][$row0['id']]*$row0['price'], 0).'đ</td>
                        <td><form method="get" action="deletecart.php?id="><button class="close" type="submit" name="delete" value="'.$row0['id'].'"><span aria-hidden="true">&times;</span></button></form></td>
                      </tr>';
                $total = $total + $_SESSION['cart'][$row0['id']]*$row0['price'];
              }
            }
            $_SESSION['cart']['total'] = $total;
          ?>
          <tr>
            <th class="text-right" colspan="5">Tổng tiền: <?php echo number_format($total, 0); ?>đ</th>
          </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <form method="post" action="pay.php">
            <button type="submit" name="pay" class="btn btn-success">Thanh toán</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  </main>

<?php 
  if (isset($_SESSION['paid'])) {
    if ($_SESSION['paid']=='yes') {
    ?>
      <script type="text/javascript">
        Swal.fire({
        type: 'success',
        title: 'Thanh toán thành công!',
        showConfirmButton: false,
        timer: 1500
      })
      </script>
    <?php
    }else{
      ?>
      <script type="text/javascript">
        Swal.fire({
          type: 'error',
          title: 'Thanh toán thất bại!',
          showConfirmButton: false,
          timer: 1500
        })
      </script>
      <?php
    }
    unset($_SESSION['paid']);
  }
 ?>

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
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="assets/js/plugins/moment.min.js"></script>
<!--  Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
<script src="assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Google Maps Plugin  -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
<!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="assets/js/plugins/bootstrap-selectpicker.js" type="text/javascript"></script>
<!--  Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="assets/js/plugins/jasny-bootstrap.min.js" type="text/javascript"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
<script src="assets/js/material-kit.js?v=2.1.1" type="text/javascript"></script>
</body>
</html>