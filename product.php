<?php
 session_start(); 
header('Content-Type: text/html; charset=UTF-8');

include './layout/header.php' ?>
<main role="main" class="container md">                                  
  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <div class="card card-nav-tabs card-plain">
      <div class="card-header card-header-success">
                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav nav-tabs" data-tabs="tabs">
                            <li class="nav-item">
                                <a class="nav-link active " href="product.php" data-toggle="tab"><i class="material-icons">local_cafe</i> Sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="warehouse.php" ><i class="material-icons">local_convenience_store</i> Kho</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="supplier.php" ><i class="material-icons">local_grocery_store</i> Nhà cung cấp</a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
        </div>
        <div class="card-body ">
          <div class="tab-content text-center">
            <div class="tab-pane active" id="product">
              <section name="listProduct">
                <nav aria-label="breadcrumb" role="navigation">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="product.php">Sản phẩm</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách sản phẩm</li>
                  </ol>
                </nav>
                <hr>
                <div class="row">
                    <div class="col-auto mr-auto" id="numberOfProduct">
                      <?php
                        include('sql_conn.php');
                        $numberOfProduct = "SELECT COUNT(id) as total FROM product";
                        $sqlCount = mysqli_query($conn, $numberOfProduct); //Thực hiện truy vấn đếm dựa vào id
                        $data = mysqli_fetch_assoc($sqlCount); //Đưa tất cả dữ liệu select được vào mảng
                        echo "<h4>Có tất cả ".$data['total']." sản phẩm các loại</h4>";
                      ?>
                    </div>
                          <!-- Tạo nút nhấn hiện modal -->
                    <div class="col-auto">
                      <a href="add_product_modal.php">
                        <button class="btn btn-round btn-success" data-toggle="modal" data-target="#addModal"><i class="material-icons">add_circle_outline</i> 
                          THÊM SẢN PHẨM 
                        </button>
                      </a>
                    </div>
              </div>

                      

<!-- Bảng hiển thị danh sách sản phẩm -->
<table class="table table-hover" name="productTable">
  <thead>
    <tr>
      <th>Mã</th>
      <th>Hình ảnh</th>
      <th class="text-left">Tên sản phẩm</th>
      <th>
        <form method="POST" class="form-inline">
        <select onchange="this.form.submit()" class="selectpicker show-tick" data-style="select-with-transition" id="filter" name="filter"> <!-- onchange="this.form.submit()" để tự submit khi chọn loại cần lọc không cần nhấn nút -->
          <option selected value="">Chọn loại</option>
          <?php 
            $select_sp = "SELECT DISTINCT species FROM product";
            $select_sp_result = mysqli_query($conn, $select_sp);
            if ($select_sp_result->num_rows > 0) 
              while ($row1 = mysqli_fetch_assoc($select_sp_result)) {
                echo '<option value="'.$row1['species'].'">'.$row1['species'].'</option>';
              }
          ?>
        </select> 
      </form>
    </th>
      <th class="text-right">Giá</th>
      <th class="text-right">Thao tác</th>
    </tr>
  </thead>
  <tbody>
    <?php
      include('sql_conn.php');
      error_reporting(E_PARSE); //Ẩn lỗi 
      if ($_POST["filter"] == "") {
        $select_query = "SELECT * FROM product"; //Câu truy vấn khi không lọc
      } else {
        $select_query = "SELECT * FROM product WHERE species='".$_POST["filter"]."'"; //Câu truy vấn khi chọn loại để lọc
      }

      $query0 = mysqli_query($conn, $select_query); //Thực hiện câu truy vấn
      if ($query0->num_rows > 0) { //Kiểm tra số dòng
        while ($row = mysqli_fetch_assoc($query0)) { //Đưa số vòng vào một mảng để hiển thị
          $Gia= number_format($row['price'], 0);
    ?>
    <tr>
      <td><?php echo $row["id"]; ?></td>
      <td><img src="<?php echo $row["thumb_img"]; ?>" width="120"  /></td>
      <th class="text-left"><?php echo $row["name"]; ?></th>
      <td><?php echo $row["species"]; ?></td>
      <td class="text-right"><?php echo $Gia; ?> VNĐ</td>
      <td class="td-actions text-right">
        <form method="get" action="./delete_product.php"> 
          <a href="./edit_product_modl.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit<?php echo $row['id']; ?>">
            <i class="material-icons">edit</i></a>
          </button>
          <button type="submit" rel="tooltip" class="btn btn-danger btn-sm" id="delete" name="delete" value="<?php echo $row["id"]; ?>" onsubmit="return verify()">
            <i class="material-icons">delete</i>
          </button>
        </form>
      </td>
    </tr>
      <script type="text/javascript">
        function verify(){
          var re = false
          Swal.fire({
            title: 'Bạn có muốn xóa sản phẩm này?',
            text: "Không thể hoàn tác lại được!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.value) {
              Swal.fire(
                'Đã xóa!',
                '',
                'success'
              )
              re = true
            }else{
              re = false
            }
          })
          return re
        }
      </script>
    </div>                              
    <?php
        }
      }
    ?>
  </tbody>
</table>
    </section>
            </div>
                    
                    

                        

                          
                    </div>
                </div>
            </div>
          </div>
        </div>
</main>
  </body>
  <footer class="footer footer-default" >
    <div class="container">
      <nav class="float-left">
        <ul>
          <li>
          &copy;
          <script>
              document.write(new Date().getFullYear())
          </script>
          </li>
        </ul>
      </nav>
      <div class="copyright float-right">
          Made with <i class="material-icons">all_inclusive</i> Uyen
          
      </div>
    </div>
  </footer>
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