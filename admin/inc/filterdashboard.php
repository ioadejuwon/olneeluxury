<?php
include_once 'config.php'; // Include your database connection
include_once "randno.php";
include_once "drc.php";

$userid = $_GET['userid'];  // Retrieve this based on your setup
$filter = $_GET['filter'];  // Get the filter parameter from the AJAX request

$whereClause = "";
$productClause = "";
$linkClause = "";

switch ($filter) {
	case 'today':
		$whereClause = "AND DATE(created_at) = CURDATE()";
		$orderClause = "WHERE DATE(created_at) = CURDATE()";
		// $productClause = "AND DATE(od.created_at) = CURDATE()";
		// $linkClause = "AND DATE(wc.created_at) = CURDATE()";
		break;
	case 'this_week':
		$whereClause = "AND WEEK(created_at) = WEEK(CURDATE())";
		$orderClause = "WHERE WEEK(created_at) = WEEK(CURDATE())";
		// $productClause = "AND WEEK(od.created_at) = WEEK(CURDATE())";
		// $linkClause = "AND WEEK(wc.created_at) = WEEK(CURDATE())";
		break;
	case 'this_month':
		$whereClause = "AND MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())";
		$orderClause = "WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())";
		// $productClause = "AND MONTH(od.created_at) = MONTH(CURDATE()) AND YEAR(od.created_at) = YEAR(CURDATE())";
		// $linkClause = "AND MONTH(wc.created_at) = MONTH(CURDATE()) AND YEAR(wc.created_at) = YEAR(CURDATE())";
		break;
	case 'this_year':
		$whereClause = "AND YEAR(created_at) = YEAR(CURDATE())";
		$orderClause = "WHERE YEAR(created_at) = YEAR(CURDATE())";
		// $productClause = "AND YEAR(od.created_at) = YEAR(CURDATE())";
		// $linkClause = "AND YEAR(wc.created_at) = YEAR(CURDATE())";
		break;
	case 'lifetime':
	default:
		$whereClause = "";
		$orderClause = "";
		// $productClause = "";
		// $linkClause = "";
		break;
}

// // Fetch total store clicks
// $stmt_clicks = $conn->prepare( "SELECT COUNT(*) FROM linkclick_n_scan WHERE unique_id = ? AND clicks = '1' $whereClause" );
// $stmt_clicks->bind_param( "s", $unique_id );
// $stmt_clicks->execute();
// $stmt_clicks->bind_result( $storeclicks );
// $stmt_clicks->fetch();
// $stmt_clicks->close();

// // Fetch total store scans
// $stmt_scans = $conn->prepare( "SELECT COUNT(*) FROM linkclick_n_scan WHERE unique_id = ? AND scans = '1' $whereClause" );
// $stmt_scans->bind_param( "s", $unique_id );
// $stmt_scans->execute();
// $stmt_scans->bind_result( $storescans );
// $stmt_scans->fetch();
// $stmt_scans->close();

// $storeclickstotal = $storeclicks + $storescans;

// Fetch total order amount
$orders_sql_success = mysqli_query($conn, "SELECT SUM(total) AS totalprice FROM olnee_orders  WHERE status > 1 $whereClause");
$orderrow = mysqli_fetch_assoc($orders_sql_success);
$order_amount = $orderrow['totalprice'];
$total_amount =  $order_amount;


// $prodsql = mysqli_query($conn, "SELECT * FROM products WHERE productcategory = '$category_id'");
// $count_row_products = mysqli_num_rows($prodsql);

$orders_sql = mysqli_query($conn, "SELECT * FROM olnee_orders $orderClause");
// $orderrow = mysqli_fetch_assoc($orders_sql);
$count_row_orders = mysqli_num_rows($orders_sql);
$totalorders =  $count_row_orders;

// $stmt_orders = $conn->prepare( "SELECT SUM(total) AS totalprice FROM olnee_orders   $whereClause" );
// $stmt_orders->bind_param( "s", $unique_id );
// $stmt_orders->execute();
// $stmt_orders->bind_result( $order_amount );
// $stmt_orders->fetch();
// $stmt_orders->close();



// Fetch products with filtering
// $productsquery = "SELECT pc.*, SUM(od.pqty) AS orders_count FROM prodcatalogue pc 
//                   LEFT JOIN order_details od ON pc.prod_id = od.prod_id 
//                   WHERE pc.unique_id = '{$unique_id}' $productClause 
//                   GROUP BY pc.id 
//                   ORDER BY orders_count DESC 
//                   LIMIT 5";
// $productsresult = mysqli_query( $conn, $productsquery );

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

// Fetch link data with filtering
// $chatquery = "SELECT gl.*, COUNT(wc.backhalf) AS click_count, 
//                      SUM(wc.clicks) AS click_sum, 
//                      SUM(wc.scans) AS scan_sum 
//               FROM grootlink gl 
//               LEFT JOIN walink_click_n_scan wc 
//               ON gl.randval = wc.backhalf 
//               WHERE gl.unique_id = '{$unique_id}' $linkClause 
//               GROUP BY gl.id 
//               ORDER BY click_count DESC 
//               LIMIT 5";
// $chatresult = mysqli_query( $conn, $chatquery );

// $links = [];
// while ( $chatrow = mysqli_fetch_assoc( $chatresult ) ) {
// 	$links[] = [ 
// 		'title' => $chatrow['title'],
// 		'randval' => BASE_URL . $chatrow['randval'],
// 		'total_engagement' => $chatrow['click_sum'] + $chatrow['scan_sum']
// 	];
// }

// Prepare the response
$response = [
	// 'storeclickstotal' => $storeclickstotal,
	'totalAmount' => $total_amount,
	'numorders' => $totalorders,
	// 'links' => $links
];

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

// if ( empty( $links ) ) {
// 	$response['no_links'] = `

//      <tr>
//         <div class="col-md-12 text-center">
//             <div class="py-30 bg-light-4 rounded-8 border-light col-md-8 mt-50 mb-50" style="margin: 0% auto;">
//                 <img src="assets/img/edit/store.png" style="width:20%">
//                 <h3 class="px-30 text- fw-500 mt-20">
//                     No Products
//                 </h3>
//                 <p class="pt-10 mb-20">
//                     No links found for the specified period.
//                 </p>
//             </div>
//         </div>
//     </tr>
//     `;
// }

// Return the data as JSON
echo json_encode($response);

$conn->close();
