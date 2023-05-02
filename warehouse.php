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
                                <a class="nav-link active" href="warehouse.php" data-toggle="tab"><i class="material-icons">local_convenience_store</i> Kho</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="supplier.php" data-toggle="tab"><i class="material-icons">local_grocery_store</i> Nhà cung cấp</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <div class="tab-pane" id="warehouse">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Kho</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách mặt hàng</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-auto mr-auto" id="numberOfProduct">
                    <?php
                        include('sql_conn.php');
                        $numberOfProduct = "SELECT COUNT(id) as total FROM warehouse";
                        $sqlCount = mysqli_query($conn, $numberOfProduct); //Thực hiện truy vấn đếm dựa vào id
                        $data = mysqli_fetch_assoc($sqlCount); //Đưa tất cả dữ liệu select được vào mảng
                        echo "<h4>Có tất cả ".$data['total']." sản phẩm trong kho</h4>";
                    ?>
                </div>
                
                    
            <table class="table table-hover" name="productTable">
                <thead>
                    <tr>
                        <th>Mã</th>
                        <th>Nguyên liệu</th>
                        <th>Còn lại</th>
                        <th class="text-right">Thao tác</th>
                    </tr>
                    </thead>
                        <tbody>
                            <?php
                                include('sql_conn.php');
                               // error_reporting(E_PARSE); //Ẩn lỗi 
                                $select_query = "SELECT * FROM warehouse";
                              
                              $query0 = mysqli_query($conn, $select_query); //Thực hiện câu truy vấn
                              if ($query0->num_rows > 0) { //Kiểm tra số dòng
                                while ($row = mysqli_fetch_assoc($query0)) { //Đưa số vòng vào một mảng để hiển thị
                                  echo '<tr>
                                          <td>'.$row["id"].'</td>
                                          <th>'.$row["material"].'</th>
                                          <td>'.$row["remain"].' '.$row['unit'].'</td>
                                          <td class="td-actions text-right">
                                            <form method="post">
                                              <button type="button" rel="tooltip" class="btn btn-success"data-toggle="modal" data-target="#editModal'.$row["id"].'">
                                                  <i class="material-icons">edit</i>
                                              </button>
                                              
                                            </form>
                                          </td>
                                        </tr>
                                        <!-- Modal chỉnh sửa -->
                                        <div class="modal fade" id="editModal'.$row["id"].'" tabindex="-1" role="">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <form method="post" class="needs-validation" novalidate>
                                              <div class="modal-header">
                                                <h4 class="modal-title" id="addModalTitle">Cập nhật nguyên liệu <strong>'.$row["material"].'</strong></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <div class="form-group bmd-form-group">
                                                <div class="input-group">
                                                  <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="material-icons">notification_important</i></div>
                                                   </div>
                                                   <input type="text" name="used" id="used" class="form-control" placeholder="Số lượng đã dùng" pattern="\d{1,9}" required>
                                                   </div>
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                <input type="submit" name="ediBtn'.$row["id"].'" class="btn btn-success" value="Cập nhật">
                                              </div>
                                            </form>
                                            </div>
                                          </div>
                                        </div>
                                        ';
                                        $editBtn = "ediBtn".$row['id'];
                                        if (isset($_POST[$editBtn])){
                                          $remain = $row['remain'] - $_POST['used'];
                                          $edi = "UPDATE warehouse SET remain = '".$remain."' WHERE id = '".$row['id']."'";
                                          $edi_query = mysqli_query($conn, $edi); //Thuc thi cau lenh update
                                          echo '<script type="text/javascript">
                                                window.location.href = "product.php";
                                                </script>'; //Dùng JS để load lại page sau khi update
                                        }
                                }
                              }
                              ?>
                            </tbody>
                          </table>
                        <hr>
                    </div>