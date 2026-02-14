<?php
include_once '../env/main-config.php';


if (isset($_POST['signIN'])) {
	ob_start();
	session_start();
	$userName = $_POST['userName'];
	$password = $_POST['password'];

	$final_pass = md5($password);
	$log_sql = "SELECT * FROM wt_users WHERE (user_name='" . $userName . "' || email='" . $userName . "') AND password = '" . $final_pass . "' AND close='1' AND status='1' AND active_status='1' ";
	$log_sql_ex = mysqli_query($con, $log_sql);

	if (mysqli_num_rows($log_sql_ex) == '1') {
		foreach ($log_sql_ex as $row) {
			$_SESSION['final_pass'] = $row['password'];
			setcookie('final_pass', $row['password'], time() + (60 * 60 * 24 * 30), '/', '', true, true);

			$_SESSION['user_id'] = $row['wt_id'];
			setcookie('user_id', $row['wt_id'], time() + (60 * 60 * 24 * 30), '/', '', true, true);

			$_SESSION['user_name'] = $row['user_name'];
			setcookie('user_name', $row['user_name'], time() + (60 * 60 * 24 * 30), '/', '', true, true);

			$_SESSION['user_email'] = $row['email'];
			setcookie('user_email', $row['email'], time() + (60 * 60 * 24 * 30), '/', '', true, true);

			$_SESSION['user_type'] = $row['type'];
			setcookie('user_type', $row['type'], time() + (60 * 60 * 24 * 30), '/', '', true, true);

			$_SESSION['uname'] = $row['fname'] . " " . $row['lname'];
			setcookie('uname', $_SESSION['uname'], time() + (60 * 60 * 24 * 30), '/', '', true, true);

			$_SESSION['phone'] = $row['phone'];
			setcookie('phone', $row['phone'], time() + (60 * 60 * 24 * 30), '/', '', true, true);

			$_SESSION['user_designation'] = $row['designation'];
			setcookie('user_designation', $row['designation'], time() + (60 * 60 * 24 * 30), '/', '', true, true);

			$_SESSION['user_image'] = $row['user_image'];
			setcookie('user_image', $row['user_image'], time() + (60 * 60 * 24 * 30), '/', '', true, true);
		}

		$select_session = "SELECT * FROM session_active WHERE active_user_id = '" . $_SESSION['user_id'] . "'";
		$select_session_ex = mysqli_query($con, $select_session);
		foreach ($select_session_ex as $session_value) {
			$_SESSION['dbNo'] = $session_value['active_session_id'];
			setcookie('dbNo', $_SESSION['dbNo'], time() + (60 * 60 * 24 * 30), '/');

			$_SESSION['s_date'] = $session_value['s_date'];
			setcookie('s_date', $_SESSION['s_date'], time() + (60 * 60 * 24 * 30), '/');
			$_SESSION['e_date'] = $session_value['e_date'];
			setcookie('e_date', $_SESSION['e_date'], time() + (60 * 60 * 24 * 30), '/');
		}

		if ($_SESSION['user_type'] == 'admin') {
			header('Location: ../super-admin/dashboard');
		} elseif ($_SESSION['user_type'] == 'sale department') {
			header('Location: ../sale-department/dashboard');
		} elseif ($_SESSION['user_type'] == 'team leader') {
			header('Location: ../team-leader/dashboard');
		} elseif ($_SESSION['user_type'] == 'team manager') {
			header('Location: ../team-manager/dashboard');
		} elseif ($_SESSION['user_type'] == 'accountant') {
			header('Location: ../accountant/dashboard');
		} elseif ($_SESSION['user_type'] == 'documents collections' || $_SESSION['user_type'] == 'documents collections france') {
			header('Location: ../documents-collections/dashboard');
		} elseif ($_SESSION['user_type'] == 'documents collections team') {
			header('Location: ../documents-collections-team/dashboard');
		}

		// Austria portal
		elseif ($_SESSION['user_type'] == 'austria admission head') {
			header('Location: ../austria-admission-head/dashboard');
		} elseif ($_SESSION['user_type'] == 'austria admission team') {
			header('Location: ../austria-admission-team/dashboard');
		} elseif ($_SESSION['user_type'] == 'austria visa team') {
			header('Location: ../austria-visa-team/dashboard');
		} elseif ($_SESSION['user_type'] == 'austria university sop') {
			header('Location: ../university-sop-team/dashboard');
		}

		// italy portal
		elseif ($_SESSION['user_type'] == 'italy admission head') {
			header('Location: ../italy-admission-head/admission-dashboard');
		} elseif ($_SESSION['user_type'] == 'italy admission team') {
			header('Location: ../italy-admission-team/dashboard');
		} elseif ($_SESSION['user_type'] == 'italy visa team') {
			header('Location: ../italy-visa-team/dashboard');
		} elseif ($_SESSION['user_type'] == 'italy university sop') {
			header('Location: ../university-sop-team/dashboard');
		}

		// Czech Republic portal
		elseif ($_SESSION['user_type'] == 'czech republic admission head') {
			header('Location: ../czech-republic-admission-head/admission-dashboard');
		} elseif ($_SESSION['user_type'] == 'czech republic admission team') {
			header('Location: ../czech-republic-admission-team/dashboard');
		} elseif ($_SESSION['user_type'] == 'czech republic visa team') {
			header('Location: ../czech-republic-visa-team/dashboard');
		} elseif ($_SESSION['user_type'] == 'czech republic university sop') {
			header('Location: ../university-sop-team/dashboard');
		}

		// france Republic portal
		elseif ($_SESSION['user_type'] == 'france admission head') {
			header('Location: ../france-admission-head/admission-dashboard');
		} elseif ($_SESSION['user_type'] == 'france admission team') {
			header('Location: ../france-admission-team/dashboard');
		} elseif ($_SESSION['user_type'] == 'france university sop') {
			header('Location: ../university-sop-team/dashboard');
		}
		// Canada country
		elseif ($_SESSION['user_type'] == 'canada admission head') {
			header('Location: ../canada-admission-head/dashboard');
		}
		// IELTS Enrollment
		elseif ($_SESSION['user_type'] == 'IELTS Enrollment') {
			header('Location: ../ielts-enrollment/dashboard');
		}
		// data collection
		elseif ($_SESSION['user_type'] == 'Data Collections') {
			header('Location: ../data-collections/dashboard');
		}
		// Call Canter
		elseif ($_SESSION['user_type'] == 'Call Center') {
			header('Location: ../call-center/dashboard');
		}
		// Call Canter head
		elseif ($_SESSION['user_type'] == 'Call Center Head') {
			header('Location: ../call-center-head/dashboard');
		}
	} else {
		header('Location: ../login?wrong-username-and-password');
	}
}
