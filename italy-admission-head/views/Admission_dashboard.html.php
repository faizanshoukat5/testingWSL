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
			<div class="col-md-12">
				<div class="float-right">
					<button type="button" class="btn btn-info ml-2" onclick="testInterviewGuide('test');"><i class="mdi mdi-eye"></i> Test & Interview Guide</button>
				</div>
				<div class="float-right">
					<button type="button" class="btn btn-purple ml-2" onclick="uniInfoApplication('master');"><i class="mdi mdi-eye"></i> Master University Info</button>
				</div>
				<div class="float-right">
					<button type="button" class="btn btn-primary" onclick="uniInfoApplication('bachelor');"><i class="mdi mdi-eye"></i> Bachelor University Info</button>
				</div>
			</div>
			<div class="col-xl-6">
				<h4>My Admission Task</h4>
				<div class="row">
					<?php
					$admissionTask = [
						[
							'title' => 'My Pending Programs Report',
							'param' => 'applied-programs',
							'countID' => 'countTotalProgramPending',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => 'I Have Resolved the Pending Report',
							'param' => 'applied-programs',
							'countID' => 'countTotalProgramResolved',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => 'Inform the Client to Recheck the Application',
							'param' => 'check-application',
							'countID' => 'countTotalinformToClient',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => 'Applications Sent to the client for Rechecking',
							'param' => 'check-application',
							'countID' => 'countTotalinformedToClient',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info',
						],
						[
							'title' => 'Client Requests Changes in the Application',
							'param' => 'check-application',
							'countID' => 'countTotalChangeRequired',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => 'Changes Complete By Processing Team',
							'param' => 'check-application',
							'countID' => 'countTotalChangeUpdated',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => 'Client Informed, How to Pay the Application Fee',
							'param' => 'check-application',
							'countID' => 'countTotalInformPayfee',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => 'Application Approved And Application Fee Paid by Client',
							'param' => 'check-application',
							'countID' => 'countTotalFeePaid',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => 'Admission Application Submitted by Processing Team',
							'param' => 'check-application',
							'countID' => 'countTotalApplicationSubmited',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => 'Sent Admission Applied Proof to Client',
							'param' => 'check-application',
							'countID' => 'countTotalClientsProof',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => 'Inform to Processing Team to Fill Bergamo Enrollment Fee Form',
							'param' => 'check-application',
							'countID' => 'countTotalFillBergamoFee',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => 'Bergamo enrollment fee form was filled out by the processing team, but the client has not been informed yet to pay the application fee',
							'param' => 'check-application',
							'countID' => 'countTotalBergamoFormFilled',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => 'Bergamo University clients who have not yet paid the enrollment fee',
							'param' => 'check-application',
							'countID' => 'countTotalBergamoInformFee',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => 'Waiting for Admission decision',
							'param' => 'check-application',
							'countID' => 'countTotalWaiting',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => 'Acceptance Letter Received Clients',
							'param' => 'check-application',
							'countID' => 'countTotalAcceptance',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => 'University Admission Rejected Clients',
							'param' => 'check-application',
							'countID' => 'countTotalRejection',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => 'After Admission Dues Not Clear Clients',
							'param' => 'visa-process',
							'countID' => 'countTotalDueNotClear',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => 'After Admission Dues Remaining Clients',
							'param' => 'visa-process',
							'countID' => 'countTotalDueRemaining',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => 'After Admission Dues Clear Clients',
							'param' => 'visa-process',
							'countID' => 'countTotalDueClear',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => 'Additional Activities Required by University Clients Assign to Processing Team',
							'param' => 'check-application',
							'countID' => 'countTotalAdditionalActivitiesAssign',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => 'Additional Activities Required by University Task Complete by Processing Team',
							'param' => 'check-application',
							'countID' => 'countTotalAdditionalActivitiesComplete',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => 'Deadline Hold',
							'param' => 'check-application',
							'countID' => 'countDeadlineHold',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						],
						[
							'title' => 'Deadline Release',
							'param' => 'check-application',
							'countID' => 'countDeadlineRelease',
							'style' => 'background: linear-gradient(to top, #232526, #414345)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-info'
						]
					];
					foreach ($admissionTask as $adRow) {
						$urlParam = urlencode(str_replace('', '+', $adRow['title']));
					?>
					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="<?= $adRow['style'];?>">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="<?= $adRow['title'] ?>">
									<a href="all-clients?<?= $adRow['param'];?>=<?= $urlParam;?>">
										<p class="m-0 font-weight-medium text-truncate <?= $adRow['textColor'];?>"><?= $adRow['title'] ?></p>
										<h3 class="font-weight-bold my-2 <?= $adRow['textColor'];?>">
											<span data-plugin="counterup" id="<?= $adRow['countID'];?>">0</span>
										</h3>
									</a>
								</div>
								<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
									<i class="<?= $adRow['icons'];?> avatar-title font-30 <?= $adRow['textColor'];?>"></i>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>

				</div>
			</div>
			<div class="col-xl-6" style="border-left: 2px solid black;">
				<h4>Direct Pre Enrollment University Task</h4>
				<div class="row">
					<?php
					$preTask = [
						[
							'title' => 'Applications Rechecked by Clients and Submit by Team',
							'param' => 'pre-process',
							'countID' => 'countTotalPreinformedToClient',
							'style' => 'background: linear-gradient(to top, #125E8A, #204B57)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-white'
						],
						[
							'title' => 'Admission Application Submitted by Processing Team',
							'param' => 'pre-process',
							'countID' => 'countTotalPreApplicationSubmited',
							'style' => 'background: linear-gradient(to top, #125E8A, #204B57)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-white'
						],
						[
							'title' => 'Sent Admission Applied Proof to Client',
							'param' => 'pre-process',
							'countID' => 'countTotalPreClientsProof',
							'style' => 'background: linear-gradient(to top, #125E8A, #204B57)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-white'
						],
						[
							'title' => 'Waiting for Admission decision',
							'param' => 'pre-process',
							'countID' => 'countTotalPreWaiting',
							'style' => 'background: linear-gradient(to top, #125E8A, #204B57)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-white'
						],
						[
							'title' => 'Acceptance and Summary Letter Received Clients',
							'param' => 'pre-process',
							'countID' => 'countTotalPreAcceptance',
							'style' => 'background: linear-gradient(to top, #125E8A, #204B57)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-white'
						],
						[
							'title' => 'University Admission and Summary Rejected Clients',
							'param' => 'pre-process',
							'countID' => 'countTotalPreRejection',
							'style' => 'background: linear-gradient(to top, #125E8A, #204B57)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-white'
						]
					];
					foreach ($preTask as $preRow) {
						$urlParam = urlencode(str_replace('', '+', $preRow['title']));
					?>
					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="<?= $preRow['style'];?>">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="<?= $preRow['title'] ?>">
									<a href="all-clients?<?= $preRow['param'];?>=<?= $urlParam;?>">
										<p class="m-0 font-weight-medium text-truncate <?= $preRow['textColor'];?>"><?= $preRow['title'] ?></p>
										<h3 class="font-weight-bold my-2 <?= $preRow['textColor'];?>">
											<span data-plugin="counterup" id="<?= $preRow['countID'];?>"></span>
										</h3>
									</a>
								</div>
								<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
									<i class="<?= $preRow['icons'];?> avatar-title font-30 <?= $preRow['textColor'];?>"></i>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					<!-- Self and WSL Acceptance clients Received -->
					<?php
					$preAcceptTask = [
						[
							'title' => 'New Pre Enrollment Assign to Processing Team Clients',
							'param' => 'pre-accept-process',
							'countID' => 'countTotalAcceptNewAssign',
							'style' => 'background: linear-gradient(to top, #183A37, #04151F)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-warning'
						],
						[
							'title' => 'Applications Rechecked by Clients and Submit by Team',
							'param' => 'pre-accept-process',
							'countID' => 'countTotalAcceptPreinformedToClient',
							'style' => 'background: linear-gradient(to top, #183A37, #04151F)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-white'
						],
						[
							'title' => 'Admission Application Submitted by Processing Team',
							'param' => 'pre-accept-process',
							'countID' => 'countTotalAcceptPreApplicationSubmited',
							'style' => 'background: linear-gradient(to top, #183A37, #04151F)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-white'
						],
						[
							'title' => 'Sent Admission Applied Proof to Client',
							'param' => 'pre-accept-process',
							'countID' => 'countTotalAcceptPreClientsProof',
							'style' => 'background: linear-gradient(to top, #183A37, #04151F)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-white'
						],
						[
							'title' => 'Waiting for Admission decision',
							'param' => 'pre-accept-process',
							'countID' => 'countTotalAcceptPreWaiting',
							'style' => 'background: linear-gradient(to top, #183A37, #04151F)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-white'
						],
						[
							'title' => 'Summary Letter Received Clients',
							'param' => 'pre-accept-process',
							'countID' => 'countTotalAcceptPreAcceptance',
							'style' => 'background: linear-gradient(to top, #183A37, #04151F)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-white'
						],
						[
							'title' => 'Summary Letter Rejected Clients',
							'param' => 'pre-accept-process',
							'countID' => 'countTotalAcceptPreRejection',
							'style' => 'background: linear-gradient(to top, #183A37, #04151F)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-white'
						]
					];
					foreach ($preAcceptTask as $preRow) {
						$urlParam = urlencode(str_replace('', '+', $preRow['title']));
					?>
					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="<?= $preRow['style'];?>">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="<?= $preRow['title'] ?>">
									<a href="all-clients?<?= $preRow['param'];?>=<?= $urlParam;?>">
										<p class="m-0 font-weight-medium text-truncate <?= $preRow['textColor'];?>">(WSL & Self Acceptance) <?= $preRow['title'] ?></p>
										<h3 class="font-weight-bold my-2 <?= $preRow['textColor'];?>">
											<span data-plugin="counterup" id="<?= $preRow['countID'];?>"></span>
										</h3>
									</a>
								</div>
								<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
									<i class="<?= $preRow['icons'];?> avatar-title font-30 <?= $preRow['textColor'];?>"></i>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					<!-- Tolc test -->
					<?php
					$tolcTask = [
						[
							'title' => 'Inform the Client to Recheck the CEnT-S Application',
							'param' => 'CEnT-S-process',
							'countID' => 'countTotalTolcInform',
							'style' => 'background: linear-gradient(to top, #4B5267, #2E294E)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-white'
						],
						[
							'title' => 'CEnT-S Applications Sent to the client for Rechecking',
							'param' => 'CEnT-S-process',
							'countID' => 'countTotalTolcSenttoClient',
							'style' => 'background: linear-gradient(to top, #4B5267, #2E294E)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-white'
						],
						[
							'title' => 'CEnT-S Test Date Clients',
							'param' => 'CEnT-S-process',
							'countID' => 'countTotalTolcDate',
							'style' => 'background: linear-gradient(to top, #4B5267, #2E294E)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-white'
						],
						[
							'title' => 'CEnT-S Test Fee Paid Clients',
							'param' => 'CEnT-S-process',
							'countID' => 'countTotalTolcFeePaid',
							'style' => 'background: linear-gradient(to top, #4B5267, #2E294E)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-white'
						],
						[
							'title' => 'Sent Practice CEnT-S Test Video',
							'param' => 'CEnT-S-process',
							'countID' => 'countTotalTolcSentPractice',
							'style' => 'background: linear-gradient(to top, #4B5267, #2E294E)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-white'
						],
						[
							'title' => 'CEnT-S Test Pass Clients',
							'param' => 'CEnT-S-process',
							'countID' => 'countTotalTolcPass',
							'style' => 'background: linear-gradient(to top, #4B5267, #2E294E)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-white'
						],
						[
							'title' => 'CEnT-S Test Fail Clients',
							'param' => 'CEnT-S-process',
							'countID' => 'countTotalTolcFail',
							'style' => 'background: linear-gradient(to top, #4B5267, #2E294E)',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-white'
						],
						[
							'title' => 'CEnT-S Pass But Not Applied',
							'param' => 'check-application',
							'countID' => 'countTotalTolcPassNotApplied',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-warning'
						],
					];
					foreach ($tolcTask as $tolcRow) {
						$urlParam = urlencode(str_replace('', '+', $tolcRow['title']));
					?>
					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="<?= $tolcRow['style'];?>">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="<?= $tolcRow['title'] ?>">
									<a href="all-clients?<?= $tolcRow['param'];?>=<?= $urlParam;?>">
										<p class="m-0 font-weight-medium text-truncate <?= $tolcRow['textColor'];?>">(CEnT-S Task) <?= $tolcRow['title'] ?></p>
										<h3 class="font-weight-bold my-2 <?= $tolcRow['textColor'];?>">
											<span data-plugin="counterup" id="<?= $tolcRow['countID'];?>"></span>
										</h3>
									</a>
								</div>
								<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
									<i class="<?= $tolcRow['icons'];?> avatar-title font-30 <?= $tolcRow['textColor'];?>"></i>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>

					<!-- other Div Self Received Acceptance -->
					<div class="col-xl-12 col-sm-6">
						<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="Self Received Acceptance">
									<a href="all-clients?check-application=Self+Received+Acceptance">
										<p class="m-0 font-weight-medium text-truncate text-warning">Self Received Acceptance</p>
										<h3 class="font-weight-bold my-2 text-warning"><span data-plugin="counterup" id="countTotalSelfReceived">0</span></h3>
									</a>
								</div>
								<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-warning"></i>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>


			<div class="col-xl-12">
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
							'title' => 'New Assign But Not Applied Clients',
							'param' => 'applied-programs=New+Assign+But+Not+Applied+Clients',
							'countID' => 'countTotalAssignNotApplied',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-warning'
						],
						[
							'title' => 'Advance Remaining Payment Not Clear Clients',
							'param' => 'check-application=Advance+Remaining+Payment+Not+Clear+Clients',
							'countID' => 'countTotalAdvPaymentNotClear',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-warning'
						],
						[
							'title' => 'All Assign Programs',
							'param' => 'assign-programs=All+Assign+Programs',
							'countID' => 'countTotalAssign',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-warning'
						],
						[
							'title' => 'All Not Assign Programs',
							'param' => 'assign-programs=All+Not+Assign+Programs',
							'countID' => 'countTotalNotAssign',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-warning'
						],
						[
							'title' => 'All Applied Programs',
							'param' => 'applied-programs=All+Applied+Programs',
							'countID' => 'countTotalApplied',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-warning'
						],
						[
							'title' => 'University Open, but Not Assign Clients',
							'param' => 'assign-programs=University+Open%2C+but+Not+Assign+Clients',
							'countID' => 'totalOpeningNot',
							'style' => 'background: linear-gradient(to top, #232526, #414345);',
							'icons' => 'mdi mdi-account-multiple-outline',
							'textColor' => 'text-warning'
						]
					];
					foreach ($clientTasks as $task) {
					?>
					<div class="col-lg-4 col-sm-12">
						<div class="card-box widget-two-custom" style="<?= $task['style'];?>">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="<?= $task['title'] ?>">
									<a href="all-clients?<?= $task['param'];?>">
										<p class="m-0 font-weight-medium text-truncate <?= $task['textColor'];?>"><?= $task['title'] ?></p>
										<h3 class="font-weight-bold my-2 <?= $task['textColor'];?>">
											<span data-plugin="counterup" id="<?= $task['countID'];?>"></span>
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

					<div class="col-lg-4 col-sm-12">
						<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="List of Clients with University Open Admission">
									<a href="all-clients?assign-programs=List+of+Clients+with+University+Open+Admission">
										<p class="m-0 font-weight-medium text-truncate text-warning">List of Clients with University Open Admission</p>
										<h3 class="font-weight-bold my-2 text-warning">
											<span data-plugin="counterup" id="totalOpening">0</span> 
											<span class="float-right"><button type="button" class="btn btn-success btn-sm mr-2" data-toggle="tooltip" data-placement="top" title="Admission Open"><i class="mdi mdi-alpha-c-circle-outline"></i></button></span>
										</h3>
									</a>
								</div>
								<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-warning"></i>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-4 col-sm-12">
						<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="List of Clients, Admission Date Announce But Not Open University yet">
									<a href="all-clients?assign-programs=List+of+Clients%2C+Admission+Date+Announce+But+Not+Open+University+Yet">
										<p class="m-0 font-weight-medium text-truncate text-warning">List of Clients, Admission Date Announce But Not Open University yet</p>
										<h3 class="font-weight-bold my-2 text-warning">
											<span data-plugin="counterup" id="totalOpeningYet">0</span> 
											<span class="float-right"><button type="button" class="btn btn-warning btn-sm mr-2" data-toggle="tooltip" data-placement="top" title="Admission Not Open yet"><i class="mdi mdi-alpha-c-circle-outline"></i></button></span>
										</h3>
									</a>
								</div>
								<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-warning"></i>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-4 col-sm-12">
						<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="List of Clients with University Closed Admission">
									<a href="all-clients?assign-programs=List+of+Clients+with+University+Closed+Admission">
										<p class="m-0 font-weight-medium text-truncate text-warning">List of Clients with University Closed Admission</p>
										<h3 class="font-weight-bold my-2 text-warning">
											<span data-plugin="counterup" id="totalClosing">0</span> 
											<span class="float-right"><button type="button" class="btn btn-danger btn-sm mr-2" data-toggle="tooltip" data-placement="top" title="University Closed"><i class="mdi mdi-alpha-c-circle-outline"></i></button></span>
										</h3>
									</a>
								</div>
								<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-warning"></i>
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
	<div class="col-lg-4 col-sm-12">
		<div class="card-box widget-two-custom" style="background: linear-gradient(0deg, #ff512f, #f09819);">
			<div class="media">
				<div class="wigdet-two-content media-body text-truncate">
					<a href="">
						<p class="m-0 text-uppercase font-weight-medium text-truncate text-white">OverAll Italy Clients</p>
						<h3 class="font-weight-bold my-2 text-white"><span data-plugin="counterup" id="countOverallItaly">0</span></h3>
						<p class="m-0 text-white">Total <span class="font-18"><b>Italy</b></span> <img src="../images/italy-flag.png" width="35px" height="18px"></p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-sm-12">
		<div class="card-box widget-two-custom" style="background: radial-gradient(circle at -1% 57.5%, rgb(19, 170, 82) 0%, rgb(0, 102, 43) 90%);">
			<div class="media">
				<div class="wigdet-two-content media-body text-truncate">
					<a href="">
						<p class="m-0 text-uppercase font-weight-medium text-truncate text-white" data-toggle="tooltip" data-placement="top" title="Italy Pakistan Programs & Document Not Complete Clients">Italy Pakistan Programs & Document Not Complete Clients</p>
						<h3 class="font-weight-bold my-2 text-white"><span data-plugin="counterup" id="countTotalNotProgramDocPakItaly">0</span></h3>
						<p class="m-0 text-white">Total <span class="font-18"><b>Pakistan</b></span> <img src="../images/pakistan-flag.png" width="35px" height="18px"></p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-sm-12">
		<div class="card-box widget-two-custom" style="background-image: linear-gradient(0deg, rgb(94, 5, 4),rgb(253, 19, 61));">
			<div class="media">
				<div class="wigdet-two-content media-body text-truncate">
					<a href="">
						<p class="m-0 text-uppercase font-weight-medium text-truncate text-white" data-toggle="tooltip" data-placement="top" title="Italy UAE Programs & Document Not Complete Clients">Italy UAE Programs & Document Not Complete Clients</p>
						<h3 class="font-weight-bold my-2 text-white"> <span data-plugin="counterup" id="countTotalNotProgramDocUAEItaly">0</span></h3>
						<p class="m-0 text-white">Total <span class="font-18"><b>UAE</b></span> <img src="../images/uae-flag.png" width="35px" height="18px"></p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-account-multiple avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-sm-12">
		<div class="card-box widget-two-custom" style="background: linear-gradient(0deg, #ff512f, #f09819);">
			<div class="media">
				<div class="wigdet-two-content media-body text-truncate">
					<a href="all-clients">
						<p class="m-0 text-uppercase font-weight-medium text-truncate text-white">All Italy Clients</p>
						<h3 class="font-weight-bold my-2 text-white"><span data-plugin="counterup" id="countTotalItaly">0</span></h3>
						<p class="m-0 text-white">Total <span class="font-18"><b>Italy</b></span> <img src="../images/italy-flag.png" width="35px" height="18px"></p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-sm-12">
		<div class="card-box widget-two-custom" style="background: radial-gradient(circle at -1% 57.5%, rgb(19, 170, 82) 0%, rgb(0, 102, 43) 90%);">
			<div class="media">
				<div class="wigdet-two-content media-body text-truncate">
					<a href="all-clients?client-country=Pakistan">
						<p class="m-0 text-uppercase font-weight-medium text-truncate text-white">Italy Pakistan Clients</p>
						<h3 class="font-weight-bold my-2 text-white"><span data-plugin="counterup" id="countTotalPakItaly">0</span></h3>
						<p class="m-0 text-white">Total <span class="font-18"><b>Pakistan</b></span> <img src="../images/pakistan-flag.png" width="35px" height="18px"></p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-sm-12">
		<div class="card-box widget-two-custom" style="background-image: linear-gradient(0deg, rgb(94, 5, 4),rgb(253, 19, 61));">
			<div class="media">
				<div class="wigdet-two-content media-body text-truncate">
					<a href="all-clients?client-country=UAE">
						<p class="m-0 text-uppercase font-weight-medium text-truncate text-white" title="Statistics">Italy UAE Clients</p>
						<h3 class="font-weight-bold my-2 text-white"> <span data-plugin="counterup" id="countTotalUAEItaly">0</span></h3>
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
	<div class="col-lg-4 col-sm-12">
		<div class="card-box widget-two-custom" style="background: linear-gradient(0deg,#6253E1,#04BEFE);">
			<div class="media">

				<div class="wigdet-two-content media-body text-truncate">
					<a href="all-clients?client-degree=bachelor">
						<p class="m-0 font-weight-medium text-truncate text-white text-white">Bachelor Clients</p>
						<h3 class="font-weight-medium my-2 text-white"> <span data-plugin="counterup" id="countTotalBachelor">0</span></h3>
						<p class="m-0 text-white">Total</p>	
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-alpha-b-circle avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-sm-12">
		<div class="card-box widget-two-custom" style="background: linear-gradient(0deg,#6253E1,#04BEFE);">
			<div class="media">

				<div class="wigdet-two-content media-body text-truncate">
					<a href="all-clients?client-degree=master">
						<p class="m-0 font-weight-medium text-truncate text-white">Master Clients</p>
						<h3 class="font-weight-medium my-2 text-white"><span data-plugin="counterup" id="countTotalMaster">0</span></h3>
						<p class="m-0 text-white">Total</p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-alpha-m-circle avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-sm-12">
		<div class="card-box widget-two-custom" style="background: linear-gradient(0deg,#6253E1,#04BEFE);">
			<div class="media">

				<div class="wigdet-two-content media-body text-truncate">
					<a href="all-clients?client-degree=mbbs">
						<p class="m-0 font-weight-medium text-truncate text-white">MBBS Clients</p>
						<h3 class="font-weight-medium my-2 text-white"><span data-plugin="counterup" id="countTotalMBBS">0</h3>
						<p class="m-0 text-white">Total</p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-doctor avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-sm-12">
		<div class="card-box widget-two-custom" style="background: linear-gradient(180deg, #000428, #004e92);">
			<div class="media">

				<div class="wigdet-two-content media-body text-truncate">
					<a href="direct-pre-enrollment">
						<p class="m-0 font-weight-medium text-truncate text-white">Direct Pre Enrollment Clients</p>
						<h3 class="font-weight-medium my-2 text-white"> <span data-plugin="counterup" id="countTotalPre">0</span></h3>
						<p class="m-0 text-white">Total</p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-alpha-p-circle avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-sm-12">
		<div class="card-box widget-two-custom" style="background: linear-gradient(180deg, #000428, #004e92);">
			<div class="media">

				<div class="wigdet-two-content media-body text-truncate">
					<a href="dream-id-apply">
						<p class="m-0 font-weight-medium text-truncate text-white">Dream ID Clients</p>
						<h3 class="font-weight-medium my-2 text-white"><span data-plugin="counterup" id="countTotalDream">0</span></h3>
						<p class="m-0 text-white">Total</p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-alpha-d-circle avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-sm-12">
		<div class="card-box widget-two-custom" style="background: linear-gradient(180deg, #000428, #004e92);">
			<div class="media">

				<div class="wigdet-two-content media-body text-truncate">
					<a href="direct-universities-apply">
						<p class="m-0 font-weight-medium text-truncate text-white">Direct University Apply Clients</p>
						<h3 class="font-weight-medium my-2 text-white"><span data-plugin="counterup" id="countTotalDirect">0</h3>
						<p class="m-0 text-white">Total</p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-alpha-d-circle avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-sm-12">
		<div class="card-box widget-two-custom" style="background: linear-gradient(to right, #232526, #414345);">
			<div class="media">

				<div class="wigdet-two-content media-body text-truncate">
					<a href="before-CEnT-S-test">
						<p class="m-0 font-weight-medium text-truncate text-white">Before CEnT-S Test Clients</p>
						<h3 class="font-weight-medium my-2 text-white"><span data-plugin="counterup" id="countTotalbeforeTolc">0</h3>
						<p class="m-0 text-white">Total</p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-alpha-a-box avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-sm-12">
		<div class="card-box widget-two-custom" style="background: linear-gradient(to right, #232526, #414345);">
			<div class="media">

				<div class="wigdet-two-content media-body text-truncate">
					<a href="after-CEnT-S-test">
						<p class="m-0 font-weight-medium text-truncate text-white">After CEnT-S Test Clients</p>
						<h3 class="font-weight-medium my-2 text-white"><span data-plugin="counterup" id="countTotalAfterTolc">0</h3>
						<p class="m-0 text-white">Total</p>
					</a>
				</div>
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-alpha-a-box avatar-title font-30 text-white"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-sm-12">
		<div class="card-box widget-two-custom" style="background: linear-gradient(to right, #232526, #414345);">
			<div class="media">

				<div class="wigdet-two-content media-body text-truncate">
					<a href="cimea-apply-clients">
						<p class="m-0 font-weight-medium text-truncate text-white">Before Admission Apply Cimea Clients</p>
						<h3 class="font-weight-medium my-2 text-white"><span data-plugin="counterup" id="countTotalCimea">0</h3>
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
<!-- Add Due After Acceptance -->
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
<script src="../assets/js/jquery-v3.6.0.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("[data-plugin='counterup']").each(function() {
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
<script type="text/javascript">
	function uniInfoApplication(val) {
		var degreeVal = val;
		$.ajax({
			type: "POST",
			url: "models/checklistState.php",
			data:'uniAppliedInfo='+degreeVal,
			success: function(data){
				$(".showModalTitle").html('University Info');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	}
	// Test & Interview Guide
	function testInterviewGuide(test) {
		var test = test;
		$.ajax({
			type: "POST",
			url: "models/testInterviewGuideState.php",
			data:'testViewGuide='+test,
			success: function(data){
				$(".showModalTitle").html('Test & Interview Guide');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');

				$("#showModalClient").on('shown.bs.modal', function () {
					let audioElements = $(this).find("audio");
					audioElements.each(function () {
						this.playbackRate = 1.5;
					});
				});
			}
		});
	}

	// documents Attestation link copy
	function copyLink(id) {
		var linkCopy = id;
		if (linkCopy=='TOLCE') {
			var message = `https://info.wslcms.com/interview-guide?zOObUTnevER06=tolcE&Vo25YQ1tYS=tolcE`;
		}
		else if (linkCopy=='TOLCF') {
			var message = `https://info.wslcms.com/interview-guide?zOObUTnevER06=tolcF&Vo25YQ1tYS=tolcF`;
		}
		else if (linkCopy=='TOLCI') {
			var message = `https://info.wslcms.com/interview-guide?zOObUTnevER06=tolcI&Vo25YQ1tYS=tolcI`;
		}
		else if (linkCopy=='SienaGuide') {
			var message = `https://info.wslcms.com/interview-guide?zOObUTnevER06=siena&Vo25YQ1tYS=siena`;
		}
		else if (linkCopy=='BergamoGuide') {
			var message = `https://info.wslcms.com/interview-guide?zOObUTnevER06=bergamo&Vo25YQ1tYS=bergamo`;
		}
		else if (linkCopy=='GenovaGuide') {
			var message = `https://info.wslcms.com/interview-guide?zOObUTnevER06=genova&Vo25YQ1tYS=genova`;
		}
		else if (linkCopy=='TrentoGuide') {
			var message = `https://info.wslcms.com/interview-guide?zOObUTnevER06=trento&Vo25YQ1tYS=trento`;
		}
		else if (linkCopy=='FoscariGuide') {
			var message = `https://info.wslcms.com/interview-guide?zOObUTnevER06=foscari&Vo25YQ1tYS=foscari`;
		}
		else if (linkCopy=='PaviaGuide') {
			var message = `https://info.wslcms.com/interview-guide?zOObUTnevER06=pavia&Vo25YQ1tYS=pavia`;
		}
		else if (linkCopy=='MarcheGuide') {
			var message = `https://info.wslcms.com/interview-guide?zOObUTnevER06=marche&Vo25YQ1tYS=marche`;
		}
		else if (linkCopy=='TriesteGuide') {
			var message = `https://info.wslcms.com/application-guideline?neHinA0vER06=Trieste&guiDRafiA05S=Trieste`;
		}
		else if (linkCopy=='CentsTest') {
			var message = `https://info.wslcms.com/interview-guide?zOObUTnevER06=cents0Test&Vo25YQ1tYS=cents0Test`;
		}
		else if (linkCopy=='ScholarshipGuide') {
			var message = `https://info.wslcms.com/scholarship-details`;
		}
		
		navigator.clipboard.writeText(message).then(function() {
			var linktoast = document.getElementById("showToastLink");
			linktoast.classList.add("show");
			// Hide the linktoast after 3 seconds
			setTimeout(function() {
				linktoast.classList.remove("show");
			}, 3000);
		}).catch(function(err) {
			alert("Failed to copy text: " + err);
		});
	};
</script>


<?php 
}else{
	header('Location:../login');
}
?>