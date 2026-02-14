<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if (isset($_POST['teamPortalID'])) {
	$empID = $_POST['teamPortalID'];

	$select_query = "SELECT * FROM wt_users WHERE status='1' AND close='1' AND wt_id='".$empID."'";
	$select_query_ex = mysqli_query($con, $select_query);

	if (mysqli_num_rows($select_query_ex) > 0) {
		$row = mysqli_fetch_assoc($select_query_ex);
		$userName = $row['user_name'];
		$password = $row['password'];

		session_unset();
		session_destroy();
		setcookie('user_id', '', time() - 3600, '/');
		setcookie('user_email', '', time() - 3600, '/');
		setcookie('final_pass', '', time() - 3600, '/');
		setcookie('user_type', '', time() - 3600, '/');
		setcookie('user_name', '', time() - 3600, '/');
		setcookie('uname', '', time() - 3600, '/');

		session_start();

		$log_sql = "SELECT * FROM wt_users WHERE user_name='".$userName."' AND password='".$password."'";
		$log_sql_ex = mysqli_query($con, $log_sql);

		if (mysqli_num_rows($log_sql_ex) == 1) {
			$row = mysqli_fetch_assoc($log_sql_ex);

			$_SESSION['user_id'] = $row['wt_id'];
			setcookie('user_id', $row['wt_id'], time() + (60 * 60 * 24 * 30), '/');
			$_SESSION['final_pass'] = $row['password'];
			setcookie('final_pass', $row['password'], time() + (60 * 60 * 24 * 30), '/');
			$_SESSION['user_name'] = $row['user_name'];
			setcookie('user_name', $row['user_name'], time() + (60 * 60 * 24 * 30), '/');
			$_SESSION['user_email'] = $row['email'];
			setcookie('user_email', $row['email'], time() + (60 * 60 * 24 * 30), '/');
			$_SESSION['user_type'] = $row['type'];
			setcookie('user_type', $row['type'], time() + (60 * 60 * 24 * 30), '/');
			$_SESSION['uname'] = $row['fname'] . " " . $row['lname'];
			setcookie('uname', $_SESSION['uname'], time() + (60 * 60 * 24 * 30), '/');
			$_SESSION['phone'] = $row['phone'];
			setcookie('phone', $row['phone'], time() + (60 * 60 * 24 * 30), '/');
			$_SESSION['user_designation'] = $row['designation'];
			setcookie('user_designation', $row['designation'], time() + (60 * 60 * 24 * 30), '/');

			$_SESSION['user_image'] = $row['user_image'];
			setcookie('user_image', $row['user_image'], time() + (60 * 60 * 24 * 30), '/');

			$select_session = "SELECT * FROM session_active WHERE active_user_id = '".$_SESSION['user_id']."'";
			$select_session_ex = mysqli_query($con,$select_session);
			foreach($select_session_ex as $session_value){
				$_SESSION['dbNo'] = $session_value['active_session_id'];
				setcookie('dbNo', $_SESSION['dbNo'],time()+(60*60*24*30),'/');

				$_SESSION['s_date'] = $session_value['s_date'];
				setcookie('s_date', $_SESSION['s_date'],time()+(60*60*24*30),'/');
				$_SESSION['e_date'] = $session_value['e_date'];
				setcookie('e_date', $_SESSION['e_date'],time()+(60*60*24*30),'/');
			}

			// Prepare response with redirection path
			$response = array();
			if ($_SESSION['user_type'] == 'admin') {
				$response['redirect'] = '../super-admin/dashboard';
			}
			elseif ($_SESSION['user_type'] == 'sale department') {
				$response['redirect'] = '../sale-department/dashboard';
			}
			elseif ($_SESSION['user_type'] == 'team manager') {
				$response['redirect'] = '../team-manager/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'accountant') {
				$response['redirect'] = '../accountant/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'documents collections' || $_SESSION['user_type'] == 'documents collections france') {
				$response['redirect'] = '../documents-collections/dashboard';
			}
			// Austria Country 
			elseif ($_SESSION['user_type'] == 'austria admission head') {
				$response['redirect'] = '../austria-admission-head/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'austria admission team') {
				$response['redirect'] = '../austria-admission-team/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'austria visa team') {
				$response['redirect'] = '../austria-visa-team/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'austria university sop') {
				$response['redirect'] = '../university-sop-team/dashboard';
			} 
			// italy country
			elseif ($_SESSION['user_type'] == 'italy admission head') {
				$response['redirect'] = '../italy-admission-head/admission-dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'italy admission team') {
				$response['redirect'] = '../italy-admission-team/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'italy visa team') {
				$response['redirect'] = '../italy-visa-team/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'italy university sop') {
				$response['redirect'] = '../university-sop-team/dashboard';
			}
			// czech republic country
			elseif ($_SESSION['user_type'] == 'czech republic admission head') {
				$response['redirect'] = '../czech-republic-admission-head/admission-dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'czech republic admission team') {
				$response['redirect'] = '../czech-republic-admission-team/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'czech republic visa team') {
				$response['redirect'] = '../czech-republic-visa-team/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'czech republic university sop') {
				$response['redirect'] = '../university-sop-team/dashboard';
			}
			// france country
			elseif ($_SESSION['user_type'] == 'france admission head') {
				$response['redirect'] = '../france-admission-head/admission-dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'france admission team') {
				$response['redirect'] = '../france-admission-team/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'france visa team') {
				$response['redirect'] = '../france-visa-team/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'france university sop') {
				$response['redirect'] = '../university-sop-team/dashboard';
			}

			elseif ($_SESSION['user_type'] == 'IELTS Enrollment') {
				$response['redirect'] = '../ielts-enrollment/dashboard';
			}

			echo json_encode($response);
		}
	}
}

