<?php 
	session_start();
	//error_reporting(E_PARSE);
	 date_default_timezone_set("Asia/Ho_Chi_Minh");
	include 'sql_conn.php';
	if (isset($_SESSION['account']) && $_SESSION['user_group']=="admin") { //Kiểm tra có login hay chưa, nếu có thì biết $_SESSION sẽ có giá trị là tài khoản vừa nhập
		if ($_GET['name']!="" && $_GET['phone']!="" && $_GET['address']!="") {
			$name = trim($_GET['name']);
			$address = trim($_GET['address']);
			$material = trim($_GET['material']);
			#Get id from detail_import to insert into warehouse's id and supplier's id
			$count = "SELECT MAX(id) AS id FROM detail_import";
			$count_query = mysqli_query($conn, $count);
			if ($count_query->num_rows > 0) {
				while ($row = mysqli_fetch_assoc($count_query)) {
					if ($row['id'] == "") {
						$id = 0;
					} else {
						$id = $row['id'];
					}
					
				}
			}
			#Get employee's id from $_SESSION['account'] a.k.a employee's account
			$getId = "SELECT id FROM employees WHERE account = '".$_SESSION['account']."'";
			$getId_query = mysqli_query($conn, $getId);
			if ($getId_query->num_rows > 0)
				while ($rows = mysqli_fetch_assoc($getId_query))
					$id_emp = $rows['id'];					

			$warehouse = "INSERT INTO warehouse VALUES ('".$id."', '".$material."', '".$_GET['unit']."', '".$_GET['quantity']."')";
		//	$supplier = "INSERT INTO supplier VALUES ('".$id."', '".$name."', '".$_GET['phone']."', '".$address."')";
		//	$detail = "INSERT INTO detail_import VALUES ('', '".$id_emp."', '".$id."', '".$id."', '".$_GET['quantity']."', '".$_GET['unit']."', '".$_GET['cost']."')";
			mysqli_query($conn, $warehouse);
		//	mysqli_query($conn, $supplier);
		//	mysqli_query($conn, $detail);
			// echo $warehouse."<br>".$supplier."<br>".$detail;
            $_SESSION['sup']="yes";
            header('Location: product.php');
		
	
		}else{
			$_SESSION['sup']="no";
			header('Location: product.php');
		}
	} else {
		header('Location: login.php'); //Nếu không phải tài khoản admin thì chuyển về trang login.php
	}
 ?>