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
	<!-- <link href="../assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" /> -->
	<!-- <link href="../assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" /> -->
	<!-- App css -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
	<link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/app.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />
	<!-- Select 2 -->
	<link href="../assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
	<!-- custom style css -->
	<link rel="stylesheet" type="text/css" href="../assets/custom_style.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body class="left-side-menu-light">
	<!-- Begin page -->
	<div id="wrapper">
		<!-- Topbar Start -->
		<div class="navbar-custom">
			<ul class="list-unstyled topnav-menu float-right mb-0">
				<li class="dropdown notification-list">
					<a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
						<i class="mdi mdi-bell-ring noti-icon"></i>
						<span class="badge badge-pink rounded-circle noti-icon-badge" data-plugin="counterup">0</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-lg">
						<div class="dropdown-header noti-title">
							<h5 class="text-overflow m-0"><span class="float-right">
								<span class="badge badge-danger float-right" data-plugin="counterup">0</span>
							</span>Payments Notification</h5>
						</div>
						<div class="slimscroll noti-scroll">
							<!-- item-->
							<a href="payments" class="dropdown-item notify-item">
								<div class="notify-icon bg-primary">
									<i class="mdi mdi-currency-brl"></i>
								</div>
								<p class="notify-details">
									<h6 class="mb-0">ID-demo <b>demo</b> </h6>
									<small class="text-muted">Payment Received = <b>1947</b></small>
								</p>
							</a>
						</div>
						<!-- All-->
						<a href="payments" class="dropdown-item text-center text-primary notify-item notify-all"> View all <i class="mdi mdi-ray-start-arrow"></i> </a>
					</div>
				</li>

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
						<li class="menu-title">Employee</li>
						<li>
							<a href="employee">
								<i class="mdi mdi-account-multiple-plus-outline"></i>
								<span>Employee </span>
							</a>
						</li>
						<li class="menu-title">Clients</li>
						<li>
							<a href="clients">
								<i class="mdi mdi-account-circle-outline"></i>
								<span>Clients </span>
							</a>
						</li>
						<li class="menu-title">Payments Confirmation</li>
						<li id="side-menu2">
							<a href="javascript: void(0);">
								<i class="mdi mdi-currency-usd"></i>
								<span>Payments </span>
								<span class="menu-arrow"></span>
							</a>
							<ul class="nav-second-level" aria-expanded="false">
								<li> <a href="payments-confirm"><i class="mdi mdi-check-all"></i> Payment Confirm </a></li>
								<li> <a href="payments-not-confirm"><i class="mdi mdi-close-outline"></i> Payments Not Confirm</a></li>
							</ul>
						</li>

						<li class="menu-title">Acknowlegement</li>
						<li id="side-menu2">
							<a href="javascript: void(0);">
								<i class="mdi mdi-file-document-edit-outline"></i>
								<span>Acknowlegement </span>
								<span class="menu-arrow"></span>
							</a>
							<ul class="nav-second-level" aria-expanded="false">
								<li> <a href="acknowlegement-confirm"><i class="mdi mdi-check-all"></i> Acknowlegement Confirm </a></li>
								<li> <a href="acknowlegement-not-confirm"><i class="mdi mdi-close-outline"></i> Acknowlegement Not Confirm</a></li>
							</ul>
						</li>
						<li class="menu-title">Programs</li>
						<li id="side-menu2">
							<a href="javascript: void(0);">
								<i class="mdi mdi-alpha-p-box"></i>
								<span>Programs </span>
								<span class="menu-arrow"></span>
							</a>
							<ul class="nav-second-level" aria-expanded="false">
								<li> <a href="programs-confirm"><i class="mdi mdi-check-all"></i> Program Confirm </a></li>
								<li> <a href="programs-not-confirm"><i class="mdi mdi-close-outline"></i> Program Not Confirm</a></li>
							</ul>
						</li>
						
						<li class="menu-title">Documents</li>
						<li id="side-menu2">
							<a href="javascript: void(0);">
								<i class="mdi mdi-file-eye-outline"></i>
								<span>Documents </span>
								<span class="menu-arrow"></span>
							</a>
							<ul class="nav-second-level" aria-expanded="false">
								<li> <a href="documents-complete"><i class="mdi mdi-check-all"></i> Documents Completed</a></li>
								<li> <a href="documents-not-complete"><i class="mdi mdi-close-outline"></i> Documents Not Completed</a></li>
							</ul>
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
						<li class="menu-title">Clients Change Country</li>
						<li>
							<a href="clients-change-country">
								<i class="mdi mdi-stack-exchange"></i>
								<span>Clients Change Country </span>
							</a>
						</li>
						<!-- <li class="menu-title">Payments</li>
						<li>
							<a href="payments">
								<i class="mdi mdi-currency-brl"></i>
								<span>Payments </span>
							</a>
						</li> -->
						<li class="menu-title">Intake Year</li>
						<li>
							<a href="intake-year">
								<i class="mdi mdi-calendar-repeat-outline"></i>
								<span>Intake Year </span>
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
								<li><a onclick="backup(backup_data);" style="cursor: pointer;"><i class="mdi mdi-database-export"></i> Database Export</a></li>
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