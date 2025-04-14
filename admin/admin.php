<?php
session_start();
include_once "inc/config.php";
$pagetitle = "Settings";
include_once "inc/drc.php";

if (!isset($_SESSION['user_id'])) {
	header("location: " . ADMIN_LOGIN . "?url=" . $current_url . "&t=" . $pagetitle); // redirect to login page if not signed in
	exit; // Make sure to exit after sending the redirection header
} else {
	$user_id = $_SESSION['user_id'];
}
$sql = mysqli_query($conn, "SELECT admin_level FROM olnee_admin WHERE user_id = '{$_SESSION['user_id']}'");
$row = mysqli_fetch_assoc($sql);

$admin_level = $row['admin_level'];

if ($admin_level < 4) {
	header("location: " . DASHBOARD); // redirect to login page if not signed in
	exit; // Make sure to exit after sending the redirection header
}

include_once "ad_comp/adm-head.php";
include_once "ad_comp/adm-header.php";


?>
<?php include_once "ad_comp/adm-sidebar.php"; ?>

<div class="dashboard__content bg-light-4">
	<div class="row pb- justify-between">
		<div class="col-auto">
			<h2 class="text- lh-1 fw-700">Admin Settings</h2>
			<div class="mt-5">
				Your can manage your Admin settings.
			</div>
		</div>
		<div class="col-auto md:mt-10 md:mb-10 mt-5">
			<a data-toggle="modal" data-target="#modal-coupon-rate" class="button -icon -deep-green-1 text-white">Add New Admin</a>
		</div>
	</div>
	<div class="row y-gap-30 pt-30">
		<?php

		if (isset($_GET['edit'])) {
			$admin_id = $_GET['edit'];
			$admin_query = "SELECT * FROM olnee_admin WHERE user_id = '$admin_id' ORDER BY created_at DESC ";
			$admin_result = mysqli_query($conn, $admin_query);
			$count_admin = mysqli_num_rows($admin_result);
			if ($count_admin > 0) {
				while ($row = mysqli_fetch_assoc($admin_result)) {
					$admin_first_name = !empty($row["fname"]) ? $row["fname"] : "No info entered";
					$admin_last_name = !empty($row["fname"]) ? $row["lname"] : "No info entered";
					$fullname = $admin_first_name . ' ' . $admin_last_name;
					$admin_phone = $row['admin_phone'];
					// $admin_phone = !empty($admin_phone) ? $admin_phone : "No contact phone entered";
					$admin_email = $row['admin_email'];
					$admin_email = !empty($admin_email) ? $admin_email : "No contact email entered";
					$admin_level = $row['admin_level'];
					if ($admin_level == 0) {
						$admin_type = "Level 0 Clerance";
					} elseif ($admin_level == 1) {
						$admin_type = "Level 1 Clearance.";
					} elseif ($admin_level == 2) {
						$admin_type = "Level 2 Clearance.";
					} elseif ($admin_level == 3) {
						$admin_type = "Level 3 Clearance.";
					} elseif ($admin_level == 4) {
						$admin_type = "Level 4 Clearance.";
					} else {
						$admin_type = "Could not retrieve level.";
					}



					$admin_address = $row['admin_address'];
					$admin_state = $row['admin_state'];
					$admin_country = $row['admin_country'];
					$address = $admin_address . ", " . $admin_state . ", " . $admin_country;
					$address = strlen($address > 4) ? $address : "No address entered";

					$linkdate = $row['created_at'];
					$created_at = timeAgo($linkdate);
				}

		?>
				<div class="row y-gap-30">
					<div class="col-12">
						<div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">

							<div class="tabs__content py-30 px-30">

								<div class="">
									<form action="#" id="admin_update" class="contact-form row y-gap-10">
										<div class="col-md-6">
											<label class="text-16 lh-1 fw-500 text-dark-1 mb-10">First Name</label>
											<input type="text" name="fname" value="<?php echo $admin_first_name; ?>" placeholder="First Name">
											<input type="hidden" name="admin_id" value="<?php echo $admin_id ?>">
										</div>
										<div class="col-md-6">
											<label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Last Name</label>
											<input type="text" name="lname" value="<?php echo $admin_last_name; ?>" placeholder="Last Name">
										</div>
										<div class="col-md-6">
											<label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Email Address</label>
											<input type="email" name="admin_email" value="<?php echo $admin_email; ?>" placeholder="Email Address">
										</div>
										<div class="col-md-6">
											<label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Phone</label>
											<input type="number" name="admin_phone" value="<?php echo $admin_phone; ?>" placeholder="Phone">
										</div>
										<div class="col-md-6">
											<label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Clearnace Level</label>
											<select name="admin_level" value="<?php echo $admin_level; ?>" id="">
												<option value="">Choose a Level</option>
												<option value="0">Level 0</option>
												<option value="1">Level 1</option>
												<option value="2">Level 2</option>
												<option value="3">Level 3</option>
											</select>
										</div>

										<div class="col-md-6">
											<label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Address</label>
											<input type="text" name="admin_address" value="<?php echo $admin_address; ?>" placeholder=" Address">
										</div>
										<div class="col-md-6">
											<label class="text-16 lh-1 fw-500 text-dark-1 mb-10">State</label>
											<input type="text" name="admin_state" value="<?php echo $admin_state; ?>" placeholder="State">
										</div>
										<div class="col-md-6">
											<label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Country</label>
											<input type="text" name="admin_country" value="<?php echo $admin_country; ?>" placeholder="Country">
										</div>

										<div class="row justify-end mt-10" style="    --bs-gutter-x: 5px;">
										<div class="col-auto">
											<button class="button -md -deep-green-1 text-white">Update Profile</button>
										</div>
										</div>
									</form>
								</div>
							</div>

						</div>
					</div>
				</div>
			<?php
			} else {
			?>
				<div class="row y-gap-30">
					<div class="col-12">
						<div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
							<h3 class="text-center">
								Admin does not exist.
							</h3>
						</div>
					</div>
				</div>
				<?php
			}
		} else {
			$admin_query = "SELECT * FROM olnee_admin WHERE admin_level < 4 ORDER BY created_at DESC ";
			$admin_result = mysqli_query($conn, $admin_query);
			$count_admin = mysqli_num_rows($admin_result);
			if ($count_admin > 0) {
				while ($row = mysqli_fetch_assoc($admin_result)) {
					$admin_id = $row['user_id'];
					$admin_first_name = !empty($row["fname"]) ? $row["fname"] : "No info entered";
					$admin_last_name = !empty($row["fname"]) ? $row["lname"] : "No info entered";
					$fullname = $admin_first_name . ' ' . $admin_last_name;
					$admin_phone = $row['admin_phone'];
					$admin_phone = !empty($admin_phone) ? $admin_phone : "No contact phone entered";
					$admin_email = $row['admin_email'];
					$admin_email = !empty($admin_email) ? $admin_email : "No contact email entered";
					$admin_level = $row['admin_level'];
					if ($admin_level == 0) {
						$admin_type = "Level 0 Clerance";
					} elseif ($admin_level == 1) {
						$admin_type = "Level 1 Clearance.";
					} elseif ($admin_level == 2) {
						$admin_type = "Level 2 Clearance.";
					} elseif ($admin_level == 3) {
						$admin_type = "Level 3 Clearance.";
					} elseif ($admin_level == 4) {
						$admin_type = "Level 4 Clearance.";
					} else {
						$admin_type = "Could not retrieve level.";
					}



					$admin_address = $row['admin_address'];
					$admin_state = $row['admin_state'];
					$admin_country = $row['admin_country'];
					$address = $admin_address . ", " . $admin_state . ", " . $admin_country;
					$address = strlen($address > 4) ? $address : "No address entered";

					$linkdate = $row['created_at'];
					$created_at = timeAgo($linkdate);

				?>
					<div class=" col-md-6 border-light bg-white rounded- p-4" style="overflow-wrap: anywhere;">
						<div class="d-flex ">
							<div class="size-100 mr-20 brand-pic-display md:mt-15 d-none" style="background-image: url('');">
							</div>

							<div class="comments__body md:mt-15">
								<div class="row justify-between ">
									<div class="col-auto">
										<div class="comments__header">
											<h4 class="text-17 fw-600 lh-15 mb-0">
												<?php
												echo $admin_first_name . ' ' . substr($admin_last_name, 0, 1) . '.';
												?>
											</h4>
											<span class="text-13 text-light-1 fw-300">
												<?php echo $created_at ?>
											</span>
										</div>
									</div>
									<div class="col-auto">
										<div class="dropdown">
											<img src="assets/img/icons/more_horiz.png" alt="" width="50%">
											<div class="dropdown-content">
												<a href="<?php echo '?edit=' . $admin_id  ?>">Edit Admin</a>
												<!-- <a data-toggle="modal" data-target="#copy-link-edit-link-<?php ?>">Copy Link</a> -->
											</div>
										</div>
									</div>
								</div>

								<div class="row pb- y-gap-20 justify-between mt-15">
									<div class="col-auto">
										<h5 class="text-15 fw-500 mb-0">Email Address</h5>
										<a href="mailto:<?php echo $admin_email; ?>" class="text-15  underline">
											<?php echo $admin_email; ?>
										</a>
									</div>
									<div class="col-auto">
										<h5 class="text-15 fw-500 mb-0">Phone</h5>
										<a href="tel:<?php echo $admin_phone; ?>" class="text-15  underline">
											<?php echo $admin_phone; ?>
										</a>
									</div>

									<div class="col-auto">
										<h5 class="text-15 fw-500 mb-0">Address</h5>
										<?php echo $address; ?>
									</div>
									<div class="col-auto">
										<h5 class="text-15 fw-500 mb-0">Admin Level</h5>
										<?php echo $admin_type; ?>
									</div>
								</div>

							</div>
						</div>
					</div>


					<div class="modal fade" id="edit-link-<?php ?>" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-body p-4">
									<div class="media media-rg media-middle media-circle text-primary bg-primary bg-opacity-20 mb-3">
										<em class="icon ni ni-spark-fill">
										</em>
									</div>
									<h2 class="h1">
										<?php
										// if () {
											
										// } else {
										// 	if (strlen() > 20) {
										// 		echo substr( 0, 20) . '...';
										// 	} else {
										// 		;
										// 	}
										// }
										?>
									</h2>
									<p><span class="text-dark">23 Mar, 2023</span>.</p>
									<div class="card bg-lighter bg-opacity-80 shadow-none mt-2">
										<div class="card-body">
											<h5>What you will lose after changing your active subscription?</h5>
											<ul class="list-dot gap gy-2 mt-2">
												<li>You won’t have a dedicated account manager</li>
												<li>No custom tools will be existed for AI content generations.</li>
												<li>You’ll lose access to advance integrations.</li>
												<li>No prioritized support will be provided for you.</li>
												<li>Server response rate will be standard than faster.</li>
												<li>Regular model updates instead of special features early access.</li>
											</ul>
										</div>
									</div>
									<ul class="row gx-4 mt-4">
										<li class="col-6">
											<button class="btn btn-outline-light w-100" data-bs-dismiss="modal">Keep Plan</button>
										</li>
										<li class="col-6">
											<a href="pricing-plans.html" class="btn btn-primary w-100">Change Plan</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>

				<?php
				}
			} else {
				?>
				<div class="row y-gap-30">
					<div class="col-12">
						<div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
							<h3 class="text-center">
								You have not created any links.
							</h3>
						</div>
					</div>
				</div>
		<?php
			}
		}
		?>

	</div>
</div>
<script src="api/settings.js"></script>
<?php
include_once "ad_comp/adm-footer.php";
include_once "ad_comp/adm-tail.php";
?>