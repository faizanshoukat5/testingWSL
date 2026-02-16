<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<?php
	$url = basename($_SERVER['REQUEST_URI']);
	if (strpos($url, '?') !== false) {
		// Remove everything after and including the question mark
		$url = strstr($url, '?', true);
	}
	$url = trim($url, '/');
	$url = preg_replace('/-+/', ' ', $url);
	?>
	<title><?php echo ucwords($url);?> | <?php echo ucwords($_SESSION['com_name']); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- App favicon -->
	<link rel="shortcut icon" href="../images/<?php echo $_SESSION['com_logo'];?>">
	<!-- third party css -->
	<link href="../assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
	<link href="../assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
	<link href="../assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
	<!-- App css -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
	<link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/app.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />
	<!-- Select 2 -->
	<link href="../assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
	<!-- custom style css -->
	<link rel="stylesheet" type="text/css" href="../assets/custom_style.css">
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script> -->
	<!-- ckeditor -->
	<script src="../assets/ckeditor/ckeditor.js"></script>
	<script src="../assets/ckfinder/ckfinder.js"></script>
</head>

<body class="left-side-menu-light">
	<!-- Begin page -->
	<div id="wrapper">
		<!-- Topbar Start -->
		<div class="navbar-custom">
			<ul class="list-unstyled topnav-menu float-right mb-0">
				<li class="dropdown notification-list">
					<a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
						<img src="../images/<?php echo $_SESSION['com_logo'];?>" alt="user-image" class="rounded-circle">
						<span class="pro-user-name ml-1 text-white">
							<?php echo ucwords($_SESSION['uname']);?> <i class="mdi mdi-chevron-down"></i> 
						</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right profile-dropdown ">
						<!-- item-->
						<div class="dropdown-header noti-title">
							<h6 class="text-overflow m-0">Welcome !</h6>
						</div>
						<!-- item-->
						<a href="profile-setting" class="dropdown-item notify-item">
							<i class="mdi mdi-account"></i>
							<span>Profile</span>
						</a>
						<!-- item-->
						<a href="change-password" class="dropdown-item notify-item">
							<i class="mdi mdi-lock"></i>
							<span>Change Password</span>
						</a>
						<div class="dropdown-divider"></div>
						<!-- item-->
						<a href="log-out" class="dropdown-item notify-item text-danger">
							<i class="mdi mdi-login-variant"></i>
							<span>Logout</span>
						</a>

					</div>
				</li>
			</ul>

			<!-- LOGO -->
			<div class="logo-box">
				<a href="admission-dashboard" class="logo text-center">
					<span class="logo-lg">
						<!-- <img src="../images/<?php echo $_SESSION['com_logo'];?>" alt="" height="55"> -->
						<span class="logo-lg-text-light"><?php echo ucwords($_SESSION['com_name']); ?></span>
					</span>
					<span class="logo-sm">
						<!-- <span class="logo-sm-text-dark">U</span> -->
						<img src="../images/<?php echo $_SESSION['com_logo'];?>" alt="" height="55">
					</span>
				</a>
			</div>
			<ul class="list-unstyled topnav-menu topnav-menu-left m-0">
				<li>
					<button class="button-menu-mobile waves-effect waves-light">
						<i class="mdi mdi-menu"></i>
					</button>
				</li>
			</ul>
			<!-- include from components Session Year View file -->
			<?php include ("../components/sessionYearView.php"); ?>
		</div>
		<!-- end Topbar -->

		<!-- ========== Left Sidebar Start ========== -->
		<div class="left-side-menu">
			<div class="slimscroll-menu">
				<!--- Sidemenu -->
				<div class="user-sidebar text-center">
					<div class="dropdown">
						<div class="user-img">
							<img src="../images/<?php echo $_SESSION['user_image'];?>" alt="" class="rounded-circle">
							<span class="avatar-online bg-success"></span>
						</div>
						<div class="user-info">
							<h5 class="mt-1 font-size-16 text-white text-truncate"><?php echo ucwords($_SESSION['uname']);?></h5>
							<span class="font-size-13 text-white text-truncate"><?php echo ucwords($_SESSION['user_designation']);?></span>
							<br>
							<span style="font-size: 20px; padding:3px 6px; height: 20px; width: 20px; border-radius: 50%;" class="bg-primary"><a href="profile-setting" class="text-white" data-toggle="tooltip" data-placement="top" title="Edit Your Profile"><i class="mdi mdi-square-edit-outline"></i></a></span>
							<span style="font-size: 20px; padding:3px 6px; height: 20px; width: 20px; border-radius: 50%; background: white;"><a href="log-out" class="text-danger" data-toggle="tooltip" data-placement="top" title="Logout"><i class="mdi mdi-power"></i></a></span>
							<!-- include from components Session Year Selector file -->
							<?php include ("../components/sessionYearSelector.php"); ?>
						</div>
					</div>
				</div>
				<div id="sidebar-menu">
					<ul class="metismenu" id="side-menu">
						<li class="menu-title">Dashboard</li>
						<li>
							<a href="admission-dashboard">
								<i class="mdi mdi-desktop-mac"></i>
								<span>Admission Dashboard </span>
							</a>
						</li>
						<li>
							<a href="visa-dashboard">
								<i class="mdi mdi-monitor-dashboard"></i>
								<span>Visa Dashboard </span>
							</a>
						</li>
						
						<li class="menu-title">Clients</li>
						<li>
							<a href="all-clients">
								<i class="mdi mdi-account-multiple-plus"></i>
								<span>All Clients </span>
							</a>
						</li>
						<li>
							<a href="all-clients-27-28">
								<i class="mdi mdi-eye"></i>
								<span>All Clients 27-28 </span>
							</a>
						</li>
						<li class="menu-title">Filter's</li>
						<?php
						$currentDate = date('Y-m-d');
						$degrees = [
							'bachelor' => ['icon' => 'mdi-alpha-b-circle-outline', 'title' => 'Bachelor Universities', 'url' => 'bachelor-universities'],
							'master'   => ['icon' => 'mdi-alpha-m-circle-outline', 'title' => 'Master Universities', 'url' => 'master-universities'],
							'mbbs'   => ['icon' => 'mdi-alpha-m-circle-outline', 'title' => 'MBBS Universities', 'url' => 'mbbs-universities'],
							'phd'   => ['icon' => 'mdi-alpha-p-circle-outline', 'title' => 'PHD Universities', 'url' => 'phd-universities']
						];
						foreach ($degrees as $degree => $info) {
							$sr = 1;
							$query = "SELECT * FROM italy_add_universities{$_SESSION['dbNo']} WHERE status='1' AND close='1' AND italy_uni_degree='$degree' ORDER BY italy_add_id ASC";
							$result = mysqli_query($con, $query);
							$count = mysqli_num_rows($result);
						?>
						<li id="side-menu2">
							<a href="javascript:void(0);">
								<i class="mdi <?= $info['icon']; ?>"></i>
								<span><?= $info['title']; ?> </span>

								<span class="menu-arrow"></span>
							</a>

							<ul class="nav-second-level" aria-expanded="false">
								<?php while ($row = mysqli_fetch_assoc($result)): 
									$linkStyle = '';
									$linkColor = 'default';

									$dateQuery = "SELECT italy_date_status, italy_opening_date, italy_closing_date FROM italy_university_dates WHERE status='1' AND close='1' AND italy_university_name='{$row['italy_uni_name']}' AND italy_degree_name='$degree' ORDER BY italy_dates_id DESC LIMIT 1";
									$dateResult = mysqli_query($con, $dateQuery);

									if ($dateResult && mysqli_num_rows($dateResult) > 0) {
										$dateRow = mysqli_fetch_assoc($dateResult);
										$dateStatus = $dateRow['italy_date_status'];
										$openingDate = $dateRow['italy_opening_date'];
										$closingDate = $dateRow['italy_closing_date'];
										if ($dateStatus == '1' && $currentDate >= $openingDate && $currentDate <= $closingDate) {
											$linkColor = '#32c861';
										} elseif ($dateStatus == '1' && $currentDate < $openingDate && $currentDate < $closingDate) {
											$linkColor = '#ffa91c';
										} elseif ($dateStatus == '2') {
											$linkColor = '#f96a74';
										}
										if ($linkColor != 'default') {
											$linkStyle = "style='color: {$linkColor} !important; background: !important; font-weight:500; '";
										}
									}
								?>
								<li>
									<a href="<?= $info['url'];?>?university-name=<?= urlencode($row['italy_uni_name']); ?>&degree-name=<?= $degree?>" <?= $linkStyle; ?>>
										<b><?= $sr; ?></b> <i class="mdi mdi-unicode"></i> <?= $row['italy_uni_name']; ?>
										<b><mark><u>
											<?= ($row['italy_uni_direct_apply'] == '1' ? "(DUA)" : "") .
											($row['italy_uni_pre_enrollment'] == '1' ? "(DPE)" : "") .
											($row['italy_uni_dream_apply'] == '1' ? "(DA)" : ""); ?>
										</u></mark></b>
									</a>
								</li>
								<?php $sr++; endwhile; ?>
							</ul>
						</li>
						<?php } ?>
						<li>
							<a href="direct-pre-enrollment">
								<i class="mdi mdi-alpha-d-circle-outline"></i>
								<span>Direct Pre Enrollment </span>
							</a>
						</li>
						<?php
						$currentDate = date('Y-m-d');
						$degrees = [
							'pre enrollment' => ['icon' => 'mdi-alpha-p-circle-outline', 'title' => 'Pre Enrollment Universities', 'url' => 'pre-enrollment-universities']
						];
						foreach ($degrees as $degree => $info) {
							$sr = 1;
							$query = "SELECT * FROM italy_add_universities{$_SESSION['dbNo']} WHERE status='1' AND close='1' GROUP BY italy_uni_name ORDER BY italy_add_id ASC";
							$result = mysqli_query($con, $query);
							$count = mysqli_num_rows($result);
						?>
						<li id="side-menu2">
							<a href="javascript:void(0);">
								<i class="mdi <?= $info['icon']; ?>"></i>
								<span><?= $info['title']; ?> </span>
								<span class="menu-arrow"></span>
							</a>

							<ul class="nav-second-level" aria-expanded="false">
								<?php while ($row = mysqli_fetch_assoc($result)): 
									$linkStyle = '';
									$linkColor = 'default';

									$dateQuery = "SELECT italy_date_status, italy_opening_date, italy_closing_date FROM italy_university_dates WHERE status='1' AND close='1' AND italy_university_name='{$row['italy_uni_name']}' AND italy_degree_name='$degree' ORDER BY italy_dates_id DESC LIMIT 1";
									$dateResult = mysqli_query($con, $dateQuery);

									if ($dateResult && mysqli_num_rows($dateResult) > 0) {
										$dateRow = mysqli_fetch_assoc($dateResult);
										$dateStatus = $dateRow['italy_date_status'];
										$openingDate = $dateRow['italy_opening_date'];
										$closingDate = $dateRow['italy_closing_date'];
										if ($dateStatus == '1' && $currentDate >= $openingDate && $currentDate <= $closingDate) {
											$linkColor = '#32c861';
										} elseif ($dateStatus == '1' && $currentDate < $openingDate && $currentDate < $closingDate) {
											$linkColor = '#ffa91c';
										} elseif ($dateStatus == '2') {
											$linkColor = '#f96a74';
										}
										if ($linkColor != 'default') {
											$linkStyle = "style='color: {$linkColor} !important; background: !important; font-weight:500; '";
										}
									}
								?>
								<li>
									<a href="<?= $info['url'];?>?university-name=<?= urlencode($row['italy_uni_name']); ?>&degree-name=<?= $degree?>" <?= $linkStyle; ?>>
										<b><?= $sr; ?></b> <i class="mdi mdi-unicode"></i> <?= $row['italy_uni_name']; ?>
									</a>
								</li>
								<?php $sr++; endwhile; ?>
							</ul>
						</li>
						<?php } ?>
						<li id="side-menu2">
							<a href="javascript: void(0);">
								<i class="mdi mdi-alpha-a-circle-outline"></i>
								<span>Apply Filter </span>
								<span class="menu-arrow"></span>
							</a>
							<ul class="nav-second-level" aria-expanded="false">
								<li> <a href="direct-universities-apply"><i class="mdi mdi-alpha-d-circle-outline"></i> Direct Universities Apply</a></li>

								<li> <a href="dream-id-apply"><i class="mdi mdi-alpha-i-circle-outline"></i> Dream ID Apply</a></li>
								<li> <a href="cimea-apply-clients"><i class="mdi mdi-alpha-c-circle-outline"></i> Cimea Apply Clients</a></li>
								<li> <a href="before-CEnT-S-test"><i class="mdi mdi-alpha-t-circle-outline"></i> Before CEnT-S Test</a></li>
								<li> <a href="after-CEnT-S-test"><i class="mdi mdi-alpha-t-circle-outline"></i> After CEnT-S Test</a></li>
							</ul>
						</li>
						<li class="menu-title">University 2026-2027</li>
						<li>
							<a href="universities-and-program-for-2026-2027">
								<i class="mdi mdi-file"></i>
								<span>Universities and Program For 2026-2027 </span>
							</a>
						</li>
						<li>
							<a href="clients-previous-degree">
								<i class="mdi mdi-school"></i>
								<span>Client's Previous Degree </span>
							</a>
						</li>
						<li class="menu-title">Universities and Programs</li>
						<li>
							<a href="universities-and-programs">
								<i class="mdi mdi-office-building"></i>
								<span>Universities & Programs </span>
							</a>
						</li>
						
						<li class="menu-title">Processing Team</li>
						<li id="side-menu2">
							<a href="javascript: void(0);">
								<i class="mdi mdi-account-group"></i>
								<span>Processing Team </span>
								<span class="menu-arrow"></span>
							</a>
							<ul class="nav-second-level" aria-expanded="false">
								<?php 
								$selectQuery = "SELECT wt_id, fname, lname FROM wt_users WHERE status='1' AND close='1' AND type='italy admission team'";
								$selectQuery_ex = mysqli_query($con, $selectQuery);
								if ($selectQuery_ex && mysqli_num_rows($selectQuery_ex) > 0) {
									$srT=1;
									while ($dataRow = mysqli_fetch_assoc($selectQuery_ex)) {
									?>
									<li> 
										<a href="processing-team?check-processing-team-status=<?php echo $dataRow['wt_id']; ?>"><b><?php echo $srT;?></b> <i class="mdi mdi-account-settings"></i> <?php echo ucwords($dataRow['fname']." ".$dataRow['lname']);?> 
										</a>
									</li>
									<?php
									$srT++;}
								}
								?>
							</ul>
						</li>

						<li class="menu-title">SOP's Team</li>
						<li id="side-menu2">
							<a href="javascript: void(0);">
								<i class="mdi mdi-account-supervisor"></i>
								<span>SOP's Team </span>
								<span class="menu-arrow"></span>
							</a>
							<ul class="nav-second-level" aria-expanded="false">
								<?php 
								$selectQuery = "SELECT wt_id, fname, lname FROM wt_users WHERE status='1' AND close='1' AND type='italy university sop'";
								$selectQuery_ex = mysqli_query($con, $selectQuery);
								if ($selectQuery_ex && mysqli_num_rows($selectQuery_ex) > 0) {
									$srS=1;
									while ($dataRow = mysqli_fetch_assoc($selectQuery_ex)) {
									?>
									<li> 
										<a href="sops-team?check-sops-team-status=<?php echo $dataRow['wt_id']; ?>"><b><?php echo $srS;?></b> <i class="mdi mdi-account-settings"></i> <?php echo ucwords($dataRow['fname']." ".$dataRow['lname']);?> 
										</a>
									</li>
									<?php
									$srS++;}
								}
								?>
							</ul>
						</li>
						<li class="menu-title">Checklist</li>
						<li id="side-menu2">
							<a href="javascript: void(0);">
								<i class="mdi mdi-check-underline-circle"></i>
								<span>Checklist </span>
								<span class="menu-arrow"></span>
							</a>
							<ul class="nav-second-level" aria-expanded="false">
								<li> <a href="dov-checklist?check-status=1"><i class="mdi mdi-check-all"></i> DOV Checklist Sent </a></li>
								<li> <a href="dov-checklist?check-status=0"><i class="mdi mdi-close-outline"></i> DOV Checklist Not Sent </a></li>

								<li> <a href="cimea-checklist?check-status=1"><i class="mdi mdi-check-all"></i> Cimea Checklist Sent </a></li>
								<li> <a href="cimea-checklist?check-status=0"><i class="mdi mdi-close-outline"></i> Cimea Checklist Not Sent </a></li>

								<li> <a href="visa-checklist?check-status=1"><i class="mdi mdi-check-all"></i> Visa Checklist Sent </a></li>
								<li> <a href="visa-checklist?check-status=0"><i class="mdi mdi-close-outline"></i> Visa Checklist Not Sent </a></li>
							</ul>
						</li>
						<li class="menu-title">Opening</li>
						<li>
							<a href="universities-opening ">
								<i class="mdi mdi-unicode"></i>
								<span>Universities Opening </span>
							</a>
						</li>
						<li>
							<a href="universities-requirements ">
								<i class="mdi mdi-office-building"></i>
								<span>University Requirement </span>
							</a>
						</li>

						<li class="menu-title">Case WithDraw</li>
						<li id="side-menu2">
							<a href="javascript: void(0);">
								<i class="mdi mdi-message-draw"></i>
								<span>Case </span>
								<span class="menu-arrow"></span>
							</a>
							<ul class="nav-second-level" aria-expanded="false">
								<li> <a href="clients-case?client-case-status=1"><i class="mdi mdi-check-all"></i> Case WithDraw</a></li>
								<li> <a href="clients-case?client-case-status=2"><i class="mdi mdi-check-all"></i> Case Refund</a></li>
								<li> <a href="clients-case?client-case-status=3"><i class="mdi mdi-check-all"></i> Case On Hold</a></li>
							</ul>
						</li>

						<li class="menu-title">FAQs Section</li>
						<li>
							<a href="faqs-section">
								<i class="mdi mdi-material-design"></i>
								<span>FAQs Section </span>
							</a>
						</li>

						<li class="menu-title">Setting</li>
						<li>
							<a href="javascript: void(0);">
								<i class="mdi mdi-cogs"></i>
								<span>Setting </span>
								<span class="menu-arrow"></span>
							</a>
							<ul class="nav-second-level" aria-expanded="false">
								<li><a href="profile-setting"><i class="mdi mdi-account"></i> Profile</a></li>
								<li><a href="change-password"><i class="mdi mdi-lock"></i> Change Password</a></li>
							</ul>
						</li>
						<li class="menu-title">Logout</li>
						<li>
							<a href="log-out">
								<i class="mdi mdi-login-variant"></i>
								<span> Logout </span>
							</a>
						</li>
					</ul>
				</div>
				<!-- End Sidebar -->
				<div class="clearfix"></div>
			</div>
			<!-- Sidebar -left -->
		</div>
		<!-- Left Sidebar End -->

		<!-- ============================================================== -->
		<!-- Start Page Content here -->
		<!-- ============================================================== -->
		<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showModalClient" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title showModalTitle" id="myLargeModalLabel"></h4>
					</div>
					<div class="modal-body showModalClient">

					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<div class="content-page">
			<div class="content">
				<!-- Start Content-->
				<div class="container-fluid">
					<!-- start page title -->
					<div class="row">
						<div class="col-12">
							<div class="page-title-box">
								<div class="page-title-right">
									<ol class="breadcrumb m-0">
										<li class="breadcrumb-item"><a href="admission-dashboard"><?php echo ucwords($_SESSION['com_name']); ?></a></li>
										<li class="breadcrumb-item active"><?php  echo $head_title1 = ucwords(str_replace("_", " ", $head_title));?></li>
									</ol>
								</div>

								<h4 class="page-title" style="font-size: 22px;font-weight: bolder;">
									<i data-toggle="tooltip" data-placement="top" title="Go Back" class="mdi mdi-skip-backward" style="font-size: 20px; cursor: pointer;" onclick="history.back()"></i>&nbsp;
									<i data-toggle="tooltip" data-placement="top" title="Refresh Page" class="mdi mdi-refresh" style="font-size: 20px; cursor: pointer;" onclick="location.reload();"></i>&nbsp;
									<i data-toggle="tooltip" data-placement="top" title="Go Forward" class="mdi mdi-skip-forward" style="font-size: 20px; cursor: pointer;" onclick="history.forward()"></i>&nbsp;   
									<b><?php echo $head_title1 = ucwords(str_replace("_", " ", $head_title));?></b> 
								</h4>
							</div>
						</div>
					</div>     
					<!-- end page title --> 