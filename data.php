<?php
header('Content-Type: application/json');

include 'sql_conn.php';

$sqlQuery = "SELECT SUM(quantity) AS quantity, product FROM detail_bill GROUP BY product";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
// foreach ($result as $row) {
// 	// $data[] = $row;
// }
foreach ($result as $col) {
	 $data[] = $col;
}

mysqli_close($conn);

echo json_encode($data);
?>