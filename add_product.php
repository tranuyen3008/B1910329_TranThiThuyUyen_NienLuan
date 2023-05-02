<?php 
	session_start();
	error_reporting(E_PARSE);
	include 'sql_conn.php';
	if (isset($_SESSION['account']) && $_SESSION['user_group']=="admin") { //Kiểm tra có login hay chưa, nếu có thì biết $_SESSION sẽ có giá trị là tài khoản vừa nhập
		if (isset($_GET['pName']) && isset($_GET['pPrice']) && isset($_GET['pSpecies'])) {
		  if ($_GET['pPrice'] >= 0){
			$add = "INSERT INTO product (name, species, price, thumb_img) VALUES ('".trim($_GET["pName"])."', '".trim($_GET["pSpecies"])."', '".trim($_GET["pPrice"])."', '".trim($_GET["pPhoto"])."')";
            $add_query = mysqli_query($conn, $add);
            // echo $add;
            $_SESSION['addP']='yes';
            header('Location: product.php');
          }else{
            echo "<script>alert('Giá phải lớn hơn 0đ');</script>";
          }
		} else {
			echo "<script>alert('Vui lòng điền đủ thông tin.')</script>";
		}
	} else {
		header('Location: login.php'); //Nếu không phải tài khoản admin thì chuyển về trang login.php
	}
 ?>