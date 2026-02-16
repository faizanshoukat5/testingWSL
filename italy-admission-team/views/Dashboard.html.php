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
<!-- <?php
echo $ip_address = $_SERVER['REMOTE_ADDR'];
?> -->
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-xl-6">
				<h4>My Admission Task</h4>
				<?php 
				$admissionTask = [
					[
						'title' => 'My Pending Report Resolves by Admission Head',
						'link'  => 'all-clients?applied-programs=My+Pending+Report+Resolves+by+Admission+Head',
						'countID' => 'countTotalPendingResolves',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-info'
					],
					[
						'title' => 'Inform the Head to Recheck the Application By Client',
						'link'  => 'all-clients?check-application=Inform+the+Head+to+Recheck+the+Application+By+Client',
						'countID' => 'countTotalinformToClient',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-info'
					],
					[
						'title' => 'Applications Sent to the Head for Rechecking By Clients',
						'link'  => 'all-clients?check-application=Applications+Sent+to+the+Head+for+Rechecking+By+Clients',
						'countID' => 'countTotalinformedToClient',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-info'
					],
					[
						'title' => 'Client Requests to Head, Changes in the Application',
						'link'  => 'all-clients?check-application=Client+Requests+to+Head%2C+Changes+in+the+Application',
						'countID' => 'countTotalChangeRequired',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-info'
					],
					[
						'title' => 'Changes Complete, And Sent to Admission Head',
						'link'  => 'all-clients?check-application=Changes+Complete%2C+And+Sent+to+Admission+Head',
						'countID' => 'countTotalChangeUpdated',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-info'
					],
					[
						'title' => 'Client Informed, How to Pay the Application Fee By Admission Head',
						'link'  => 'all-clients?check-application=Client+Informed%2C+How+to+Pay+the+Application+Fee+By+Admission+Head',
						'countID' => 'countTotalInformPayfee',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-info'
					],
					[
						'title' => 'Application Approved And Fee Paid by Client, Now Submit the Application',
						'link'  => 'all-clients?check-application=Application+Approved+And+Fee+Paid+by+Client%2C+Now+Submit+the+Application',
						'countID' => 'countTotalFeePaid',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-info'
					],
					[
						'title' => 'Admission Application Submitted by Processing Team',
						'link'  => 'all-clients?check-application=Admission+Application+Submitted+by+Processing+Team',
						'countID' => 'countTotalApplicationSubmited',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-info'
					],
					[
						'title' => 'Sent Admission Applied Proof to Client By Admission Head',
						'link'  => 'all-clients?check-application=Sent+Admission+Applied+Proof+to+Client+By+Admission+Head',
						'countID' => 'countTotalClientsProof',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-info'
					],
					[
						'title' => 'Received Request to Fill Bergamo Enrollment Fee Form',
						'link'  => 'all-clients?check-application=Received+Request+to+Fill+Bergamo+Enrollment+Fee+Form',
						'countID' => 'countTotalInformTeamBergamoFee',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-info'
					],
					[
						'title' => 'Inform to Head to Pay Bergamo Enrollment Fee',
						'link'  => 'all-clients?check-application=Inform+to+Head+to+Pay+Bergamo+Enrollment+Fee',
						'countID' => 'countTotalBergamoFee',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-info'
					],
					[
						'title' => 'Additional Activities Required by University Clients Assign by Admission Head',
						'link'  => 'all-clients?check-application=Additional+Activities+Required+by+University+Clients+Assign+by+Admission+Head',
						'countID' => 'countTotalAdditionalActivitiesAssign',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-info'
					],
					[
						'title' => 'Additional Activities Required by University Task Complete by Processing Team',
						'link'  => 'all-clients?check-application=Additional+Activities+Required+by+University+Task+Complete+by+Processing+Team',
						'countID' => 'countTotalAdditionalActivitiesComplete',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-info'
					]
				];
				?>
				<div class="row">
					<?php foreach ($admissionTask as $adRow){ ?>
						<div class="col-xl-12 col-sm-6">
							<div class="card-box widget-two-custom" style="<?= $adRow['style'];?>">
								<div class="media">
									<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="<?= htmlspecialchars($adRow['title']) ?>">
										<a href="<?= $adRow['link'] ?>">
											<p class="m-0 font-weight-medium text-truncate <?= $adRow['textColor'];?>"> <?= htmlspecialchars($adRow['title']) ?> </p>
											<h3 class="font-weight-bold my-2 <?= $adRow['textColor'];?>">
												<span data-plugin="countLoading" id="<?= $adRow['countID'];?>">0</span>
											</h3>
										</a>
									</div>
									<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
										<i class="mdi mdi-account-multiple-outline avatar-title font-30 <?= $adRow['textColor'];?>"></i>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-xl-6" style="border-left: 2px solid black;">
				<h4>Pre Enrollment Task</h4>
				<div class="row">
				<?php 
				$widPreTas = [
					[
						'title' => 'New Assign But Not Applied Programs',
						'link'  => 'all-clients?applied-programs=New+Assign+But+Not+Applied+Programs',
						'countID' => 'countTotalNewAssignNotApplied',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-warning'
					],
					[
						'title' => 'CEnT-S Pass Not Applied Programs',
						'link'  => 'all-clients?applied-programs=CEnT-S+Pass+Not+Applied+Programs',
						'countID' => 'countTotalTOLCPassNotApplied',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-warning'
					],
					[
						'title' => 'New Pre Enrollment Application Received',
						'link'  => 'pre-enrollment-clients?pre-accept-process=New+Pre+Enrollment+Application+Received',
						'countID' => 'countTotalPreAssign',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-warning'
					],
					[
						'title' => 'My Pending Programs Report for Admission Head',
						'link'  => 'all-clients?applied-programs=My+Pending+Programs+Report',
						'countID' => 'countTotalProgramPending',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-warning'
					],
				];
				?>
				<?php foreach ($widPreTas as $adRow){ ?>
					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="<?= $adRow['style'];?>">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="<?= htmlspecialchars($adRow['title']) ?>">
									<a href="<?= $adRow['link'] ?>">
										<p class="m-0 font-weight-medium text-truncate <?= $adRow['textColor'];?>"> <?= htmlspecialchars($adRow['title']) ?> </p>
										<h3 class="font-weight-bold my-2 <?= $adRow['textColor'];?>">
											<span data-plugin="countLoading" id="<?= $adRow['countID'];?>">0</span>
										</h3>
									</a>
								</div>
								<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-multiple-outline avatar-title font-30 <?= $adRow['textColor'];?>"></i>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>

				<?php
				$preTask = [
					[
						'title' => 'Applications Rechecked by Clients and Submit by Team',
						'param' => 'all-clients?pre-process=Applications+Rechecked+by+Clients+and+Submit+by+Team',
						'countID' => 'countTotalPreinformedToClient',
						'style' => 'background: linear-gradient(to top, #125E8A, #204B57)',
						'textColor' => 'text-white'
					],
					[
						'title' => 'Admission Application Submitted by Processing Team',
						'param' => 'all-clients?pre-process=Admission+Application+Submitted+by+Processing+Team',
						'countID' => 'countTotalPreApplicationSubmited',
						'style' => 'background: linear-gradient(to top, #125E8A, #204B57)',
						'textColor' => 'text-white'
					],
					[
						'title' => 'Sent Admission Applied Proof to Client',
						'param' => 'all-clients?pre-process=Sent+Admission+Applied+Proof+to+Client',
						'countID' => 'countTotalPreClientsProof',
						'style' => 'background: linear-gradient(to top, #125E8A, #204B57)',
						'textColor' => 'text-white'
					],
					[
						'title' => 'Waiting for Admission decision',
						'param' => 'all-clients?pre-process=Waiting+for+Admission+decision',
						'countID' => 'countTotalPreWaiting',
						'style' => 'background: linear-gradient(to top, #125E8A, #204B57)',
						'textColor' => 'text-white'
					],
					[
						'title' => 'Acceptance and Summary Letter Received Clients',
						'param' => 'all-clients?pre-process=Acceptance+and+Summary+Letter+Received+Clients',
						'countID' => 'countTotalPreAcceptance',
						'style' => 'background: linear-gradient(to top, #125E8A, #204B57)',
						'textColor' => 'text-white'
					],
					[
						'title' => 'University Admission and Summary Rejected Clients',
						'param' => 'all-clients?pre-process=University+Admission+and+Summary+Rejected+Clients',
						'countID' => 'countTotalPreRejection',
						'style' => 'background: linear-gradient(to top, #125E8A, #204B57)',
						'textColor' => 'text-white'
					]
				];
				foreach ($preTask as $adRow) {
				?>
					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="<?= $adRow['style'];?>">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="<?= $adRow['title'] ?>">
									<a href="<?= $adRow['param'];?>">
										<p class="m-0 font-weight-medium text-truncate <?= $adRow['textColor'];?>"><?= $adRow['title'] ?></p>
										<h3 class="font-weight-bold my-2 <?= $adRow['textColor'];?>">
											<span data-plugin="countLoading" id="<?= $adRow['countID'];?>">0</span>
										</h3>
									</a>
								</div>
								<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-multiple-outline avatar-title font-30 <?= $adRow['textColor'];?>"></i>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				<!-- Self and WSL Acceptance clients Received -->
				<?php
				$preSelfTask = [
					[
						'title' => 'Applications Rechecked by Clients and Submit by Team',
						'param' => 'pre-enrollment-clients?pre-accept-process=Applications+Rechecked+by+Clients+and+Submit+by+Team',
						'countID' => 'countTotalAcceptPreinformedToClient',
						'style' => 'background: linear-gradient(to top, #183A37, #04151F)',
						'textColor' => 'text-white'
					],
					[
						'title' => 'Admission Application Submitted by Processing Team',
						'param' => 'pre-enrollment-clients?pre-accept-process=Admission+Application+Submitted+by+Processing+Team',
						'countID' => 'countTotalAcceptPreApplicationSubmited',
						'style' => 'background: linear-gradient(to top, #183A37, #04151F)',
						'textColor' => 'text-white'
					],
					[
						'title' => 'Sent Admission Applied Proof to Client',
						'param' => 'pre-enrollment-clients?pre-accept-process=Sent+Admission+Applied+Proof+to+Client',
						'countID' => 'countTotalAcceptPreClientsProof',
						'style' => 'background: linear-gradient(to top, #183A37, #04151F)',
						'textColor' => 'text-white'
					],
					[
						'title' => 'Waiting for Admission decision',
						'param' => 'pre-enrollment-clients?pre-accept-process=Waiting+for+Admission+decision',
						'countID' => 'countTotalAcceptPreWaiting',
						'style' => 'background: linear-gradient(to top, #183A37, #04151F)',
						'textColor' => 'text-white'
					],
					[
						'title' => 'Summary Letter Received Clients',
						'param' => 'pre-enrollment-clients?pre-accept-process=Summary+Letter+Received+Clients',
						'countID' => 'countTotalAcceptPreAcceptance',
						'style' => 'background: linear-gradient(to top, #183A37, #04151F)',
						'textColor' => 'text-white'
					],
					[
						'title' => 'Summary Letter Rejected Clients',
						'param' => 'pre-enrollment-clients?pre-accept-process=Summary+Letter+Rejected+Clients',
						'countID' => 'countTotalAcceptPreRejection',
						'style' => 'background: linear-gradient(to top, #183A37, #04151F)',
						'textColor' => 'text-white'
					]
				];
				foreach ($preSelfTask as $adRow) {
				?>
					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="<?= $adRow['style'];?>">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="<?= $adRow['title'] ?>">
									<a href="<?= $adRow['param'];?>">
										<p class="m-0 font-weight-medium text-truncate <?= $adRow['textColor'];?>">(WSL & Self Acceptance) <?= $adRow['title'] ?></p>
										<h3 class="font-weight-bold my-2 <?= $adRow['textColor'];?>">
											<span data-plugin="countLoading" id="<?= $adRow['countID'];?>">0</span>
										</h3>
									</a>
								</div>
								<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-multiple-outline avatar-title font-30 <?= $adRow['textColor'];?>"></i>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>

				</div>
			</div>
			<!-- show other filter divs -->
			<div class="col-xl-12">
				<h4>Filters</h4>
				<div class="row">
				<?php 
				$otherFilter = [
					[
						'title' => 'All Assign Programs',
						'link'  => 'all-clients?applied-programs=All+Assign+Programs',
						'countID' => 'countTotalAssign',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-warning'
					],
					[
						'title' => 'All Applied Programs',
						'link'  => 'all-clients?applied-programs=Total+Applied+Programs',
						'countID' => 'countTotalApplied',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-warning'
					],
					[
						'title' => 'Waiting for Admission decision',
						'link'  => 'all-clients?check-application=Waiting+for+Admission+decision',
						'countID' => 'countTotalWaiting',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-warning'
					],
					[
						'title' => 'Acceptance Letter Received Clients',
						'link'  => 'all-clients?check-application=Acceptance+Letter+Received+Clients',
						'countID' => 'countTotalAcceptance',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-warning'
					],
					[
						'title' => 'University Admission Rejected Clients',
						'link'  => 'all-clients?check-application=University+Admission+Rejected+Clients',
						'countID' => 'countTotalRejection',
						'style' => 'background: linear-gradient(to top, #232526, #414345)',
						'textColor' => 'text-warning'
					],
				];
				?>
				<?php foreach ($otherFilter as $adRow){ ?>
					<div class="col-xl-4 col-sm-6">
						<div class="card-box widget-two-custom" style="<?= $adRow['style'];?>">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="<?= htmlspecialchars($adRow['title']) ?>">
									<a href="<?= $adRow['link'] ?>">
										<p class="m-0 font-weight-medium text-truncate <?= $adRow['textColor'];?>"> <?= htmlspecialchars($adRow['title']) ?> </p>
										<h3 class="font-weight-bold my-2 <?= $adRow['textColor'];?>">
											<span data-plugin="countLoading" id="<?= $adRow['countID'];?>">0</span>
										</h3>
									</a>
								</div>
								<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-multiple-outline avatar-title font-30 <?= $adRow['textColor'];?>"></i>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
		</div>

	</div>
</div>

<div class="row">
	<div class="col-xl-4 col-sm-6">
		<div class="card-box widget-two-custom" style="background: linear-gradient(0deg, #ff512f, #f09819);">
			<div class="media">
				<div class="wigdet-two-content media-body">
					<a href="all-clients">
						<p class="m-0 text-uppercase font-weight-medium text-truncate text-white">All Italy Clients</p>
						<h3 class="font-weight-bold my-2 text-white"><span data-plugin="countLoading" id="countTotalItaly">0</span></h3>
						<p class="m-0 text-white">Total <span class="font-18"><b>Italy</b></span> <img src="../images/italy-flag.png" width="35px" height="18px"></p>
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
				<div class="wigdet-two-content media-body">
					<a href="all-clients?client-country=Pakistan">
						<p class="m-0 text-uppercase font-weight-medium text-truncate text-white">Italy Pakistan Clients</p>
						<h3 class="font-weight-bold my-2 text-white"><span data-plugin="countLoading" id="countTotalPakItaly">0</span></h3>
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
				<div class="wigdet-two-content media-body">
					<a href="all-clients?client-country=UAE">
						<p class="m-0 text-uppercase font-weight-medium text-truncate text-white" title="Statistics">Italy UAE Clients</p>
						<h3 class="font-weight-bold my-2 text-white"> <span data-plugin="countLoading" id="countTotalUAEItaly">0</span></span></h3>
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
	<div class="col-xl-4 col-sm-6">
		<div class="card-box widget-two-custom" style="background: linear-gradient(0deg,#6253E1,#04BEFE);">
			<div class="media">
				<div class="wigdet-two-content media-body">
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

	<div class="col-xl-4 col-sm-6">
		<div class="card-box widget-two-custom" style="background: linear-gradient(0deg,#6253E1,#04BEFE);">
			<div class="media">
				<div class="wigdet-two-content media-body">
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

	<div class="col-xl-4 col-sm-6">
		<div class="card-box widget-two-custom" style="background: linear-gradient(0deg,#6253E1,#04BEFE);">
			<div class="media">
				<div class="wigdet-two-content media-body">
					<a href="all-clients?client-degree=mbbs">
						<p class="m-0 font-weight-medium text-truncate text-white">MBBS Clients</p>
						<h3 class="font-weight-medium my-2 text-white"><span data-plugin="countLoading" id="countTotalMBBS">0</h3>
						<p class="m-0 text-white">Total</p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-doctor avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-4 col-sm-6">
		<div class="card-box widget-two-custom" style="background: linear-gradient(180deg, #000428, #004e92);">
			<div class="media">
				<div class="wigdet-two-content media-body">
					<a href="direct-pre-enrollment">
						<p class="m-0 font-weight-medium text-truncate text-white">Direct Pre Enrollment Clients</p>
						<h3 class="font-weight-medium my-2 text-white"> <span data-plugin="countLoading" id="countTotalPre">0</span></span></h3>
						<p class="m-0 text-white">Total</p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-alpha-p-circle avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-4 col-sm-6">
		<div class="card-box widget-two-custom" style="background: linear-gradient(180deg, #000428, #004e92);">
			<div class="media">
				<div class="wigdet-two-content media-body">
					<a href="dream-id-apply">
						<p class="m-0 font-weight-medium text-truncate text-white">Dream ID Clients</p>
						<h3 class="font-weight-medium my-2 text-white"><span data-plugin="countLoading" id="countTotalDream">0</span></h3>
						<p class="m-0 text-white">Total</p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-alpha-d-circle avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-4 col-sm-6">
		<div class="card-box widget-two-custom" style="background: linear-gradient(180deg, #000428, #004e92);">
			<div class="media">
				<div class="wigdet-two-content media-body">
					<a href="direct-universities-apply">
						<p class="m-0 font-weight-medium text-truncate text-white">Direct University Apply Clients</p>
						<h3 class="font-weight-medium my-2 text-white"><span data-plugin="countLoading" id="countTotalDirect">0</span></h3>
						<p class="m-0 text-white">Total</p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-alpha-d-circle avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-4 col-sm-6">
		<div class="card-box widget-two-custom" style="background: linear-gradient(to right, #8e2de2, #4a00e0);">
			<div class="media">
				<div class="wigdet-two-content media-body">
					<a href="before-tolc-test">
						<p class="m-0 font-weight-medium text-truncate text-white">Before TOLC Test Clients</p>
						<h3 class="font-weight-medium my-2 text-white"><span data-plugin="countLoading" id="countTotalbeforeTolc">0</span></h3>
						<p class="m-0 text-white">Total</p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-alpha-a-box avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-4 col-sm-6">
		<div class="card-box widget-two-custom" style="background: linear-gradient(to right, #8e2de2, #4a00e0);">
			<div class="media">
				<div class="wigdet-two-content media-body">
					<a href="after-tolc-test">
						<p class="m-0 font-weight-medium text-truncate text-white">After TOLC Test Clients</p>
						<h3 class="font-weight-medium my-2 text-white"><span data-plugin="countLoading" id="countTotalAfterTolc">0</span></h3>
						<p class="m-0 text-white">Total</p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-alpha-a-box avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-4 col-sm-6">
		<div class="card-box widget-two-custom" style="background: linear-gradient(to right, #8e2de2, #4a00e0);">
			<div class="media">
				<div class="wigdet-two-content media-body">
					<a href="cimea-apply-clients">
						<p class="m-0 font-weight-medium text-truncate text-white">Before Admission Apply Cimea Clients</p>
						<h3 class="font-weight-medium my-2 text-white"><span data-plugin="countLoading" id="countTotalCimea">0</span></h3>
						<p class="m-0 text-white">Total</p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-alpha-c-box avatar-title font-30 text-white"></i>
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
			url: 'models/_dashboardControllersState.php',
			type: 'GET',
			dataType: 'json',
			success: function(data) {
				console.log(data);
				$.each(data, function(key, value){
					if ($("#" + key).length) {
						let formattedValue = Number(value).toLocaleString();
						$("#" + key).text(formattedValue);
					}
				});
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