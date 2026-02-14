<?php 
if(mysqli_num_rows($execuit)>0){
?>
<style type="text/css">
	.rounded-3{
		border-radius: 0 0.8rem;
	}
	.avatar-md{
		height: 3rem;
		width: 3rem;
	}
	.card-box {
		padding: 0.7rem 1.5rem;
		margin-bottom: 15px; 
	}
</style>
<div class="card">
	<div class="card-body">
		<!-- <h4>My Task</h4> -->
		<div class="row">
			<div class="col-md-12">
				<div class="float-right mb-1">
					<a href="https://payroll.wslcms.com/" class="btn btn-primary" target="_blank">Login to <b>PayRoll</b> Portal</a>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row">
					
					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="background: radial-gradient(circle at -1% 57.5%, rgb(19, 170, 82) 0%, rgb(0, 102, 43) 90%);">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate">
									<a href="clients?country-name=italy&client-country=Pakistan">
										<p class="m-0 text-uppercase font-weight-medium text-truncate text-white" title="Statistics">Study in Italy</p>
										<h3 class="font-weight-bold my-2 text-white"> <span data-plugin="counterup"><?php echo number_format($countPakItaly);?></span></h3>
										<p class="m-0 text-white">Total <span class="font-18"><b>Pakistan</b></span> <i class="flag-icon flag-icon-pk font-22"></i> </p>
									</a>
								</div>
								<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-multiple avatar-title font-30 text-white"></i>
								</div>
							</div>
						</div>
					</div>
					<!-- end col -->
					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="background: radial-gradient(circle at -1% 57.5%, rgb(19, 170, 82) 0%, rgb(0, 102, 43) 90%);">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate">
									<a href="clients?country-name=czech+republic&client-country=Pakistan">
										<p class="m-0 text-uppercase font-weight-medium text-truncate text-white" title="Statistics">Study in Czech Republic</p>
										<h3 class="font-weight-bold my-2 text-white"><span data-plugin="counterup"><?php echo number_format($countPakCzechRepublic);?></span></h3>
										<p class="m-0 text-white">Total <span class="font-18"><b>Pakistan</b></span> <i class="flag-icon flag-icon-pk font-22"></i></p>
									</a>
								</div>
								<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-star-outline avatar-title font-30 text-white"></i>
								</div>
							</div>
						</div>
					</div>
					<!-- end col -->
					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="background: radial-gradient(circle at -1% 57.5%, rgb(19, 170, 82) 0%, rgb(0, 102, 43) 90%);">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate">
									<a href="clients?country-name=austria&client-country=Pakistan">
										<p class="m-0 text-uppercase font-weight-medium text-truncate text-white" title="Statistics">Study in Austria</p>
										<h3 class="font-weight-bold my-2 text-white"><span data-plugin="counterup"><?php echo number_format($countPakAustria); ?></span></h3>
										<p class="m-0 text-white">Total <span class="font-18"><b>Pakistan</b></span> <i class="flag-icon flag-icon-pk font-22"></i></p>
									</a>
								</div>
								<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-white"></i>
								</div>
							</div>
						</div>
					</div>
					<!-- end col -->
					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="background: radial-gradient(circle at -1% 57.5%, rgb(19, 170, 82) 0%, rgb(0, 102, 43) 90%);">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate">
									<a href="clients?country-name=france&client-country=Pakistan">
										<p class="m-0 text-uppercase font-weight-medium text-truncate text-white" title="Statistics">Study in France</p>
										<h3 class="font-weight-bold my-2 text-white"><span data-plugin="counterup"><?php echo number_format($countPakFrance); ?></span></h3>
										<p class="m-0 text-white">Total <span class="font-18"><b>Pakistan</b></span> <i class="flag-icon flag-icon-pk font-22"></i></p>
									</a>
								</div>
								<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-white"></i>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="background: radial-gradient(circle at -1% 57.5%, rgb(19, 170, 82) 0%, rgb(0, 102, 43) 90%);">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate">
									<a href="clients?country-name=canada&client-country=Pakistan">
										<p class="m-0 text-uppercase font-weight-medium text-truncate text-white" title="Statistics">Study in Canada / Canada Visit Visa</p>
										<h3 class="font-weight-bold my-2 text-white"><span data-plugin="counterup"><?php echo number_format($countPakCanada);?></span></h3>
										<p class="m-0 text-white">Total <span class="font-18"><b>Pakistan</b></span> <i class="flag-icon flag-icon-pk font-22"></i></p>
									</a>
								</div>
								<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-star-outline avatar-title font-30 text-white"></i>
								</div>
							</div>
						</div>
					</div>
					<!-- end col -->

					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="background: radial-gradient(circle at -1% 57.5%, rgb(19, 170, 82) 0%, rgb(0, 102, 43) 90%);">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate">
									<a href="clients?country-name=USA&client-country=Pakistan">
										<p class="m-0 text-uppercase font-weight-medium text-truncate text-white" title="Statistics">Study in USA / USA Visit Visa</p>
										<h3 class="font-weight-bold my-2 text-white"><span data-plugin="counterup"><?php echo number_format($countPakUSA);?></h3>
										<p class="m-0 text-white">Total <span class="font-18"><b>Pakistan</b></span> <i class="flag-icon flag-icon-pk font-22"></i></p>
									</a>
								</div>
								<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-outline avatar-title font-30 text-white"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="background: radial-gradient(circle at -1% 57.5%, rgb(19, 170, 82) 0%, rgb(0, 102, 43) 90%);">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate">
									<a href="clients?country-name=IELTS+enrollment&client-country=Pakistan">
										<p class="m-0 text-uppercase font-weight-medium text-truncate text-white" title="Statistics">Study in IELTS Enrollment</p>
										<h3 class="font-weight-bold my-2 text-white"><span data-plugin="counterup"><?php echo number_format($countPakIELTS);?></h3>
										<p class="m-0 text-white">Total <span class="font-18"><b>Pakistan</b></span> <i class="flag-icon flag-icon-pk font-22"></i></p>
									</a>
								</div>
								<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-outline avatar-title font-30 text-white"></i>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<!-- left col-md-6 -->
			<div class="col-md-6" style="border-left: 2px solid black;">
				<div class="row">

					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="background-image: linear-gradient(0deg, rgb(94, 5, 4),rgb(253, 19, 61));">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate">
									<a href="clients?country-name=italy&client-country=UAE">
										<p class="m-0 text-uppercase font-weight-medium text-truncate text-white" title="Statistics">Study in Italy</p>
										<h3 class="font-weight-bold my-2 text-white"> <span data-plugin="counterup"><?php echo number_format($countUAEItaly);?></span></h3>
										<p class="m-0 text-white">Total <span class="font-18"><b>UAE</b></span> <i class="flag-icon flag-icon-ae font-22"></i></p>
									</a>
								</div>
								<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-multiple avatar-title font-30 text-white"></i>
								</div>
							</div>
						</div>
					</div>
					<!-- end col -->
					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="background-image: linear-gradient(0deg, rgb(94, 5, 4),rgb(253, 19, 61));">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate">
									<a href="clients?country-name=USA&client-country=UAE">
										<p class="m-0 text-uppercase font-weight-medium text-truncate text-white" title="Statistics">Study in Czech Republic</p>
										<h3 class="font-weight-bold my-2 text-white"><span data-plugin="counterup"><?php echo number_format($countUAECzechRepublic);?></h3>
										<p class="m-0 text-white">Total <span class="font-18"><b>UAE</b></span> <i class="flag-icon flag-icon-ae font-22"></i></p>
									</a>
								</div>
								<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-outline avatar-title font-30 text-white"></i>
								</div>
							</div>
						</div>
					</div>
					<!-- end col -->
					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="background-image: linear-gradient(0deg, rgb(94, 5, 4),rgb(253, 19, 61));">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate">
									<a href="clients?country-name=austria&client-country=UAE">
										<p class="m-0 text-uppercase font-weight-medium text-truncate text-white" title="Statistics">Study in Austria</p>
										<h3 class="font-weight-bold my-2 text-white"><span data-plugin="counterup"><?php echo number_format($countUAEAustria); ?></span></h3>
										<p class="m-0 text-white">Total <span class="font-18"><b>UAE</b></span> <i class="flag-icon flag-icon-ae font-22"></i></p>
									</a>
								</div>
								<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-white"></i>
								</div>
							</div>
						</div>
					</div>
					<!-- end col -->
					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="background-image: linear-gradient(0deg, rgb(94, 5, 4),rgb(253, 19, 61));">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate">
									<a href="clients?country-name=france&client-country=UAE">
										<p class="m-0 text-uppercase font-weight-medium text-truncate text-white" title="Statistics">Study in France</p>
										<h3 class="font-weight-bold my-2 text-white"><span data-plugin="counterup"><?php echo number_format($countUAEFrance); ?></span></h3>
										<p class="m-0 text-white">Total <span class="font-18"><b>UAE</b></span> <i class="flag-icon flag-icon-ae font-22"></i></p>
									</a>
								</div>
								<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-white"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="background-image: linear-gradient(0deg, rgb(94, 5, 4),rgb(253, 19, 61));">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate">
									<a href="clients?country-name=canada&client-country=UAE">
										<p class="m-0 text-uppercase font-weight-medium text-truncate text-white" title="Statistics">Study in Canada / Canada Visit Visa</p>
										<h3 class="font-weight-bold my-2 text-white"><span data-plugin="counterup"><?php echo number_format($countUAECanada);?></span></h3>
										<p class="m-0 text-white">Total <span class="font-18"><b>UAE</b></span> <i class="flag-icon flag-icon-ae font-22"></i></p>
									</a>
								</div>
								<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-star-outline avatar-title font-30 text-white"></i>
								</div>
							</div>
						</div>
					</div>
					<!-- end col -->
					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="background-image: linear-gradient(0deg, rgb(94, 5, 4),rgb(253, 19, 61));">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate">
									<a href="clients?country-name=USA&client-country=UAE">
										<p class="m-0 text-uppercase font-weight-medium text-truncate text-white" title="Statistics">Study in USA / USA Visit Visa</p>
										<h3 class="font-weight-bold my-2 text-white"><span data-plugin="counterup"><?php echo number_format($countUAEUSA);?></h3>
										<p class="m-0 text-white">Total <span class="font-18"><b>UAE</b></span> <i class="flag-icon flag-icon-ae font-22"></i></p>
									</a>
								</div>
								<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-outline avatar-title font-30 text-white"></i>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="background-image: linear-gradient(0deg, rgb(94, 5, 4),rgb(253, 19, 61));">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate">
									<a href="clients?country-name=IELTS+enrollment&client-country=UAE">
										<p class="m-0 text-uppercase font-weight-medium text-truncate text-white" title="Statistics">Study in IELTS Enrollment</p>
										<h3 class="font-weight-bold my-2 text-white"><span data-plugin="counterup"><?php echo number_format($countUSIELTS);?></h3>
										<p class="m-0 text-white">Total <span class="font-18"><b>UAE</b></span> <i class="flag-icon flag-icon-ae font-22"></i></p>
									</a>
								</div>
								<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-outline avatar-title font-30 text-white"></i>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6 col-lg-3">
		<div class="card radius-10 bg-primary" style="background-image: linear-gradient(0deg, rgb(62, 25, 113),rgb(72, 105, 206));">
			<div class="card-body text-center">
				<div class="widget-icon mx-auto mb-1 bg-white-1 text-white">
					<i class="mdi mdi-currency-usd"></i>
				</div>
				<a href="payments-confirm">
					<h3 class="text-white" data-plugin="counterup"><?php echo number_format($countpayConfirm);?></h3>
					<p class="mb-0 text-white font-weight-medium text-truncate">Payment's Confirm</p>
				</a>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-3">
		<div class="card radius-10 bg-danger" style="background-image: linear-gradient(0deg, rgb(249, 66, 6),rgb(250, 134, 22),rgb(251, 202, 37));">
			<div class="card-body text-center">
				<div class="widget-icon mx-auto mb-1 bg-white-1 text-white">
					<i class="mdi mdi-currency-usd"></i>
				</div>
				<a href="payments-not-confirm">
					<h3 class="text-white" data-plugin="counterup"><?php echo number_format($countpayNotConfirm);?></h3>
					<p class="mb-0 text-white font-weight-medium text-truncate">Payment's  Not Confirm</p>
				</a>	
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-3">
		<div class="card radius-10 bg-success" style="background-image: linear-gradient(0deg, rgb(62, 25, 113),rgb(72, 105, 206));">
			<div class="card-body text-center">
				<div class="widget-icon mx-auto mb-1 bg-white-1 text-white">
					<i class="mdi mdi-alpha-p-box"></i>
				</div>
				<a href="acknowlegement-confirm">
					<h3 class="text-white" data-plugin="counterup"><?php echo number_format($countAckConfirm);?></h3>
					<p class="mb-0 text-white font-weight-medium text-truncate">Acknowlegdment Confirm</p>
				</a>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-3">
		<div class="card radius-10 bg-dark" style="background-image: linear-gradient(0deg, rgb(249, 66, 6),rgb(250, 134, 22),rgb(251, 202, 37));">
			<div class="card-body text-center">
				<div class="widget-icon mx-auto mb-1 bg-white-1 text-white">
					<i class="mdi mdi-alpha-p-box"></i>
				</div>
				<a href="acknowlegement-not-confirm">
					<h3 class="text-white" data-plugin="counterup"><?php echo number_format($countAckNotConfirm);?></h3>
					<p class="mb-0 text-white font-weight-medium text-truncate">Acknowlegdment Not Confirm</p>
				</a>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-3">
		<div class="card radius-10 bg-primary" style="background-image: linear-gradient(0deg, rgb(62, 25, 113),rgb(72, 105, 206));">
			<div class="card-body text-center">
				<div class="widget-icon mx-auto mb-1 bg-white-1 text-white">
					<i class="mdi mdi-file-eye-outline"></i>
				</div>
				<a href="documents-complete">
					<h3 class="text-white" data-plugin="counterup"><?php echo number_format($countDocumentConfirm);?></h3>
					<p class="mb-0 text-white font-weight-medium text-truncate">Document's Completed</p>
				</a>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-3">
		<div class="card radius-10 bg-info" style="background-image: linear-gradient(0deg, rgb(249, 66, 6),rgb(250, 134, 22),rgb(251, 202, 37));">
			<div class="card-body text-center">
				<div class="widget-icon mx-auto mb-1 bg-white-1 text-white">
					<i class="mdi mdi-file-eye-outline"></i>
				</div>
				<a href="documents-not-complete">
					<h3 class="text-white" data-plugin="counterup"><?php echo number_format($countDocumentNotConfirm);?></h3>
					<p class="mb-0 text-white font-weight-medium text-truncate">Document's Not Completed</p>
				</a>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-3">
		<div class="card radius-10 bg-success" style="background-image: linear-gradient(0deg, rgb(62, 25, 113),rgb(72, 105, 206));">
			<div class="card-body text-center">
				<div class="widget-icon mx-auto mb-1 bg-white-1 text-white">
					<i class="mdi mdi-file-document-edit-outline"></i>
				</div>
				<a href="programs-confirm">
					<h3 class="text-white" data-plugin="counterup"><?php echo number_format($countprogramConfirm);?></h3>
					<p class="mb-0 text-white font-weight-medium text-truncate">Program's Confirm</p>
				</a>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-3">
		<div class="card radius-10 bg-dark" style="background-image: linear-gradient(0deg, rgb(249, 66, 6),rgb(250, 134, 22),rgb(251, 202, 37));">
			<div class="card-body text-center">
				<div class="widget-icon mx-auto mb-1 bg-white-1 text-white">
					<i class="mdi mdi-file-document-edit-outline"></i>
				</div>
				<a href="programs-not-confirm">
					<h3 class="text-white" data-plugin="counterup"><?php echo number_format($countprogramNotConfirm);?></h3>
					<p class="mb-0 text-white font-weight-medium text-truncate">Program's Not Confirm</p>
				</a>
			</div>
		</div>
	</div>
</div> <!-- end row -->

<div class="row">
	<div class="col-lg-5">
		<div class="row">
			<div class="col-md-6 col-lg-6">
				<div class="card radius-10 bg-primary" style="background-image: linear-gradient(135deg, rgb(112, 84, 203),rgb(232, 47, 180));">
					<div class="card-body text-center">
						<div class="widget-icon mx-auto mb-1 bg-white-1 text-white">
							<i class="mdi mdi-cash"></i>
						</div>
						<a href="clients?client-case=cash+case">
							<h3 class="text-white" data-plugin="counterup"><?php echo number_format($countCashCase);?></h3>
							<p class="mb-0 text-white font-weight-medium text-truncate">Cash Case</p>
						</a>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-6">
				<div class="card radius-10 bg-danger" style="background-image: linear-gradient(135deg, rgb(32, 186, 230),rgb(110, 6, 173));">
					<div class="card-body text-center">
						<div class="widget-icon mx-auto mb-1 bg-white-1 text-white">
							<i class="mdi mdi-cellphone"></i>
						</div>
						<a href="clients?client-case=online+case">
							<h3 class="text-white" data-plugin="counterup"><?php echo number_format($countOnlineCase);?></h3>
							<p class="mb-0 text-white font-weight-medium text-truncate">Online Case</p>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-7">
		<div class="row">
			<div class="col-md-6 col-lg-4">
				<div class="card radius-10 bg-primary" style="background-image: linear-gradient(135deg, rgb(217, 184, 42) 0%,rgb(131, 178, 27) 31%,rgb(45, 172, 11) 100%);">
					<div class="card-body text-center">
						<div class="widget-icon mx-auto mb-1 bg-white-1 text-white">
							<i class="mdi mdi-new-box"></i>
						</div>
						<a href="clients?client-convert-status=New+Client">
							<h3 class="text-white" data-plugin="counterup"><?php echo number_format($countNewClients);?></h3>
							<p class="mb-0 text-white font-weight-medium text-truncate">New Clients</p>
						</a>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-4">
				<div class="card radius-10 bg-danger" style="background: linear-gradient(-146deg,  #323232 0%,#4b4b4b 48%,#1c1c1c 100%);">
					<div class="card-body text-center">
						<div class="widget-icon mx-auto mb-1 bg-white-1 text-white">
							<i class="mdi mdi-ticket-account"></i>
						</div>
						<a href="clients?client-convert-status=Old+Client">
							<h3 class="text-white" data-plugin="counterup"><?php echo number_format($countOldClients);?></h3>
							<p class="mb-0 text-white font-weight-medium text-truncate">Old Clients</p>
						</a>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-4">
				<div class="card radius-10 bg-danger" style="background-image: linear-gradient(135deg, rgb(252, 108, 53),rgb(170, 18, 159));">
					<div class="card-body text-center">
						<div class="widget-icon mx-auto mb-1 bg-white-1 text-white">
							<i class="mdi mdi-folder-account"></i>
						</div>
						<a href="clients?client-convert-status=Old+Converted+Client">
							<h3 class="text-white" data-plugin="counterup"><?php echo number_format($countConvertedClients);?></h3>
							<p class="mb-0 text-white font-weight-medium text-truncate">Old Converted Clients</p>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- end row -->
<div class="row">
	<div class="col-md-6 col-lg-3">
		<div class="card radius-10 bg-primary" style="background-image: linear-gradient(135deg, rgb(112, 84, 203),rgb(232, 47, 180));">
			<div class="card-body text-center">
				<div class="widget-icon mx-auto mb-1 bg-white-1 text-white">
					<i class="mdi mdi-briefcase-remove"></i>
				</div>
				<a href="clients-case?client-case-status=1">
					<h3 class="text-white" data-plugin="counterup"><?php echo number_format($countwithDrawClients);?></h3>
					<p class="mb-0 text-white font-weight-medium text-truncate">Case WithDraw</p>
				</a>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-3">
		<div class="card radius-10 bg-danger" style="background-image: linear-gradient(135deg, rgb(32, 186, 230),rgb(110, 6, 173));">
			<div class="card-body text-center">
				<div class="widget-icon mx-auto mb-1 bg-white-1 text-white">
					<i class="mdi mdi-briefcase-minus"></i>
				</div>
				<a href="clients-case?client-case-status=2">
					<h3 class="text-white" data-plugin="counterup"><?php echo number_format($countRefundClients);?></h3>
					<p class="mb-0 text-white font-weight-medium text-truncate">Case Refund</p>
				</a>	
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-3">
		<div class="card radius-10 bg-success" style="background: linear-gradient(-146deg,  #323232 0%,#4b4b4b 48%,#1c1c1c 100%);">
			<div class="card-body text-center">
				<div class="widget-icon mx-auto mb-1 bg-white-1 text-white">
					<i class="mdi mdi-briefcase-edit"></i>
				</div>
				<a href="clients-case?client-case-status=3">
					<h3 class="text-white" data-plugin="counterup"><?php echo number_format($countOnHoldClients);?></h3>
					<p class="mb-0 text-white font-weight-medium text-truncate">Case On Hold</p>
				</a>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-3">
		<div class="card radius-10 bg-dark" style="background-image: linear-gradient(135deg, rgb(252, 108, 53),rgb(170, 18, 159));">
			<div class="card-body text-center">
				<div class="widget-icon mx-auto mb-1 bg-white-1 text-white">
					<i class="mdi mdi-stack-exchange"></i>
				</div>
				<a href="clients-change-country">
					<h3 class="text-white" data-plugin="counterup"><?php echo number_format($countChangeCountryClients);?></h3>
					<p class="mb-0 text-white font-weight-medium text-truncate">Clients Change Country</p>
				</a>
			</div>
		</div>
	</div>
</div>
	

<div class="row">
	<div class="col-12 col-lg-6">
		<div class="card radius-10">
			<div class="card-body">
				<div class="align-items-center">
					<h4 class="header-title">Clients Receiving</h4>
				</div>
				<canvas id="first_chart" height="160px"></canvas>
			</div>
		</div>
	</div>
	<div class="col-12 col-lg-6">
		<div class="card radius-10">
			<div class="card-body">
				<div class="align-items-center mb-1">
					<h4 class="header-title">Clients Country Wise</h4>
				</div>
				<canvas id="myChart" style="position: relative; width: 100%; max-width: 800px; margin: auto;"></canvas>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="align-items-center">
					<h4 class="header-title">Advance Payments Remaining Clients</h4>
				</div>
				<div id="calendar" height="120px"> </div>
			</div>
		</div>
	</div>

</div><!--end row-->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar');
		var calendar = new FullCalendar.Calendar(calendarEl, {
			headerToolbar: {
				left: 'prev,next today',
				center: 'title',
				right: 'dayGridMonth,timeGridWeek,timeGridDay'
			},
			initialDate: '<?php echo date('Y-m-d'); ?>',
			navLinks: true, 
			selectable: true,
			selectMirror: true,
			dayMaxEvents: true,
			events: [
				<?php
					$payClient = "SELECT * FROM clients_payments".$_SESSION['dbNo']." JOIN clients".$_SESSION['dbNo']." ON clients_payments".$_SESSION['dbNo'].".pay_client_id=clients".$_SESSION['dbNo'].".client_id WHERE clients_payments".$_SESSION['dbNo'].".close='1' AND clients_payments".$_SESSION['dbNo'].".status='1' AND clients".$_SESSION['dbNo'].".status='1' AND clients".$_SESSION['dbNo'].".close='1' AND clients".$_SESSION['dbNo'].".case_status='0' AND clients".$_SESSION['dbNo'].".change_status='0' AND clients".$_SESSION['dbNo'].".sale_commission='0' AND clients".$_SESSION['dbNo'].".client_pay_remaining_status='0' ORDER BY cl_pay_id DESC "; 
					$payClient_ex = mysqli_query($con, $payClient);
					$sr = mysqli_num_rows($payClient_ex);
					foreach ($payClient_ex as $payrow) {
						$clientID = $payrow['client_id'];
						$changingApplied = $payrow['client_applied'];
						$appliedChanging = json_decode($changingApplied, true);
						$pay_due_date = $payrow['pay_due_date'];
					?>
					{
						title: '<?php echo "ID-".$payrow['client_id']." ". ucwords($payrow['client_name']." / ".$payrow['client_country']); ?>',
						start: '<?php echo $payrow['pay_due_date']; ?>'
					},
				<?php } ?>
			]
		});

		calendar.render();
	});
