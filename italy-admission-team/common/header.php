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
				<a href="dashboard" class="logo text-center">
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
							<a href="dashboard">
								<i class="mdi mdi-desktop-mac"></i>
								<span>Dashboard </span>
							</a>
						</li>
						<li class="menu-title">Clients</li>
						<li>
							<a href="all-clients">
								<i class="mdi mdi-account-group"></i>
								<span>All Clients </span>
							</a>
						</li>
						<li>
							<a href="pre-enrollment-clients">
								<i class="mdi mdi-account-multiple"></i>
								<span>Pre Enrollment Clients </span>
							</a>
						</li>

						<li class="menu-title">Filter's</li>
						<li id="side-menu2">
							<a href="javascript: void(0);">
								<i class="mdi mdi-alpha-b-circle-outline"></i>
								<span>Bachelor Universities </span>
								<span class="menu-arrow"></span>
							</a>
								
							<ul class="nav-second-level" aria-expanded="false">
								<?php
								$currentDate = date('Y-m-d');
								$uniBach = "SELECT * FROM italy_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_uni_degree='bachelor' ORDER BY italy_add_id ASC";
								$uniBach_ex = mysqli_query($con, $uniBach);
								$srB=1;
								foreach ($uniBach_ex as $bachRow) {
									$uniName = '';
									$dateStatus = '';
									$openingDate = '';
									$closingDate = '';
									$linkStyle = '';
									$linkColor = 'default';

									$selectQuery = "SELECT * FROM italy_university_dates WHERE status='1' AND close='1' AND italy_university_name='".$bachRow['italy_uni_name']."' AND italy_degree_name='bachelor' ORDER BY italy_dates_id DESC LIMIT 1";
									$selectQuery_ex = mysqli_query($con, $selectQuery);

									if ($selectQuery_ex && mysqli_num_rows($selectQuery_ex) > 0) {
										$dateRow = mysqli_fetch_assoc($selectQuery_ex);
										$uniName = $dateRow['italy_university_name'];
										$dateStatus = $dateRow['italy_date_status'];
										$openingDate = $dateRow['italy_opening_date'];
										$closingDate = $dateRow['italy_closing_date'];
									}
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
									?>
									<li><a href="bachelor-universities?university-name=<?php echo urlencode($bachRow['italy_uni_name']);?>&client-degree=bachelor" <?php echo $linkStyle; ?>> <b><?php echo $srB;?></b> <i class="mdi mdi-unicode"></i> <?php echo $bachRow['italy_uni_name'];?> <b><mark><u><?= ($bachRow['italy_uni_direct_apply'] == '1' ? "(DUA)" : "") . ($bachRow['italy_uni_pre_enrollment'] == '1' ? "(DPE)" : "") .  ($bachRow['italy_uni_dream_apply'] == '1' ? "(DA)" : ""); ?></u></mark></b></a></li>
									<?php
								$srB++;}
								?>
							</ul>
						</li>
						<li id="side-menu2">
							<a href="javascript: void(0);">
								<i class="mdi mdi-alpha-m-circle-outline"></i>
								<span>Master Universities </span>
								<span class="menu-arrow"></span>
							</a>
							<ul class="nav-second-level" aria-expanded="false">
								<?php
								$currentDate = date('Y-m-d');
								$uniMaster = "SELECT * FROM italy_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_uni_degree='master' ORDER BY italy_add_id ASC";
								$uniMaster_ex = mysqli_query($con, $uniMaster);
								$srM=1;
								foreach ($uniMaster_ex as $masRow) {
									$uniName = '';
									$dateStatus = '';
									$openingDate = '';
									$closingDate = '';
									$linkStyle = '';
									$linkColor = 'default';

									$selectQuery = "SELECT * FROM italy_university_dates WHERE status='1' AND close='1' AND italy_university_name='".$masRow['italy_uni_name']."' AND italy_degree_name='master' ORDER BY italy_dates_id DESC LIMIT 1";
									$selectQuery_ex = mysqli_query($con, $selectQuery);
									if ($selectQuery_ex && mysqli_num_rows($selectQuery_ex) > 0) {
										$dateRow = mysqli_fetch_assoc($selectQuery_ex);
										$uniName = $dateRow['italy_university_name'];
										$dateStatus = $dateRow['italy_date_status'];
										$openingDate = $dateRow['italy_opening_date'];
										$closingDate = $dateRow['italy_closing_date'];
									}
									if ($dateStatus=='1' && $currentDate >= $openingDate && $currentDate <= $closingDate) {
										$linkColor = '#32c861';
									} elseif ($dateStatus == '1' && $currentDate < $openingDate && $currentDate < $closingDate) {
										$linkColor = '#ffa91c';
									} elseif ($dateStatus == '2') {
										$linkColor = '#f96a74';
									}
									if ($linkColor != 'default') {
										$linkStyle = "style='color: {$linkColor} !important; background: !important; font-weight:500; '";
									}
									?>
									<li><a href="master-universities?university-name=<?php echo urlencode($masRow['italy_uni_name']);?>&client-degree=master" <?php echo $linkStyle; ?>> <b><?php echo $srM;?></b> <i class="mdi mdi-unicode"></i> <?php echo $masRow['italy_uni_name'];?> <b><mark><u><?= ($masRow['italy_uni_direct_apply'] == '1' ? "(DUA)" : "") . ($masRow['italy_uni_pre_enrollment'] == '1' ? "(DPE)" : "") .  ($masRow['italy_uni_dream_apply'] == '1' ? "(DA)" : ""); ?></u></mark></b></a></li>
									<?php
								$srM++;}
								?>
							</ul>
						</li>
						<li id="side-menu2">
							<a href="javascript: void(0);">
								<i class="mdi mdi-alpha-m-circle-outline"></i>
								<span>MBBS Universities </span>
								<span class="menu-arrow"></span>
							</a>
							<ul class="nav-second-level" aria-expanded="false">
								<?php
								$currentDate = date('Y-m-d');
								$uniMbbs = "SELECT * FROM italy_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_uni_degree='mbbs' ORDER BY italy_add_id ASC";
								$uniMbbs_ex = mysqli_query($con, $uniMbbs);
								$srMb=1;
								foreach ($uniMbbs_ex as $mbbsRow) {
									$uniName = '';
									$dateStatus = '';
									$openingDate = '';
									$closingDate = '';
									$linkStyle = '';
									$linkColor = 'default';

									$selectQuery = "SELECT * FROM italy_university_dates WHERE status='1' AND close='1' AND italy_university_name='".$mbbsRow['italy_uni_name']."' AND italy_degree_name='mbbs' ORDER BY italy_dates_id DESC LIMIT 1";
									$selectQuery_ex = mysqli_query($con, $selectQuery);
									if ($selectQuery_ex && mysqli_num_rows($selectQuery_ex) > 0) {
										$dateRow = mysqli_fetch_assoc($selectQuery_ex);
										$uniName = $dateRow['italy_university_name'];
										$dateStatus = $dateRow['italy_date_status'];
										$openingDate = $dateRow['italy_opening_date'];
										$closingDate = $dateRow['italy_closing_date'];
									}
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
									?>
									<li><a href="mbbs-universities?university-name=<?php echo urlencode($mbbsRow['italy_uni_name']);?>&client-degree=mbbs" <?php echo $linkStyle; ?>> <b><?php echo $srMb;?></b> <i class="mdi mdi-unicode"></i> <?php echo $mbbsRow['italy_uni_name'];?> <b><mark><u><?= ($mbbsRow['italy_uni_direct_apply'] == '1' ? "(DUA)" : "") . ($mbbsRow['italy_uni_pre_enrollment'] == '1' ? "(DPE)" : "") .  ($mbbsRow['italy_uni_dream_apply'] == '1' ? "(DA)" : ""); ?></u></mark></b></a></li>
									<?php
								$srMb++;}
								?>
							</ul>
						</li>
						<li id="side-menu2">
							<a href="javascript: void(0);">
								<i class="mdi mdi-alpha-p-circle-outline"></i>
								<span>PHD Universities </span>
								<span class="menu-arrow"></span>
							</a>
							<ul class="nav-second-level" aria-expanded="false">
								<?php
								$currentDate = date('Y-m-d');
								$uniMaster = "SELECT * FROM italy_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_uni_degree='phd' ORDER BY italy_add_id ASC";
								$uniMaster_ex = mysqli_query($con, $uniMaster);
								$srM=1;
								foreach ($uniMaster_ex as $masRow) {
									$uniName = '';
									$dateStatus = '';
									$openingDate = '';
									$closingDate = '';
									$linkStyle = '';
									$linkColor = 'default';

									$selectQuery = "SELECT * FROM italy_university_dates WHERE status='1' AND close='1' AND italy_university_name='".$masRow['italy_uni_name']."' AND italy_degree_name='phd' ORDER BY italy_dates_id DESC LIMIT 1";
									$selectQuery_ex = mysqli_query($con, $selectQuery);
									if ($selectQuery_ex && mysqli_num_rows($selectQuery_ex) > 0) {
										$dateRow = mysqli_fetch_assoc($selectQuery_ex);
										$uniName = $dateRow['italy_university_name'];
										$dateStatus = $dateRow['italy_date_status'];
										$openingDate = $dateRow['italy_opening_date'];
										$closingDate = $dateRow['italy_closing_date'];
									}
									if ($dateStatus=='1' && $currentDate >= $openingDate && $currentDate <= $closingDate) {
										$linkColor = '#32c861';
									} elseif ($dateStatus == '1' && $currentDate < $openingDate && $currentDate < $closingDate) {
										$linkColor = '#ffa91c';
									} elseif ($dateStatus == '2') {
										$linkColor = '#f96a74';
									}
									if ($linkColor != 'default') {
										$linkStyle = "style='color: {$linkColor} !important; background: !important; font-weight:500; '";
									}
									?>
									<li><a href="phd-universities?university-name=<?php echo urlencode($masRow['italy_uni_name']);?>&client-degree=phd" <?php echo $linkStyle; ?>> <b><?php echo $srM;?></b> <i class="mdi mdi-unicode"></i> <?php echo $masRow['italy_uni_name'];?> <b><mark><u><?= ($masRow['italy_uni_direct_apply'] == '1' ? "(DUA)" : "") . ($masRow['italy_uni_pre_enrollment'] == '1' ? "(DPE)" : "") .  ($masRow['italy_uni_dream_apply'] == '1' ? "(DA)" : ""); ?></u></mark></b></a></li>
									<?php
								$srM++;}
								?>
							</ul>
						</li>
						<li>
							<a href="universities-requirements ">
								<i class="mdi mdi-office-building"></i>
								<span>University Requirement </span>
							</a>
						</li>
						<li id="side-menu2">
							<a href="javascript: void(0);">
								<i class="mdi mdi-alpha-a-circle-outline"></i>
								<span>Apply Filter </span>
								<span class="menu-arrow"></span>
							</a>
							<ul class="nav-second-level" aria-expanded="false">
								<li> <a href="direct-pre-enrollment"><i class="mdi mdi-alpha-p-circle-outline"></i> Direct Pre Enrollment</a></li>
								<li> <a href="direct-universities-apply"><i class="mdi mdi-alpha-d-circle-outline"></i> Direct Universities Apply</a></li>

								<li> <a href="dream-id-apply"><i class="mdi mdi-alpha-i-circle-outline"></i> Dream ID Apply</a></li>
								<li> <a href="cimea-apply-clients"><i class="mdi mdi-alpha-c-circle-outline"></i> Cimea Apply Clients</a></li>
								<li> <a href="before-CEnT-S-test"><i class="mdi mdi-alpha-t-circle-outline"></i> Before CEnT-S Test</a></li>
								<li> <a href="after-CEnT-S-test"><i class="mdi mdi-alpha-t-circle-outline"></i> After CEnT-S Test</a></li>
							</ul>
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
										<li class="breadcrumb-item"><a href="dashboard"><?php echo ucwords($_SESSION['com_name']); ?></a></li>
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