if (isset($_POST['checkwtID'])) {
	$checkwtID = $_POST['checkwtID'];

	// Assign programs
	$select = "SELECT aus_client_pro_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id=cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_program_assign='".$checkwtID."' AND acp.aus_assign_status='1' "; 
	$select_ex = mysqli_query($con, $select);
	$countTotalAssign = mysqli_num_rows($select_ex);

	// Applied programs
	$select = "SELECT aus_client_pro_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id=cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_program_assign='".$checkwtID."' AND acp.aus_direct_applied_screenshot!='' "; 
	$select_ex = mysqli_query($con, $select);
	$countTotalApplied = mysqli_num_rows($select_ex);

	// new Assign but not Applied programs
	$select = "SELECT aus_client_pro_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id=cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_program_assign='".$checkwtID."' AND acp.aus_program_status='0' AND acp.aus_direct_applied_status='0' "; 
	$select_ex = mysqli_query($con, $select);
	$countTotalNewAssignNotApplied = mysqli_num_rows($select_ex);

	// inform to client
	$select = "SELECT aus_client_pro_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id=cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_program_assign='".$checkwtID."' AND ((acp.aus_direct_applied_status='0' AND acp.aus_direct_applied_status='5')) AND acp.aus_assign_status='1' "; 
	$select_ex = mysqli_query($con, $select);
	$countTotalinformToClient = mysqli_num_rows($select_ex);

	// informed to client
	$select = "SELECT aus_client_pro_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id=cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_program_assign='".$checkwtID."' AND ((acp.aus_direct_applied_status='1' AND acp.aus_direct_applied_status='5') ) AND acp.aus_assign_status='1' "; 
	$select_ex = mysqli_query($con, $select);
	$countTotalinformedToClient = mysqli_num_rows($select_ex);

	// changes required
	$select = "SELECT aus_client_pro_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id=cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND aus_program_assign='".$checkwtID."' AND ((acp.aus_direct_applied_status='2' AND acp.aus_direct_applied_status='5')) AND acp.aus_assign_status='1' "; 
	$select_ex = mysqli_query($con, $select);
	$countTotalChangeRequired = mysqli_num_rows($select_ex);

	// changes Updated
	$select = "SELECT aus_client_pro_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id=cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_program_assign='".$checkwtID."' AND ((acp.aus_direct_applied_status='2' AND acp.aus_direct_applied_status='6') ) AND acp.aus_assign_status='1' "; 
	$select_ex = mysqli_query($con, $select);
	$countTotalChangeUpdated = mysqli_num_rows($select_ex);

	// Approved application
	$select = "SELECT aus_client_pro_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id=cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_program_assign='".$checkwtID."' AND (acp.aus_direct_applied_status='6' || acp.aus_direct_applied_status='5') AND acp.aus_assign_status='1' "; 
	$select_ex = mysqli_query($con, $select);
	$countTotalApproved = mysqli_num_rows($select_ex);

	// inform to pay fee
	$select = "SELECT aus_client_pro_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id=cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_program_assign='".$checkwtID."' AND acp.aus_assign_status='1' "; 
	$select_ex = mysqli_query($con, $select);
	$countTotalInformPayfee = mysqli_num_rows($select_ex);

	// fee paid
	$select = "SELECT aus_client_pro_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id=cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_program_assign='".$checkwtID."' AND acp.aus_assign_status='1' "; 
	$select_ex = mysqli_query($con, $select);
	$countTotalFeePaid = mysqli_num_rows($select_ex);

	// application submited
	$select = "SELECT aus_client_pro_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id=cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_program_assign='".$checkwtID."'  AND acp.aus_assign_status='1' "; 
	$select_ex = mysqli_query($con, $select);
	$countTotalApplicationSubmited = mysqli_num_rows($select_ex);

	// Client Proof
	$select = "SELECT aus_client_pro_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id=cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_program_assign='".$checkwtID."' AND acp.aus_assign_status='1' "; 
	$select_ex = mysqli_query($con, $select);
	$countTotalClientsProof = mysqli_num_rows($select_ex);

	// inform to processing team
	$select = "SELECT aus_client_pro_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id=cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_program_assign='".$checkwtID."' AND acp.aus_assign_status='1' "; 
	$select_ex = mysqli_query($con, $select);
	$countTotalInformTeamBergamoFee = mysqli_num_rows($select_ex);

	// enrollment pay fee bergemo
	$select = "SELECT aus_client_pro_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id=cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_program_assign='".$checkwtID."' AND acp.aus_assign_status='1' "; 
	$select_ex = mysqli_query($con, $select);
	$countTotalBergamoFee = mysqli_num_rows($select_ex);

	// waiting
	$select = "SELECT aus_client_pro_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id=cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_program_assign='".$checkwtID."' AND acp.aus_assign_status='1' "; 
	$select_ex = mysqli_query($con, $select);
	$countTotalWaiting = mysqli_num_rows($select_ex);

	// Acceptance
	$select = "SELECT aus_client_pro_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id=cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_program_assign='".$checkwtID."' AND (acp.aus_direct_program1_status='Acceptance' || acp.aus_direct_program2_status='Acceptance' ) AND acp.aus_assign_status='1' "; 
	$select_ex = mysqli_query($con, $select);
	$countTotalAcceptance = mysqli_num_rows($select_ex);

	// Rejection
	$select = "SELECT aus_client_pro_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id=cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_program_assign='".$checkwtID."' AND (acp.aus_direct_program1_status='Rejection' || acp.aus_direct_program2_status='Rejection' ) AND acp.aus_assign_status='1' "; 
	$select_ex = mysqli_query($con, $select);
	$countTotalRejection = mysqli_num_rows($select_ex);

	// program pening 
	$select = "SELECT aus_client_pro_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id=cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_program_assign='".$checkwtID."' AND acp.aus_assign_status='1' AND acp.aus_program_status='1' "; 
	$select_ex = mysqli_query($con, $select);
	$countTotalProgramPending = mysqli_num_rows($select_ex);

	// total Pending Resolve Query
	$select = "SELECT aus_client_pro_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id=cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_program_assign='".$checkwtID."' AND acp.aus_assign_status='1' AND acp.aus_program_status='2' "; 
	$select_ex = mysqli_query($con, $select);
	$countTotalPendingResolves = mysqli_num_rows($select_ex);

	// Additional Activities Required by University Clients assign to Processing team
	$select = "SELECT client_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id=cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_additional_activities_status='1' AND acp.aus_program_assign='".$checkwtID."' GROUP BY cl.client_id "; 
	$select_ex = mysqli_query($con, $select);
	$countTotalAdditionalActivitiesAssign = mysqli_num_rows($select_ex);

	// Additional Activities Required by University Clients Complete by Processing team
	$select = "SELECT client_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id=cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_additional_activities_status='2' AND acp.aus_program_assign='".$checkwtID."' GROUP BY cl.client_id "; 
	$select_ex = mysqli_query($con, $select);
	$countTotalAdditionalActivitiesComplete = mysqli_num_rows($select_ex);
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
	<div class="row">
		<div class="col-xl-6">
			<h4>My Admission Task</h4>
			<div class="row">
				<div class="col-xl-12 col-sm-6">
					<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
						<div class="media">
							<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="My pending Report Resolves by Admission Head">
								<a href="">
									<p class="m-0 font-weight-medium text-truncate text-info">My Pending Report Resolves by Admission Head</p>
									<h3 class="font-weight-bold my-2 text-info"><span data-plugin="counterup"><?php echo number_format($countTotalPendingResolves); ?></span></h3>
								</a>
							</div>
							<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
								<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-info"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-12 col-sm-6">
					<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
						<div class="media">
							<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="Inform the Head to Recheck the Application By Client">
								<a href="">
									<p class="m-0 font-weight-medium text-truncate text-info">Inform the Head to Recheck the Application By Client</p>
									<h3 class="font-weight-bold my-2 text-info"><span data-plugin="counterup"><?php echo number_format($countTotalinformToClient); ?></span></h3>
								</a>
							</div>
							<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
								<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-info"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-12 col-sm-6">
					<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
						<div class="media">
							<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="Applications Sent to the Head for Rechecking By Clients">
								<a href="">
									<p class="m-0 font-weight-medium text-truncate text-info">Applications Sent to the Head for Rechecking By Clients</p>
									<h3 class="font-weight-bold my-2 text-info"><span data-plugin="counterup"><?php echo number_format($countTotalinformedToClient); ?></span></h3>
								</a>
							</div>
							<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
								<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-info"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-12 col-sm-6">
					<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
						<div class="media">
							<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="Client Requests to Head, Changes in the Application">
								<a href="">
									<p class="m-0 font-weight-medium text-truncate text-info">Client Requests to Head, Changes in the Application</p>
									<h3 class="font-weight-bold my-2 text-info"><span data-plugin="counterup"><?php echo number_format($countTotalChangeRequired); ?></span></h3>
								</a>
							</div>
							<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
								<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-info"></i>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-12 col-sm-6">
					<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
						<div class="media">
							<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="Changes Complete, And Sent to Admission Head">
								<a href="">
									<p class="m-0 font-weight-medium text-truncate text-info">Changes Complete, And Sent to Admission Head</p>
									<h3 class="font-weight-bold my-2 text-info"><span data-plugin="counterup"><?php echo number_format($countTotalChangeUpdated); ?></span></h3>
								</a>
							</div>
							<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
								<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-info"></i>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-12 col-sm-6">
					<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
						<div class="media">
							<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="Client Informed, How to Pay the Application Fee By Admission Head">
								<a href="">
									<p class="m-0 font-weight-medium text-truncate text-info">Client Informed, How to Pay the Application Fee By Admission Head</p>
									<h3 class="font-weight-bold my-2 text-info"><span data-plugin="counterup"><?php echo number_format($countTotalInformPayfee); ?></span></h3>
								</a>
							</div>
							<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
								<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-info"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-12 col-sm-6">
					<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
						<div class="media">
							<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="Application Approved And Fee Paid by Client, Now Submit the Application">
								<a href="">
									<p class="m-0 font-weight-medium text-truncate text-info">Application Approved And Fee Paid by Client, Now Submit the Application</p>
									<h3 class="font-weight-bold my-2 text-info"><span data-plugin="counterup"><?php echo number_format($countTotalFeePaid); ?></span></h3>
								</a>
							</div>
							<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
								<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-info"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-12 col-sm-6">
					<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
						<div class="media">
							<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="Admission Application Submitted by Processing Team">
								<a href="">
									<p class="m-0 font-weight-medium text-truncate text-info">Admission Application Submitted by Processing Team</p>
									<h3 class="font-weight-bold my-2 text-info"><span data-plugin="counterup"><?php echo number_format($countTotalApplicationSubmited); ?></span></h3>
								</a>
							</div>
							<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
								<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-info"></i>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-12 col-sm-6">
					<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
						<div class="media">
							<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="Sent Admission Applied Proof to Clients By Admission Head">
								<a href="">
									<p class="m-0 font-weight-medium text-truncate text-info">Sent Admission Applied Proof to Client By Admission Head</p>
									<h3 class="font-weight-bold my-2 text-info"><span data-plugin="counterup"><?php echo number_format($countTotalClientsProof); ?></span></h3>
								</a>
							</div>
							<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
								<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-info"></i>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-12 col-sm-6">
					<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
						<div class="media">
							<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="Additional Activities Required by University Clients Assign by Admission Head">
								<a href="">
									<p class="m-0 font-weight-medium text-truncate text-info">Additional Activities Required by University Clients Assign by Admission Head</p>
									<h3 class="font-weight-bold my-2 text-info"><span data-plugin="counterup"><?php echo number_format($countTotalAdditionalActivitiesAssign); ?></span></h3>
								</a>
							</div>
							<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
								<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-info"></i>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-12 col-sm-6">
					<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
						<div class="media">
							<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="Additional Activities Required by University Task Complete by Processing Team">
								<a href="">
									<p class="m-0 font-weight-medium text-truncate text-info">Additional Activities Required by University Task Complete by Processing Team</p>
									<h3 class="font-weight-bold my-2 text-info"><span data-plugin="counterup"><?php echo number_format($countTotalAdditionalActivitiesComplete); ?></span></h3>
								</a>
							</div>
							<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
								<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-info"></i>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<div class="col-xl-6" style="border-left: 2px solid black;">
			<h4> Task</h4>
			<div class="row">
				<div class="col-xl-12 col-sm-6">
					<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
						<div class="media">
							<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="New Assign But Not Applied Programs">
								<a href="all-clients?applied-programs=New+Assign+But+Not+Applied+Programs">
									<p class="m-0 font-weight-medium text-truncate text-warning">New Assign But Not Applied Programs</p>
									<h3 class="font-weight-bold my-2 text-warning"><span data-plugin="counterup"><?php echo number_format($countTotalNewAssignNotApplied); ?></span></h3>
								</a>
							</div>
							<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
								<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-warning"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-12 col-sm-6">
					<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
						<div class="media">
							<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="My Pending Programs Report">
								<a href="all-clients?applied-programs=My+Pending+Programs+Report">
									<p class="m-0 font-weight-medium text-truncate text-warning">My Pending Programs Report for Admission Head</p>
									<h3 class="font-weight-bold my-2 text-warning"><span data-plugin="counterup"><?php echo number_format($countTotalProgramPending); ?></span></h3>
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
		<!-- show other filter divs -->
		<div class="col-xl-12">
			<h4>Filters</h4>
			<div class="row">
				<div class="col-xl-4 col-sm-6">
					<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
						<div class="media">
							<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="Overall Assign Programs">
								<a href="">
									<p class="m-0 font-weight-medium text-truncate text-warning">All Assign Programs</p>
									<h3 class="font-weight-bold my-2 text-warning"><span data-plugin="counterup"><?php echo number_format($countTotalAssign); ?></span></h3>
								</a>
							</div>
							<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
								<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-warning"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-sm-6">
					<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
						<div class="media">
							<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="All Applied Programs">
								<a href="">
									<p class="m-0 font-weight-medium text-truncate text-warning">All Applied Programs</p>
									<h3 class="font-weight-bold my-2 text-warning"><span data-plugin="counterup"><?php echo number_format($countTotalApplied); ?></span></h3>
								</a>
							</div>
							<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
								<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-warning"></i>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-4 col-sm-6">
					<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
						<div class="media">
							<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="waiting for Admission decision">
								<a href="">
									<p class="m-0 font-weight-medium text-truncate text-warning">Waiting for Admission decision</p>
									<h3 class="font-weight-bold my-2 text-warning"><span data-plugin="counterup"><?php echo number_format($countTotalWaiting); ?></span></h3>
								</a>
							</div>
							<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
								<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-warning"></i>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-4 col-sm-6">
					<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
						<div class="media">
							<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="Acceptance Letter Received Clients">
								<a href="">
									<p class="m-0 font-weight-medium text-truncate text-warning">Acceptance Letter Received Clients</p>
									<h3 class="font-weight-bold my-2 text-warning"><span data-plugin="counterup"><?php echo number_format($countTotalAcceptance); ?></span></h3>
								</a>
							</div>
							<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
								<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-warning"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-sm-6">
					<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
						<div class="media">
							<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="University Admission Rejected Clients">
								<a href="">
									<p class="m-0 font-weight-medium text-truncate text-warning">University Admission Rejected Clients</p>
									<h3 class="font-weight-bold my-2 text-warning"><span data-plugin="counterup"><?php echo number_format($countTotalRejection); ?></span></h3>
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
	<script type="text/javascript">
		$(document).ready(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
	<?php
}
?>