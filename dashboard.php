<!doctype html>
<?php session_start(); 
header('Content-Type: text/html; charset=UTF-8');
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <style type="text/css">
    .chart {
        width: 1000px;
    }

    #chart-container {
        width: 100%;
        height: auto;
    }
    </style>
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/Chart.min.js"></script>
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
            <li class="nav-item">
              <a class="nav-link" href="index.php">Đặt hàng</a>
            </li>
            <li class="nav-item active">
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
                          if ($row['user_group']=="admin") {
                            echo "Xin chào ".$row['fullname'];
                          } else {
                            header('Location: index.php');
                          }
                        }
                       }        
                     }else{
                    header('Location: login.php'); 
                }
                ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="logout.php">Đăng xuất</a>
                </div>
              </li>
          </ul>
        </div>
      </div>
</nav>
      <main role="main" class="container md">                                  
        <div class="my-3 p-3 bg-white rounded shadow-sm">
          <div class="card card-nav-tabs card-plain">
            <div class="card-header card-header-info">
                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav nav-tabs" data-tabs="tabs">
                            <li class="nav-item active">
                              <a class="nav-link active" href="#order" data-toggle="tab"><i class="material-icons">filter_9_plus</i> Hóa đơn</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#statistic" data-toggle="tab"><i class="material-icons">trending_up</i> Thống kê</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><div class="card-body ">
                <div class="tab-content text-center">
                  <div class="tab-pane active" id="order">
                    <nav aria-label="breadcrumb" role="navigation">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Hóa đơn</a></li>
                        <li class="breadcrumb-item" aria-current="page">Sản phẩm đã bán</li>
                       </ol>
                    </nav>
                    <div class="text-muted text-left">Click vào từng dòng để xem chi tiết hóa đơn.</div>
                    <table class="table table-hover table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">Mã</th>
                          <th scope="col">Ngày lập</th>
                          <th scope="col">Nhân viên lập</th>
                          <th scope="col">Tổng tiền</th>
                          <th scope="col">Thao tác</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $order_sel = "SELECT employees.fullname, bill.* FROM employees INNER JOIN bill ON bill.empaccount=employees.account ORDER BY bill.id DESC";
                          $order_que = mysqli_query($conn, $order_sel);
                          if($order_que->num_rows > 0)
                            while ($row = mysqli_fetch_assoc($order_que)) {
                        ?>
                          <tr data-toggle="modal" data-target="#view<?php echo $row['id']; ?>">
                            <th><?php echo $row['id']; ?></th>
                            <td><?php echo date('h:i:s d/m/Y', strtotime($row['time'])); ?></td>
                            <td><?php echo $row['fullname']; ?></td>
                            <td><?php echo number_format($row['total'], 0); ?>đ</td>
                            <td><a href="print_bill.php?id=<?php echo $row['id'] ?>" value="<?php echo $row['id'] ?>" name='in'  ><button><span class="material-symbols-outlined">print</span></button></a></td>
                          </tr>
                          <!-- The Modal -->
                          <div class="modal fade" id="view<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                              <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Chi tiết hóa đơn #<?php echo $row['id']; ?></h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <?php
                                      $billdetail_sel = "SELECT product.name, product.price, product.thumb_img, detail_bill.quantity, detail_bill.total FROM product INNER JOIN detail_bill ON product.id=detail_bill.id_product WHERE detail_bill.id='".$row['id']."'";
                                      $billdetail_que = mysqli_query($conn, $billdetail_sel);
                                      if($billdetail_que->num_rows > 0)
                                        while ($rows = mysqli_fetch_assoc($billdetail_que)) {
                                    ?>
                                      <ul class="text-left">
                                        <li><h4><?php echo $rows['name']; ?></h4></li>
                                        <li>Giá: <?php echo number_format($rows['price'], 0); ?>đ</li>
                                        <li>Số lượng: <?php echo $rows['quantity']; ?></li>
                                        <li>Thành tiền: <?php echo number_format($rows['total'], 0); ?>đ</li>
                                      </ul>
                                      <hr>
                                    <?php
                                         } 
                                    ?>
                                    <h4 class="text-right">Tổng tiền: <?php echo number_format($row['total'], 0); ?>đ</h4>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                                </div>

                              </div>
                            </div>
                          </div>
                        <?php
                            }
                        ?>
                      </tbody>
                    </table>
                  </div>
                    <div class="tab-pane" id="statistic">
                        <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="#">Thống kê</a></li>
                          <li class="breadcrumb-item" aria-current="page">Sản phẩm đã bán</li>
                        </ol>
                      </nav>
                        <div class="chart">
                          <div id="chart-container">
                              <canvas id="graphCanvas"></canvas>
                          </div>

                          <script>
                              $(document).ready(function () {
                                  showGraph();
                              });


                              function showGraph()
                              {
                                  {
                                      $.post("data.php",
                                      function (data)
                                      {
                                          console.log(data);
                                           var product = [];
                                          var quantity = [];

                                          for (var i in data) {
                                              product.push(data[i].product);
                                              quantity.push(data[i].quantity);
                                          }

                                          var chartdata = {
                                              labels: product,
                                              datasets: [
                                                  {
                                                      label: 'Số lượng',
                                                      backgroundColor: ["#263238", "#37474F", "#212121", "#424242", "#3E2723", "#4E342E", "#BF360C", "#D84315", "#E65100", "#EF6C00", "#FF6F00", "#FF8F00", "#F57F17", "#F9A825", "#827717", "#9E9D24", "#33691E", "#558B2F", "#1B5E20", "#2E7D32", "#004D40", "#00695C", "#006064", "#00838F", "#01579B", "#0277BD", "#0D47A1", "#1565C0", "#1A237E", "#283593", "#311B92", "#4527A0", "#4A148C", "#6A1B9A", "#880E4F", "#AD1457", "#b71c1c", "#c62828"]   ,
                                                      borderColor: ["#263238", "#37474F", "#212121", "#424242", "#3E2723", "#4E342E", "#BF360C", "#D84315", "#E65100", "#EF6C00", "#FF6F00", "#FF8F00", "#F57F17", "#F9A825", "#827717", "#9E9D24", "#33691E", "#558B2F", "#1B5E20", "#2E7D32", "#004D40", "#00695C", "#006064", "#00838F", "#01579B", "#0277BD", "#0D47A1", "#1565C0", "#1A237E", "#283593", "#311B92", "#4527A0", "#4A148C", "#6A1B9A", "#880E4F", "#AD1457", "#b71c1c", "#c62828"],
                                                      hoverBackgroundColor: ["#263238", "#37474F", "#212121", "#424242", "#3E2723", "#4E342E", "#BF360C", "#D84315", "#E65100", "#EF6C00", "#FF6F00", "#FF8F00", "#F57F17", "#F9A825", "#827717", "#9E9D24", "#33691E", "#558B2F", "#1B5E20", "#2E7D32", "#004D40", "#00695C", "#006064", "#00838F", "#01579B", "#0277BD", "#0D47A1", "#1565C0", "#1A237E", "#283593", "#311B92", "#4527A0", "#4A148C", "#6A1B9A", "#880E4F", "#AD1457", "#b71c1c", "#c62828"],
                                                      hoverBorderColor: ["#263238", "#37474F", "#212121", "#424242", "#3E2723", "#4E342E", "#BF360C", "#D84315", "#E65100", "#EF6C00", "#FF6F00", "#FF8F00", "#F57F17", "#F9A825", "#827717", "#9E9D24", "#33691E", "#558B2F", "#1B5E20", "#2E7D32", "#004D40", "#00695C", "#006064", "#00838F", "#01579B", "#0277BD", "#0D47A1", "#1565C0", "#1A237E", "#283593", "#311B92", "#4527A0", "#4A148C", "#6A1B9A", "#880E4F", "#AD1457", "#b71c1c", "#c62828"],
                                                      data: quantity
                                                  }
                                              ]
                                          };

                                          var graphTarget = $("#graphCanvas");

                                          var barGraph = new Chart(graphTarget, {
                                              type: 'horizontalBar',
                                              data: chartdata
                                          });
                                      });
                                  }
                              }
                              </script>
                      </div>
                    </div>
                </div>
            </div>
          </div>
      </main>
  </body>
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
<script src="assets/js/material-kit.js?v=2.1.1" type="text/javascript"></script></body>
</html>