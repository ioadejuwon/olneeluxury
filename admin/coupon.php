<?php
session_start();

include_once "inc/config.php";
$pagetitle = "Coupon Codes";
include_once "inc/drc.php";

$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$inventorycode = $uriSegments[$inventoryvalue];
$v = mysqli_real_escape_string($conn, $inventorycode);


if (!isset($_SESSION['user_id'])) {
	header("location: " . ADMIN_LOGIN . "?url=" . $current_url . "&t=" . $pagetitle); // redirect to login page if not signed in
	exit; // Make sure to exit after sending the redirection header
} else {
	$user_id = $_SESSION['user_id'];
}



include_once "ad_comp/adm-head.php";
include_once "ad_comp/adm-header.php";
$sql = mysqli_query($conn, "SELECT * FROM olnee_admin WHERE user_id = '{$_SESSION['user_id']}'");
$row = mysqli_fetch_assoc($sql);
$fname = $row['fname'];
include_once "ad_comp/adm-sidebar.php";
$deliveries = mysqli_query($conn, "SELECT * FROM olnee_coupons");
?>


<div class="dashboard__content bg-light-4">
	<div class="row pb- justify-between">
		<div class="col-auto">
			<h2 class="text- lh-1 fw-700">Coupon Codes</h2>
			<div class="mt-5">
				Manage your coupon codes here
			</div>
		</div>
		<div class="col-auto md:mt-10 md:mb-10 mt-5">
			<a data-toggle="modal" data-target="#modal-coupon-rate" class="button -icon -deep-green-1 text-white">Add New Coupon</a>
		</div>
	</div>

	<div class="row y-gap-30 pt-30">
		<div class="col-xl-12 col-md-12">
			<div class="rounded-16 text-white shadow-4 h-100">

				<!-- <div class="table-responsive"> -->
				<table class="table w-100">
					<thead>
						<tr>
							<!-- <th>S/N</th> -->
							<th><span class="lg:d-none">Coupon&nbsp;</span>Name</th>
							<th><span class="lg:d-none">Coupon&nbsp;</span>Code</th>
							<th><span class="lg:d-none">Coupon&nbsp;</span>Type</th>
							<th><span class="lg:d-none">Coupon&nbsp;</span>Value</th>
							<th>Date Created</th>
						</tr>
					</thead>
					<tbody id="couponTableBody">
						<?php

						$couponquery = "SELECT * FROM olnee_coupons  ORDER BY created_at DESC ";
						$couponresult = mysqli_query($conn, $couponquery);
						$count_row_coupon = mysqli_num_rows($couponresult);

						if ($count_row_coupon != 0) {


							while ($row = mysqli_fetch_assoc($couponresult)) {

								$couponName = $row['couponName'];
								$couponCode = $row['couponCode'];
								$couponType = $row['couponType'];
								$couponValue = $row['couponValue'];
								if ($couponType == 1) {
									$couponType = 'Percentage Off';
									$couponValue = $couponValue . '% off';
									// $couponPercent = $row['couponPercent'];
								} elseif ($couponType == 2) {
									$couponType = 'Fixed amount';
									// $couponPercent = $row['couponValue'];
									$couponValue = NAIRA . number_format($couponValue, 2);
								} else {
									$couponType = 'Free Delivery';
									$couponValue = 'Free Delivery';
								}

								$created_at = $row['created_at'];
								$date = strtotime($created_at);
								$dateformat = date('D., jS M.', $date);
								$deliveryCost = '&#8358;' . number_format($deliveryCost, 2);
								// $biz_id = $row['$biz_id'];  


						?>
								<tr>

									<td class="underline">
										<?php echo $couponName ?>
									</td>

									<td>
										<?php echo $couponCode ?>
									</td>
									<td>
										<?php echo $couponType ?>
									</td>
									<td>
										<?php echo $couponValue ?>
									</td>
									<td>
										<?php echo $dateformat ?>
									</td>

								</tr>

							<?php
							}
						} else {
							// echo "No Coupon codes";
							?>
							<tr class="col-md-12 text-center">
								<td colspan="5" class="p-0">
									<div class="py-30 px-30 bg-light-4 rounded-8 border-light col-md-12 move-center">
										<img src="assets/img/store.png" style="width:20%">
										<h3 class=" text- fw-500 mt-20">
											No Coupon Codes yet!
										</h3>
										<p class="pt-10 mb-20">
											Add coupon codes for tem to appear here
										</p>
										<div class="col-md-6 move-center">
											<a href="" class="button -md -deep-green-1 text-white p-0">Add coupon</a>
										</div>
									</div>
								</td>
							</tr>
						<?php
						}
						?>

					</tbody>
				</table>
				<!-- </div> -->

			</div>
		</div>
	</div>

</div>

<div class="modal fade" id="modal-coupon-rate" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header border-bottom-dark">
				<h5 class="modal-title">Add Coupon Code</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<img src="assets/img/icons/close.png" alt="close" width="30%">
				</button>
			</div>
			<div class="modal-body pt-0">

				<form class="contact-form row y-gap-30" id="couponForm" method="POST">
					<div class="col-md-6 col-12" id="coupon-name">
						<label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Coupon Name <span class="text-error-1">*</span> </label>
						<input type="text" class="form-control" name="couponname" id="category" placeholder="Enter the coupon name">
					</div>
					<div class="col-md-6 col-12" id="coupon-code">
						<label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Delivery Code <span class="text-error-1">*</span> </label>
						<input type="text" class="form-control" name="couponcode" id="category" placeholder="Enter the percent off">
					</div>
					<div class="col-md-6 col-12" id="coupon-percent">
						<label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Coupon Type<span class="text-error-1">*</span> </label>
						<!-- <input type="number" class="form-control" name="percent" id="category" placeholder="Enter the percent off"> -->
						<select name="couponType" id="">
							<option value="">Choose coupon type</option>
							<option value="1">Percentage off</option>
							<option value="2">Fixed Value</option>
						</select>
					</div>
					<div class="col-md-6 col-12" id="coupon-value">
						<label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Coupon Value<span class="text-error-1">*</span> </label>
						<input type="number" class="form-control" name="value" id="category" placeholder="Enter the percent off">
					</div>

					<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">


					<div class="d-flex w-100  border-top-dark">
						<!-- <button type="button" class="button -md -deep-green-1 flex-fill" data-dismiss="modal">Close</button> -->
						<!-- <button type="button" class="button -md -deep-green-1 flex-fill">Save changes</button> -->
						<button class="button -md -deep-green-1 text-white flex-fill" type="submit" id="submit">
							Add Coupon Code
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



<script src="api/coupon.js"></script>
<?php
include_once "ad_comp/adm-footer.php";
include_once "ad_comp/adm-tail.php";
?>