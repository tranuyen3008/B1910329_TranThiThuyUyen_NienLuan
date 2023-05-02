<!-- validate add_product form script -->
<script type="text/javascript">
  function validate_add_product(){
    var name = document.getElementById('pName').value;
    var price = document.getElementById('pPrice').value;
    var species = document.getElementById('pSpecies').value;
    var photo = document.getElementById('pPhoto').value;

    if (name!="" && price!="" && species!="" && photo!="")
      if (price >= 0){
        return true;
      }
      else{
        alert('Giá không được nhỏ hơn 0đ');
        return false;
      }
    else{
      alert('Vui lòng điền đầy đủ thông tin.');
      return false;
    }
    return false;
  }
</script>
<?php
    
  if (isset($_SESSION['addP'])) {
    if ($_SESSION['addP']=="yes") {
    ?>
    <script type="text/javascript">
      Swal.fire({
        type: 'success',
        title: 'Đã thêm sản phẩm!',
        showConfirmButton: false,
        timer: 1500
      })
    </script>
    <?php
    } else {
    ?>
    <script type="text/javascript">
      Swal.fire({
        type: 'error',
        title: 'Chưa thêm sản phẩm!',
        showConfirmButton: false,
        timer: 1500
      })
    </script>
    <?php
    }
    unset($_SESSION['addP']);
  };?>
 
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
    <!-- SweetAlert2 -->
    <script src="assets/js/sweetalert2.all.min.js"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
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
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">Thống kê</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="product.php">Sản phẩm <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="employee.php">Nhân viên</a>
            </li>
          </ul>
    </nav>
    <main>
    <main role="main" class="container md">                                  
        <div class="my-3 p-3 bg-white rounded shadow-sm">
          <div class="card card-nav-tabs card-plain">
            <div class="card-header card-header-success">
                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav nav-tabs" data-tabs="tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="product.php" data-toggle="tab"><i class="material-icons">local_cafe</i> Sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="warehouse.php" data-toggle="tab"><i class="material-icons">local_convenience_store</i> Kho</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="supplier.php" data-toggle="tab"><i class="material-icons">local_grocery_store</i> Nhà cung cấp</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><div class="card-body ">
                <div class="tab-content text-center">
                    <div class="tab-pane active" id="product">
                       <section name="listProduct">
                        <nav aria-label="breadcrumb" role="navigation">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="product.php">Sản phẩm</a></li>
                            <li class="breadcrumb-item">Danh sách sản phẩm</li>
                            <li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm</li>
                          </ol>
                        </nav>
    <form method="get" action="add_product.php" class="needs-validation" onsubmit="return validate_add_product()">
        <table style="width: 600px; margin: auto;">
            <h1 style="text-align: center;" >Thêm sản phẩm</h1>
            <hr>
            <tr>
                <td><i class="material-icons">assignment</i></td>
                <td><input type="text" name="pName" id="pName" class="form-control" placeholder="Tên sản phẩm" required></td>
            </tr>
            <tr>
                <td><i class="material-icons">add_photo_alternate</i></td>
                <!-- <td><input type="file" name="pPhoto" id="pPhoto" class="form-control"  required></td> -->
                <td><input type="text" name="pPhoto" id="pPhoto" class="form-control"  required></td>
            </tr>
            <tr>
                <td><i class="material-icons">attach_money</i></td>
                <td><input type="text" name="pPrice" id="pPrice" class="form-control" placeholder="Giá tiền" pattern="\[0-9]{1,11}" required></td>
            </tr>
            <tr>
                <td><i class="material-icons">label</i></td>
                <td><input class="form-control" type="text" name="pSpecies" id="pSpecies" placeholder="Loại sản phẩm"></input></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="product.php"><button type="button" class="btn btn-secondary" >Trở lại</button></a>
                    <button type="submit" class="btn btn-success">Thêm</button>
                </td>
            </tr>

        </table>
    </form>
    </main>