</script>

<script type="text/javascript">
	var ctx = document.getElementById("myChart");
	var myChart = new Chart(ctx, {
		type: 'doughnut',
		data: {
			labels: ['Austria', 'Italy', 'Canada', 'USA', 'Czech Republic', 'France', 'IELTS Enrollment'],
			datasets: [{
				label: 'Country Wise',
				data: [<?php echo $countAustria;?>, <?php echo $countItaly;?>, <?php echo $countCanada;?>, <?php echo $countUSA;?>, <?php echo $countCzechRepublic;?>, <?php echo $countFrance;?>, <?php echo $countIELTSEnrollment;?>],
				backgroundColor: ["#5553ce","#297ef6","#e52b4c","#ffa91c","#32c861", "#00267F", "#000"],
				borderColor: ["#5553ce","#297ef6","#e52b4c","#ffa91c","#32c861", "#00267F", "#000"],
				borderWidth: 1
			}]
		},
		options: {
	   	responsive: false,

		}
	});
</script>
<script type="text/javascript">
	var ctxL = document.getElementById("first_chart").getContext('2d');
	var barColors = [
	"#1e7145",
	"#FFC107",
	"#b91d47",
	"#00aba9",
	"#000000"
	];
	var myLineChart = new Chart(ctxL, {
		type: 'line',
		data: {<?php
			$current_year = date("Y");
			$current_month = date("m");
			$days_in_month = cal_days_in_month(CAL_GREGORIAN,$current_month,$current_year);
			?>
		labels: [<?php
			$mon = [];
			$year = [];
			$output1 = [];
			$date1 = $current_year.'-01-01';
			$date2 = $current_year.'-12-31';
			$output = [];
			$time   = strtotime($date1);
			$last   = date('M-Y', strtotime($date2));
			do {
				$month = date('M-Y', $time);
				$total = date('t', $time);
				$output[] = "'".$month."'".",";
				$output1[] = "'".$month."'".",";
				$time = strtotime('+1 month', $time);
			} while ($month != $last);
			echo implode(" ", $output);
			?>],
		datasets: [{
			fill: false,
			lineTension: 0,
			borderColor: "#3461ff",
			label: "Total Received Amount",
			data: [<?php
				for ($i=1; $i <= 12; $i++) { 
					$select_query = "SELECT SUM(pay_receive_amount), SUM(pay_online_amount), month(pay_date) from clients_payments".$_SESSION['dbNo']." WHERE month(pay_date) = '".$i."' AND year(pay_date) = '".$current_year."' AND status = '1' AND close='1' GROUP BY month(pay_date),year(pay_date)";
					$select_query_ex = mysqli_query($con,$select_query);
					if (mysqli_num_rows($select_query_ex) != 0) {
						foreach($select_query_ex as $month){
							$totalAmount = $month['SUM(pay_receive_amount)'] + $month['SUM(pay_online_amount)'];
							echo $totalAmount.",";
						}
					}
					else{
						echo "0,";
					}
				}
				?>],
				backgroundColor: ['#3461ff',],
			}]
		},
		options: {
			responsive: true
		}
	});
</script>
<?php 
}else{
	header('Location:../login');
}
?>