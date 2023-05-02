 <?php 
	// session_start();
	// error_reporting(E_PARSE);
	// include 'sql_conn.php';
	// if (isset($_SESSION['account']) && $_SESSION['user_group']=="admin") { //Kiểm tra có login hay chưa, nếu có thì biết $_SESSION sẽ có giá trị là tài khoản vừa nhập
	// 	if (isset($_GET['edit'])) {
	// 		$select = "SELECT * FROM product WHERE id = '".$_GET['edit']."'";
	// 		$select_query = mysqli_query($conn, $select);
	// 		if ($select_query->num_rows > 0) {
	// 			while ($row = mysqli_fetch_assoc($select_query)) {
	// 				$name = $row['name'];
	// 				$price = $row['price'];
	// 				$specie = $row['species'];
	// 				$link = $row['thumb_img'];
	// 			}
	// 		}
	// 		if ($_GET['product-price']=="")
	// 			$_GET['product-price']=$price;
	// 		if ($_GET['product-link']=="")
	// 			$_GET['product-link']=$link;
	// 		if ($_GET['product-specie']=="")
	// 			$_GET['product-specie']=$specie;
	// 		$_GET['product-price'] = trim($_GET['product-price']);
	// 		$_GET['product-link'] = trim($_GET['product-link']);
	// 		$_GET['product-specie'] = trim($_GET['product-specie']);
	// 	    $update = "UPDATE product SET price = '".$_GET['product-price']."', thumb_img = '".$_GET['product-link']."', species = '".$_GET['product-specie']."' WHERE id = '".$_GET['edit']."'";
	// 	    $update_query = mysqli_query($conn, $update);
	// 	    // echo $update;
	// 	    header('Location: product.php');
	// 	}
	// } else {
	// 	header('Location: login.php'); //Nếu không phải tài khoản admin thì chuyển về trang login.php
	// }
//session_start();
include 'sql_conn.php';
if (isset($_SESSION['account']) && $_SESSION['user_group']=="admin") { 
  if (isset($_POST['update_product'])){
    $id=$_GET['id'];
    $name=$_post['name'];
    $price=$_POST['price'];
    $thumb_img=$_POST['thumb_img'];
    $species = $_POST['species'];
 

  // Create connection
  // $conn = new mysqli("localhost", "root", "", "nlcs");
  // // Check connection
  // if ($conn->connect_error) {
  // die("Connection failed: " . $conn->connect_error);
  // }

  $sql = "UPDATE product SET name='$name', price='$price', thumb_img='$thumb_img', species='$species' WHERE id='$id'";
  $sql_query= mysqli_query($conn,$sql);
//   //   echo $sql;
   header('Location: product.php');
//   //$conn->close();
  }
}

?>