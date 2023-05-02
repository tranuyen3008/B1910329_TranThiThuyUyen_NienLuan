<!DOCTYPE html>
<html>
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
                            <li class="breadcrumb-item active" aria-current="page">Sửa sản phẩm</li>
                          </ol>
                        </nav>

<?php
// Kết nối Database
  include 'sql_conn.php';

  $id=$_GET['id'];
  $query=mysqli_query($conn,"select * from `product` where id='$id'");
  $row=mysqli_fetch_assoc($query);
?>
<form method="POST" class="form">
<h2>Sửa sản phẩm</h2>
<hr>
<table style="width: 600px; margin: auto;" >
  <tr>
    <td>Tên sản phẩm:</td>
    <td><input type="text" value="<?php echo $row['name']; ?>" name="name" ></td>
  </tr>
  <tr>
    <td>Giá:</td>
    <td><input type="text" value="<?php echo $row['price']; ?>" name="price"></td>
  </tr>
  <tr>
    <td>Link hình ảnh:</td>
    <td><input type="text" value="<?php echo $row['thumb_img']; ?>" name="thumb_img"></td>
  </tr>
  <tr>
    <td>Loại:</td>
    <td><input type="text" value="<?php echo $row['species']; ?>" name="species"></td>
  </tr>
  <tr>
    <td></td>
    <td style="padding: 10px;">
      <!-- <button type="submit" value="Cập nhật" name="update_product"></button> -->
      <input type="submit" value="Cập nhật" name="update_product">
      <button><a href="product.php">Hủy</a></button>
    </td>
  </tr>
</table>
  
<?php
//session_start();
if (isset($_SESSION['account']) && $_SESSION['user_group']=="admin") { 
  if (isset($_POST['update_product'])){
    $id=$_GET['id'];
    $name=$_Get['name'];
    $price=$_POST['price'];
    $thumb_img=$_POST['thumb_img'];
    $species = $_POST['species'];

  // Create connection
  // $conn = new mysqli("localhost", "root", "", "nlcs");
  // // Check connection
  // if ($conn->connect_error) {
  // die("Connection failed: " . $conn->connect_error);
  // }

  $sql = "UPDATE `product` SET name='$name', price='$price', thumb_img='$thumb_img', species='$species' WHERE id='$id'";
  $sql_query= mysqli_query($conn,$sql);
  //   echo $sql;
  
  //$conn->close();
  }
  header('Location: product.php');
}
  ?>
 
</form>

</body>
</html>