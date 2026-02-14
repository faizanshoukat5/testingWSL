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
	.card-body {
		padding-top: 5px;
	}
</style>
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-lg-6">
				<h4>My Admission Task</h4>
				<div class="row">
					<?php 
					$adTasks = [
						[
							'title' => "My Pending Programs Report",
							'param' => 'applied-programs=My+Pending+Programs+Report',
							'countID' => 'countTotalProgramPending',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => "I Have Resolved the Pending Report",
							'param' => 'applied-programs=I+Have+Resolved+the+Pending+Report',
							'countID' => 'countTotalProgramResolved',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => "Admission Application Form Fill",
							'param' => 'check-application=Admission+Application+Form+Fill',
							'countID' => 'countTotalApplicationFilled',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => "Admission Application Submitted",
							'param' => 'check-application=Admission+Application+Submitted',
							'countID' => 'countTotalApplicationSubmitted',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => "Sent Admission Applied Proof to Client",
							'param' => 'check-application=Sent+Admission+Applied+Proof+to+Client',
							'countID' => 'countTotalClientsProof',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => "Inform to Client to Pay Application Fee",
							'param' => 'check-application=Inform+to+Client+to+Pay+Application+Fee',
							'countID' => 'countTotalInformPayfee',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => "Application Fee Paid By Client",
							'param' => 'check-application=Application+Fee+Paid+By+Client',
							'countID' => 'countTotalFeePaidByClient',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => "Waiting for Admission decision",
							'param' => 'check-application=Waiting+for+Admission+decision',
							'countID' => 'countTotalWaiting',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => "Acceptance Letter Received Clients",
							'param' => 'check-application=Acceptance+Letter+Received+Clients',
							'countID' => 'countTotalAcceptance',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => "University Admission Rejected Clients",
							'param' => 'check-application=University+Admission+Rejected+Clients',
							'countID' => 'countTotalRejection',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						]
					];
					foreach ($adTasks as $task) {
					?>
					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="<?= $task['style'];?>">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="<?= $task['title'] ?>">
									<a href="all-clients?<?= $task['param'];?>">
										<p class="m-0 font-weight-medium text-truncate <?= $task['textColor'];?>"><?= $task['title'] ?></p>
										<h3 class="font-weight-bold my-2 <?= $task['textColor'];?>">
											<span data-plugin="countLoading" id="<?= $task['countID'];?>">0</span>
										</h3>
									</a>
								</div>
								<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
									<i class="<?= $task['icons'];?> avatar-title font-30 <?= $task['textColor'];?>"></i>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
			
			<div class="col-lg-6" style="border-left: 2px solid black;">
				<h4>Other Task</h4>
				<div class="row">
					<?php 
					$adTasks = [
						[
							'title' => "After Verification Dues Not Clear Clients",
							'param' => 'check-application=After+Verification+Dues+Not+Clear+Clients',
							'countID' => 'countTotalDueNotClear',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-warning'
						],
						[
							'title' => "After Verification Dues Clear Clients",
							'param' => 'check-application=After+Verification+Dues+Clear+Clients',
							'countID' => 'countTotalDueClear',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-warning'
						],
						[
							'title' => "After Verification Dues Remaining Clients",
							'param' => 'check-application=After+Verification+Dues+Remaining+Clients',
							'countID' => 'countTotalDueRemaining',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-warning'
						],
						[
							'title' => "Additional Activities Required by University",
							'param' => 'check-application=Additional+Activities+Required+by+University',
							'countID' => 'countTotalAdditionalActivitiesAssign',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-warning'
						],
						[
							'title' => "Additional Activities Required Task Completed",
							'param' => 'check-application=Additional+Activities+Required+by+University+Task+Completed',
							'countID' => 'countTotalAdditionalActivitiesComplete',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-warning'
						],
						[
							'title' => "Deadline Hold",
							'param' => 'check-application=Deadline+Hold',
							'countID' => 'countDeadlineHold',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-warning'
						],
						[
							'title' => "Deadline Release",
							'param' => 'check-application=Deadline+Release',
							'countID' => 'countDeadlineRelease',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-warning'
						]
					];
					foreach ($adTasks as $task) {
					?>
					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="<?= $task['style'];?>">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="<?= $task['title'] ?>">
									<a href="all-clients?<?= $task['param'];?>">
										<p class="m-0 font-weight-medium text-truncate <?= $task['textColor'];?>"><?= $task['title'] ?></p>
										<h3 class="font-weight-bold my-2 <?= $task['textColor'];?>">
											<span data-plugin="countLoading" id="<?= $task['countID'];?>">0</span>
										</h3>
									</a>
								</div>
								<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
									<i class="<?= $task['icons'];?> avatar-title font-30 <?= $task['textColor'];?>"></i>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<h4>Sop's & Other Task</h4>
		<div class="row">
			<?php 
			$clientTasks = [
				[
					'title' => "Sop's Assign Clients",
					'param' => 'sop-status=Sops+Assign+Clients',
					'countID' => 'countTotalSOPAssign',
					'style' => 'background: linear-gradient(to top, #232526, #414345);',
					'icons' => 'mdi mdi-account-multiple-outline',
					'textColor' => 'text-warning'
				],
				[
					'title' => "SOP's Not Assign Clients",
					'param' => 'sop-status=SOPs+Not+Assign+Clients',
					'countID' => 'countTotalSOPNotAssign',
					'style' => 'background: linear-gradient(to top, #232526, #414345);',
					'icons' => 'mdi mdi-account-multiple-outline',
					'textColor' => 'text-warning'
				],
				[
					'title' => "SOP's Received Clients",
					'param' => 'sop-status=SOPs+Received+Clients',
					'countID' => 'countTotalSOPReceived',
					'style' => 'background: linear-gradient(to top, #232526, #414345);',
					'icons' => 'mdi mdi-account-multiple-outline',
					'textColor' => 'text-warning'
				],
				[
					'title' => "Self Received Acceptance",
					'param' => 'check-application=Self+Received+Acceptance',
					'countID' => 'countTotalSelfReceived',
					'style' => 'background: linear-gradient(to top, #232526, #414345);',
					'icons' => 'mdi mdi-account-multiple-outline',
					'textColor' => 'text-warning'
				],
				[
					'title' => "Advance Remaining Payment Not Clear Clients",
					'param' => 'check-application=Advance+Remaining+Payment+Not+Clear+Clients',
					'countID' => 'countTotaladvPayNotClear',
					'style' => 'background: linear-gradient(to top, #232526, #414345);',
					'icons' => 'mdi mdi-account-multiple-outline',
					'textColor' => 'text-warning'
				],
				[
					'title' => "All Assign Programs",
					'param' => 'assign-programs=All+Assign+Programs',
					'countID' => 'countTotalAssign',
					'style' => 'background: linear-gradient(to top, #232526, #414345);',
					'icons' => 'mdi mdi-account-multiple-outline',
					'textColor' => 'text-warning'
				],
				[
					'title' => "All Not Assign Programs",
					'param' => 'assign-programs=All+Not+Assign+Programs',
					'countID' => 'countTotalNotAssign',
					'style' => 'background: linear-gradient(to top, #232526, #414345);',
					'icons' => 'mdi mdi-account-multiple-outline',
					'textColor' => 'text-warning'
				],
				[
					'title' => "All Applied Programs",
					'param' => 'applied-programs=All+Applied+Programs',
					'countID' => 'countTotalApplied',
					'style' => 'background: linear-gradient(to top, #232526, #414345);',
					'icons' => 'mdi mdi-account-multiple-outline',
					'textColor' => 'text-warning'
				]
			];
			foreach ($clientTasks as $task) {
			?>
			<div class="col-xl-4 col-sm-6">
				<div class="card-box widget-two-custom" style="<?= $task['style'];?>">
					<div class="media">
						<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="<?= $task['title'] ?>">
							<a href="all-clients?<?= $task['param'];?>">
								<p class="m-0 font-weight-medium text-truncate <?= $task['textColor'];?>"><?= $task['title'] ?></p>
								<h3 class="font-weight-bold my-2 <?= $task['textColor'];?>">
									<span data-plugin="countLoading" id="<?= $task['countID'];?>">0</span>
								</h3>
							</a>
						</div>
						<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
							<i class="<?= $task['icons'];?> avatar-title font-30 <?= $task['textColor'];?>"></i>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			
		</div>

	</div>
</div>

<div class="row">
	<div class="col-xl-4 col-sm-6">
		<div class="card-box widget-two-custom" style="background: linear-gradient(0deg, #ff512f, #f09819);">
			<div class="media">
				<div class="wigdet-two-content media-body text-truncate">
					<a href="">
						<p class="m-0 text-uppercase font-weight-medium text-truncate text-white">OverAll Austria Clients</p>
						<h3 class="font-weight-bold my-2 text-white"><span data-plugin="countLoading" id="countOverallczech">0</span></h3>
						<p class="m-0 text-white">Total <span class="font-18"><b>Austria</b></span> <img src="../images/austria-flag.png" width="35px" height="18px"></p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-4 col-sm-6">
		<div class="card-box widget-two-custom" style="background: radial-gradient(circle at -1% 57.5%, rgb(19, 170, 82) 0%, rgb(0, 102, 43) 90%);">
			<div class="media">
				<div class="wigdet-two-content media-body text-truncate">
					<a href="">
						<p class="m-0 text-uppercase font-weight-medium text-truncate text-white" data-toggle="tooltip" data-placement="top" title="Austria Pakistan Programs & Document Not Complete Clients">Austria Pakistan Programs & Document Not Complete Clients</p>
						<h3 class="font-weight-bold my-2 text-white"><span data-plugin="countLoading" id="countTotalNotProgramDocPakczech">0</span></h3>
						<p class="m-0 text-white">Total <span class="font-18"><b>Pakistan</b></span> <img src="../images/pakistan-flag.png" width="35px" height="18px"></p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-4 col-sm-6">
		<div class="card-box widget-two-custom" style="background-image: linear-gradient(0deg, rgb(94, 5, 4),rgb(253, 19, 61));">
			<div class="media">
				<div class="wigdet-two-content media-body text-truncate">
					<a href="">
						<p class="m-0 text-uppercase font-weight-medium text-truncate text-white" data-toggle="tooltip" data-placement="top" title="Austria UAE Programs & Document Not Complete Clients">Austria UAE Programs & Document Not Complete Clients</p>
						<h3 class="font-weight-bold my-2 text-white"> <span data-plugin="countLoading" id="countTotalNotProgramDocUAEczech">0</span></h3>
						<p class="m-0 text-white">Total <span class="font-18"><b>UAE</b></span> <img src="../images/uae-flag.png" width="35px" height="18px"></p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-account-multiple avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-4 col-sm-6">
		<div class="card-box widget-two-custom" style="background: linear-gradient(0deg, #ff512f, #f09819);">
			<div class="media">
				<div class="wigdet-two-content media-body text-truncate">
					<a href="all-clients">
						<p class="m-0 text-uppercase font-weight-medium text-truncate text-white">All Austria Clients</p>
						<h3 class="font-weight-bold my-2 text-white"><span data-plugin="countLoading" id="countTotalczech">0</span></h3>
						<p class="m-0 text-white">Total <span class="font-18"><b>Austria</b></span> <img src="../images/austria-flag.png" width="35px" height="18px"></p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-4 col-sm-6">
		<div class="card-box widget-two-custom" style="background: radial-gradient(circle at -1% 57.5%, rgb(19, 170, 82) 0%, rgb(0, 102, 43) 90%);">
			<div class="media">
				<div class="wigdet-two-content media-body text-truncate">
					<a href="all-clients?client-country=Pakistan">
						<p class="m-0 text-uppercase font-weight-medium text-truncate text-white">Austria Pakistan Clients</p>
						<h3 class="font-weight-bold my-2 text-white"><span data-plugin="countLoading" id="countTotalPakczech">0</span></h3>
						<p class="m-0 text-white">Total <span class="font-18"><b>Pakistan</b></span> <img src="../images/pakistan-flag.png" width="35px" height="18px"></p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-4 col-sm-6">
		<div class="card-box widget-two-custom" style="background-image: linear-gradient(0deg, rgb(94, 5, 4),rgb(253, 19, 61));">
			<div class="media">
				<div class="wigdet-two-content media-body text-truncate">
					<a href="all-clients?client-country=UAE">
						<p class="m-0 text-uppercase font-weight-medium text-truncate text-white" title="Statistics">Austria UAE Clients</p>
						<h3 class="font-weight-bold my-2 text-white"> <span data-plugin="countLoading" id="countTotalUAEczech">0</span></h3>
						<p class="m-0 text-white">Total <span class="font-18"><b>UAE</b></span> <img src="../images/uae-flag.png" width="35px" height="18px"></p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-account-multiple avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<!-- 3 div -->
	<div class="col-xl-6 col-sm-6">
		<div class="card-box widget-two-custom" style="background: linear-gradient(0deg,#6253E1,#04BEFE);">
			<div class="media">

				<div class="wigdet-two-content media-body text-truncate">
					<a href="all-clients?client-degree=bachelor">
						<p class="m-0 font-weight-medium text-truncate text-white text-white">Bachelor Clients</p>
						<h3 class="font-weight-medium my-2 text-white"> <span data-plugin="countLoading" id="countTotalBachelor">0</span></h3>
						<p class="m-0 text-white">Total</p>	
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-alpha-b-circle avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-6 col-sm-6">
		<div class="card-box widget-two-custom" style="background: linear-gradient(0deg,#6253E1,#04BEFE);">
			<div class="media">

				<div class="wigdet-two-content media-body text-truncate">
					<a href="all-clients?client-degree=master">
						<p class="m-0 font-weight-medium text-truncate text-white">Master Clients</p>
						<h3 class="font-weight-medium my-2 text-white"><span data-plugin="countLoading" id="countTotalMaster">0</span></h3>
						<p class="m-0 text-white">Total</p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-alpha-m-circle avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="../assets/js/jquery-v3.6.0.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("[data-plugin='countLoading']").each(function() {
			$(this).html('<i class="mdi mdi-loading mdi-spin"></i>');
		});
		$.ajax({
			url: 'models/_admissionDashboardControllersState.php',
			type: 'GET',
			dataType: 'json',
			success: function(data) {
				$.each(data, function(key, value){
					if ($("#" + key).length) {
						let formattedValue = Number(value).toLocaleString();
						$("#" + key).text(formattedValue);
					}
				});
				// console.log(data);
				// $('#countTotalProgramResolved').text(data.countTotalProgramResolved);
			},
			error: function(xhr, status, error) {
				console.error('AJAX Error:', error);
			}
		});
	});
</script>

<?php 
}else{
	header('Location:../login');
}
?>