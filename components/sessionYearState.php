<?php
ob_start();
session_start();
include_once("../env/main-config.php");

// session
if (isset($_POST['intakeYear'])) {
	echo $intYearID = $_POST['intakeYear'];
	$active = 1;
	$updQuery = "SELECT start_date, end_date FROM session_year WHERE sy_id='".$intYearID."'";
	$updQuery_ex = mysqli_query($con,$updQuery);
	foreach ($updQuery_ex as $row) {
		$start_date = $row['start_date'];
		$end_date = $row['end_date'];
	}

	$delQuery = "DELETE FROM session_active WHERE active_user_id='".$_SESSION['user_id']."' ";
	$delQuery_ex = mysqli_query($con,$delQuery);
	if ($delQuery_ex) {
		$addQuery = "INSERT INTO session_active (active_session_id, active_user_id, s_date, e_date, close, status) VALUES ('".$intYearID."', '".$_SESSION['user_id']."', '".$start_date."', '".$end_date."', '1', '1')";
		$addQuery_ex = mysqli_query($con,$addQuery);
	}
	if($addQuery_ex){
		
		$select_query = "SELECT * FROM wt_users WHERE status='1' AND close='1' AND wt_id='".$_SESSION['user_id']."'";
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
				}elseif ($_SESSION['user_type'] == 'team manager') {
					$response['redirect'] = '../team-manager/dashboard';
				} elseif ($_SESSION['user_type'] == 'accountant') {
					$response['redirect'] = '../accountant/dashboard';
				} elseif ($_SESSION['user_type'] == 'documents collections') {
					$response['redirect'] = '../documents-collections/dashboard';
				}
				// Austria Country 
				elseif ($_SESSION['user_type'] == 'austria admission head') {
					$response['redirect'] = '../austria-admission-head/dashboard';
				} elseif ($_SESSION['user_type'] == 'austria admission team') {
					$response['redirect'] = '../austria-admission-team/dashboard';
				} elseif ($_SESSION['user_type'] == 'austria visa team') {
					$response['redirect'] = '../austria-visa-team/dashboard';
				} elseif ($_SESSION['user_type'] == 'austria university sop') {
					$response['redirect'] = '../austria-university-sop/dashboard';
				} 
				// italy country
				elseif ($_SESSION['user_type'] == 'italy admission head') {
					$response['redirect'] = '../italy-admission-head/admission-dashboard';
				} elseif ($_SESSION['user_type'] == 'italy admission team') {
					$response['redirect'] = '../italy-admission-team/dashboard';
				} elseif ($_SESSION['user_type'] == 'italy visa team') {
					$response['redirect'] = '../italy-visa-team/dashboard';
				} elseif ($_SESSION['user_type'] == 'italy university sop') {
					$response['redirect'] = '../italy-university-sop/dashboard';
				}
				// czech republic country
				elseif ($_SESSION['user_type'] == 'czech republic admission head') {
					$response['redirect'] = '../czech-republic-admission-head/admission-dashboard';
				} elseif ($_SESSION['user_type'] == 'czech republic admission team') {
					$response['redirect'] = '../czech-republic-admission-team/dashboard';
				} elseif ($_SESSION['user_type'] == 'czech republic visa team') {
					$response['redirect'] = '../czech-republic-visa-team/dashboard';
				} elseif ($_SESSION['user_type'] == 'czech republic university sop') {
					$response['redirect'] = '../czech-republic-university-sop/dashboard';
				}
				elseif ($_SESSION['user_type'] == 'IELTS Enrollment') {
					$response['redirect'] = '../ielts-enrollment/dashboard';
				}

				echo json_encode($response);
			}
		}
	}
	else{
		echo "false";
	}
}

?>