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
                                <a class="nav-link " href="product.php" data-toggle="tab"><i class="material-icons">local_cafe</i> Sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="warehouse.php" data-toggle="tab"><i class="material-icons">local_convenience_store</i> Kho</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="supplier.php" data-toggle="tab"><i class="material-icons">local_grocery_store</i> Nhà cung cấp</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="supplier">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="supplier">Nhà cung cấp</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Nhập hàng</li>
                    </ol>
                </nav>
                <form method="get" action="add_supplier.php" onsubmit="">
                    <div class="form-row">
                        <div class="col-4">
                            <label class="bmd-label-static">Tên nhà cung cấp*</label>
                            <input type="text" name="name" id="name" class="form-control" >
                        </div>
                        <div class="col-2">
                                <label class="bmd-label-static">Số điện thoại*</label>
                                <input type="text" name="phone" id="phone" class="form-control" pattern="\d{10,10}">
                        </div>
                        <div class="col">
                                <label class="bmd-label-static">Địa chỉ*</label>
                                <input type="text" name="address" id="address" class="form-control" >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-4">
                                <label class="bmd-label-static">Tên nguyên liệu</label>
                                <input type="text" name="material" id="material" class="form-control">
                        </div>
                        <div class="col">
                                <label class="bmd-label-static">Số lượng</label>
                                <input type="text" name="quantity" id="quantity" pattern="\d{1,9}" class="form-control">
                        </div>
                        <div class="col">
                                <label class="bmd-label-static">Đơn vị tính</label>
                                <input type="text" name="unit" id="unit" class="form-control">
                        </div>
                        <div class="col">
                                <label class="bmd-label-static">Giá thành</label>
                                <input type="text" name="cost" id="cost" class="form-control" pattern="\[0-9]">
                        </div>
                        </div>
                            <div class="row">
                                <div class="col-auto mr-auto"> </div>
                                <div class="col-auto">
                                <button class="btn btn-success" type="submit"><i class="material-icons">add</i> THÊM</button>
                            </div>
                        </div>
                </form>
<?php 
    if (isset($_SESSION['sup'])) {
        if ($_SESSION['sup']=="yes") {
?>
<script type="text/javascript">
       Swal.fire({
        type: 'success',
        title: 'Đã thêm nhà cung cấp!',
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
        title: 'Thêm nhà cung cấp thất bại!',
        showConfirmButton: false,
        timer: 1500
      })
    </script>
      <?php
    }
    unset($_SESSION['sup']);
  }
?>
<hr>
    <nav aria-label="breadcrumb" role="navigation">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Nhà cung cấp</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Danh sách nhà cung cấp</li>
                          </ol>
                        </nav>
                        <hr>
                        <p class="text-muted">Click vào từng dòng để hiện thông tin</p>
                        <table class="table table-hover table-bordered" name="supplierTable">
                          <thead>
                            <tr>
                              <th>Mã NCC</th>
                              <th>Tên Nhà cung cấp</th>
                              <th>Địa chỉ</th>
                              <th>Số điện thoại</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
  $showSupplier = "SELECT * FROM supplier";
  $showSupplier_query = mysqli_query($conn, $showSupplier);

  if ($showSupplier_query->num_rows > 0)
    while ($rows = mysqli_fetch_assoc($showSupplier_query)) {
    ?>
    <tr data-toggle="modal" data-target="#showMore<?php echo $rows['id']; ?>">
      <td><?php echo $rows['id']; ?></td>
      <th><?php echo $rows['name']; ?></th>
      <td><?php echo $rows['address']; ?></td>
      <td><?php echo $rows['phone']; ?></td>
    </tr>
    <!-- Modal Show information -->
    <div class="modal fade" id="showMore<?php echo $rows['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="showMoreModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="showMoreModal">Chi tiết đơn đặt hàng</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <?php
            $showInfo = "SELECT detail_import.id_supplier, detail_import.id, detail_import.quantity, detail_import.unit, detail_import.day, detail_import.cost, warehouse.material, employees.fullname FROM detail_import, warehouse, employees WHERE detail_import.id_employee = employees.id AND detail_import.id_warehouse = warehouse.id AND detail_import.id_supplier = '".$rows['id']."'";
            $showInfo_query = mysqli_query($conn, $showInfo);
            if ($showInfo_query->num_rows > 0)
              while ($row1 = mysqli_fetch_assoc($showInfo_query)) {
              ?>
                <ul class="text-left">
                  <li>Mã: <?php echo $row1['id']; ?></li>
                  <li>Nguyên liệu: <?php echo $row1['material']; ?></li>
                  <li>Số lượng: <?php echo $row1['quantity']." ".$row1['unit']; ?></li>
                  <li>Giá nhập: <?php echo number_format($row1['cost'], 0); ?>đ</li>
                  <li>Ngày nhập: <?php echo date('h:i:s d/m/Y', strtotime($row1['day'])); ?></li>
                  <li>Nhân viên nhập: <?php echo $row1['fullname']; ?></li>
                </ul>
                <hr>
              <?php
              }
          ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Đóng</button>
          </div>
        </div>
      </div>
    </div>
    <?php
    }
?>
</tbody>
</table>