<?php 
	session_start();
	error_reporting(E_PARSE);
	include 'sql_conn.php';
	if (isset($_SESSION['account']) && $_SESSION['user_group']=="admin") { //Kiểm tra có login hay chưa, nếu có thì biết $_SESSION sẽ có giá trị là tài khoản vừa nhập
		
		if (isset($_GET['update'])) {
			$select = "SELECT * FROM employees WHERE id = '".$_GET['update']."'";
			$select_query = mysqli_query($conn, $select);
			if ($select_query->num_rows > 0) {
				while ($row = mysqli_fetch_assoc($select_query)){
					$phone = $row['phone'];
					$address = $row['address'];
					$job = $row['job'];
				}
			}
			if ($_GET['ephone']=="") 
				$_GET['ephone']=$phone;
			if ($_GET['eaddress']=="")
				$_GET['eaddress']=$address;
			if ($_GET['ejob']=="")
				$_GET['ejob']=$job;
			if ($_GET['ejob']=="Order")
				$order="order";
			else
				$order="";
			$update = "UPDATE employees SET phone = '".trim($_GET['ephone'])."', address = '".trim($_GET['eaddress'])."', job = '".trim($_GET['ejob'])."', user_group='".$order."' WHERE id = '".trim($_GET['update'])."'";
			// echo $update;
			$update_query = mysqli_query($conn, $update);
			header('Location: employee.php');
		}
	} else {
		header('Location: login.php'); //Nếu không phải tài khoản admin thì chuyển về trang login.php
	}
 ?>