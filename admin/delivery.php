<?php
session_start();

include_once "inc/config.php";
$pagetitle = "Delivery";
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
$deliveries = mysqli_query($conn, "SELECT * FROM olnee_delivery");
?>


<div class="dashboard__content bg-light-4">
	<div class="row pb- justify-between">
		<div class="col-auto">
			<h2 class="text-30 lh-12 fw-700">All Delivery Rates</h2>
			<div class="mt-5">
				Manage your delivery rates here
			</div>
		</div>
		<div class="col-auto md:mt-10 md:mb-10 mt-5">
			<a data-toggle="modal" data-target="#modal-delivery-rate" class="button -icon -deep-green-1 text-white">Add New Rate</a>
		</div>
	</div>


	<div class="row y-gap-30 pt-30 d-none">
		<div class="col-xl-12 col-md-12">
			<div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
				<div class="d-flex items-center py-20 px-30 border-bottom-light">
					<h2 class="text-17 lh-1 fw-500">Add Delivery Location</h2>
				</div>
				<div class="py-30 px-30">
					<form class="contact-form row y-gap-30" id="deliveryFormd" method="POST">
						<div class="col-md-6 col-12" id="delivery-name">
							<label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Delivery Name <span class="text-error-1">*</span> </label>
							<input type="text" class="form-control" name="deliveryname" id="category" placeholder="Enter the dleivery label">
						</div>
						<div class="col-md-6 col-12" id="delivery-cost">
							<label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Delivery Rate <span class="text-error-1">*</span> </label>
							<input type="number" class="form-control" name="deliverycost" id="category" placeholder="Enter the delivery cost">
						</div>
						<div class="col-12">
							<div class="">For instance, "Outside Lagos" or "Mainland" or "Island"</div>
						</div>
						<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

						<div class="col-md-6 col-12  justify-end">

							<button class="button -md -deep-green-1 text-white" type="submit" id="submit">
								Add Delivery Rate
							</button>
						</div>
					</form>

				</div>

			</div>
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
								<th><span class="lg:d-none">Delivery&nbsp;</span>Label</th>
								<th><span class="lg:d-none">Delivery&nbsp;</span>Rate</th>
								<th>Action</th>
								<!-- <th>Date Created</th> -->
							</tr>
						</thead>
						<tbody id="deliveryTableBody">
							<?php

							$deliveryquery = "SELECT * FROM olnee_delivery WHERE user_id = '{$user_id}'  ORDER BY created_at DESC";
							$deliveryresult = mysqli_query($conn, $deliveryquery);
							$count_row_deliveries = mysqli_num_rows($deliveryresult);

							if ($count_row_deliveries != 0) {


								while ($row = mysqli_fetch_assoc($deliveryresult)) {

									$deliveryName = $row['deliveryName'];
									$deliveryid = $row['deliveryID'];
									$deliveryCost = $row['deliveryCost'];
									$unique_id = $row['unique_id'];
									$created_at = $row['created_at'];
									$date = strtotime($created_at);
									$dateformat = date('D., jS M.', $date);
									$deliveryCost = '&#8358;' . number_format($deliveryCost, 2);
									// $biz_id = $row['$biz_id'];  


							?>
									<tr id="delivery-<?php echo $deliveryid; ?>">
										<td class="underline">
											<?php echo $deliveryName ?>
										</td>
										<td>
											<?php echo $deliveryCost ?>
										</td>
										<td class="dropdown">
											<img src="assets/img/icons/more_horiz.png" alt="" width="50%">
											<div class="dropdown-content">
												<a data-toggle="modal" data-target="#edit-<?php echo $deliveryid; ?>">Edit Rate</a>
												<a data-toggle="modal" data-target="#delete-<?php echo $deliveryid; ?>">Delete</a>
											</div>
										</td>
									</tr>

									<div id="modalTableBody">
										<div class="modal fade" id="delete-<?php echo $deliveryid; ?>" tabindex="-1">
											<div class="modal-dialog modal-dialog-centered">
												<div class="modal-content">
													<div class="modal-header">
														<!-- <h5 class="modal-title"></h5> -->
														<h2 class="modal-title h4">Delete Delivery Rate</h2>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<img src="assets/img/icons/close.png" alt="close" width="30%">
														</button>
													</div>
													<div class="modal-body p-4 pt-0">


														<p class="text-dark">Are you sure you want to delete the category "<span class="fw-600"><?php echo $deliveryName ?></span>". This process is irreversible.</p>

														<ul class="row gx-4 mt-4">
															<li class="col-6 d-none">
																<button class="button -outline-dark-3 -md w-100" data-bs-dismiss="modal">Close</button>
																<!-- <button class="button -md -deep-green-1 text-white" type="submit" id="submit">nn</button> -->
															</li>

															<li class="col-12">
																<a href="#" class="button -red-1 w-100 button -md -deep-green-1 text-white delete-delivery-btn" data-deliveryid="<?php echo $deliveryid; ?>">Delete Rate</a>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php
								}
							} else {

								?>
								<tr class="layout-pt-lg layout-pb-lg section-bg mt-30 empty ">
									<div class="section-bg__item bg-light-6"></div>
									<td colspan="6" class="container desction">
										<div class="row y-gap-20 justify-center text-center">
											<div class="col-auto">
												<img src="assets/img/store.png" style="width:20%">
												<div class="sectionTitle ">
													<h2 class="sectionTitle__title ">No delivery rates set!</h2>
													<p class="sectionTitle__text h4 pt-15">
														Click the buttons below to add delviery prices
													</p>
												</div>
												<div class="row justify-center pt-30">
													<div class="col-auto">
														<a data-toggle="modal" data-target="#modal-delivery-rate" class="button -icon  -deep-green-1 text-white">
															Add Delivery Rate <i class="icon-arrow-top-right text-13 ml-10"></i>
														</a>
													</div>
												</div>
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
<div class="modal fade" id="modal-delivery-rate" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header border-bottom-dark">
				<h4 class="modal-title">Add Delivery Rate</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<img src="assets/img/icons/close.png" alt="" width="20%">
				</button>
			</div>
			<div class="modal-body pt-0">

				<form class="contact-form row y-gap-30" id="deliveryForm" method="POST">
					<div class="col-md-6 col-12" id="delivery-name">
						<label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Delivery Name <span class="text-error-1">*</span> </label>
						<input type="text" class="form-control" name="deliveryname" id="category" placeholder="Enter the dleivery label">
					</div>
					<div class="col-md-6 col-12" id="delivery-cost">
						<label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Delivery Rate <span class="text-error-1">*</span> </label>
						<input type="number" class="form-control" name="deliverycost" id="category" placeholder="Enter the delivery cost">
					</div>
					<div class="col-12">
						<div class="">For instance, "Outside Lagos" or "Mainland" or "Island"</div>
					</div>
					<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
					<div class="d-flex w-100  border-top-dark">
						<!-- <button type="button" class="button -md -deep-green-1 flex-fill" data-dismiss="modal">Close</button> -->
						<!-- <button type="button" class="button -md -deep-green-1 flex-fill">Save changes</button> -->
						<button class="button -md -deep-green-1 text-white flex-fill" type="submit" id="submit">
							Add Delivery Rate
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>




<script src="api/delivery.js"></script>
<?php
include_once "ad_comp/adm-footer.php";
include_once "ad_comp/adm-tail.php";
?>