<?php
include_once 'config.php'; // Include your database connection

$userid = $_GET['userid'];  // Retrieve this based on your setup
$filter = $_GET['filter'];  // Get the filter parameter from the AJAX request

$whereClause = "";
$orderClause = "";

switch ($filter) {
	case 'today':
		$whereClause = "AND DATE(created_at) = CURDATE()";
		$orderClause = "WHERE DATE(created_at) = CURDATE()";
		break;
	case 'this_week':
		$whereClause = "AND WEEK(created_at) = WEEK(CURDATE())";
		$orderClause = "WHERE WEEK(created_at) = WEEK(CURDATE())";
		break;
	case 'this_month':
		$whereClause = "AND MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())";
		$orderClause = "WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())";
		break;
	case 'this_year':
		$whereClause = "AND YEAR(created_at) = YEAR(CURDATE())";
		$orderClause = "WHERE YEAR(created_at) = YEAR(CURDATE())";
		break;
	case 'lifetime':
	default:
		break;
}

// Fetch total order amount
$sql_order_amount = "SELECT SUM(total) AS totalprice FROM olnee_orders WHERE status > 1 $whereClause";
$stmt_order = mysqli_prepare($conn, $sql_order_amount);
mysqli_stmt_execute($stmt_order);
$result_order = mysqli_stmt_get_result($stmt_order);
$orderrow = mysqli_fetch_assoc($result_order);
$order_amount = $orderrow['totalprice'];
$total_amount =  $order_amount;

// Fetch store visits
$sql_store_visits = "SELECT COUNT(*) AS total_visits FROM olnee_storevisits WHERE backhalf = 'home' $whereClause";
$stmt_visits = mysqli_prepare($conn, $sql_store_visits);
mysqli_stmt_execute($stmt_visits);
$result_visits = mysqli_stmt_get_result($stmt_visits);
$row_visits = mysqli_fetch_assoc($result_visits);
$totalvisits = $row_visits['total_visits'];

// Fetch orders count
$sql_order_count = "SELECT COUNT(*) AS total_orders FROM olnee_orders $orderClause";
$stmt_orders = mysqli_prepare($conn, $sql_order_count);
mysqli_stmt_execute($stmt_orders);
$result_orders = mysqli_stmt_get_result($stmt_orders);
$row_orders = mysqli_fetch_assoc($result_orders);
$totalorders = $row_orders['total_orders'];

// Close all prepared statements
mysqli_stmt_close($stmt_order);
mysqli_stmt_close($stmt_visits);
mysqli_stmt_close($stmt_orders);

// Prepare the response
$response = [
	'totalAmount' => $total_amount,
	'numorders' => $totalorders,
	'numvisits' => $totalvisits,
];
// Return the data as JSON
echo json_encode($response);
$conn->close();


// // Fetch total store clicks
// $stmt_clicks = $conn->prepare( "SELECT COUNT(*) FROM linkclick_n_scan WHERE unique_id = ? AND clicks = '1' $whereClause" );
// $stmt_clicks->bind_param( "s", $unique_id );
// $stmt_clicks->execute();
// $stmt_clicks->bind_result( $storeclicks );
// $stmt_clicks->fetch();
// $stmt_clicks->close();
// $storeclickstotal = $storeclicks;

// $products = [];
// while ( $productrow = mysqli_fetch_assoc( $productsresult ) ) {
// 	$prod_id = $productrow['prod_id'];

// 	$prodsql_img_thumbnail = mysqli_query( $conn, "SELECT * FROM productimages WHERE prod_id = '$prod_id' AND thumbnail = 1" );
// 	$row_prod_img_thumbnail = mysqli_fetch_assoc( $prodsql_img_thumbnail );
// 	// $image_path_thumbnail = IMAGE_URL . $row_prod_img_thumbnail['img'];

// 	$products[] = [ 
// 		'ptitle' => $productrow['ptitle'],
// 		'pprice' => '&#8358;' . number_format( $productrow['pprice'], 2 ),
// 		'orders_count' => number_format( $productrow['orders_count'] ),
// 		'image_path_thumbnail' => $image_path_thumbnail
// 	];
// }

// Check if there are no products or links
// if ( empty( $products ) ) {
// 	$response['no_products'] = `
//     <tr>
//         <div class="col-md-12 text-center">
//             <div class="py-30 bg-light-4 rounded-8 border-light col-md-8 mt-50 mb-50" style="margin: 0% auto;">
//                 <img src="assets/img/edit/store.png" style="width:20%">
//                 <h3 class="px-30 text- fw-500 mt-20">
//                     No Products
//                 </h3>
//                 <p class="pt-10 mb-20">
//                     No products found for the specified period.
//                 </p>
//             </div>
//         </div>
//     </tr>
//     `;
// }