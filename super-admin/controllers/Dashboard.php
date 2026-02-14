<?php 
$user_email = $_SESSION['user_email'];
$user_designation = $_SESSION['user_designation'];
$user_id = $_SESSION['user_id'];
$current_date =  date('Y-m-d');
$current_time =  date('H:i:s');
$current_month =  date('m-Y');

$fetch = "SELECT * FROM wt_users WHERE email = '".$user_email."'";
$execuit = mysqli_query($con,$fetch);

$query = "SELECT 
	SUM(CASE WHEN client_country='austria' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countAustria,
	SUM(CASE WHEN client_country='france' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countFrance,
	SUM(CASE WHEN client_country='italy' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countItaly,
	SUM(CASE WHEN client_country='canada' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countCanada,
	SUM(CASE WHEN client_country='USA' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countUSA,
	SUM(CASE WHEN client_country='czech republic' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countCzechRepublic,
	SUM(CASE WHEN client_country='IELTS enrollment' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countIELTSEnrollment,
	SUM(CASE WHEN client_country='austria' AND client_countryfrom='Pakistan' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countPakAustria,
	SUM(CASE WHEN client_country='france' AND client_countryfrom='Pakistan' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countPakFrance,
	SUM(CASE WHEN client_country='italy' AND client_countryfrom='Pakistan' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countPakItaly,
	SUM(CASE WHEN client_country='canada' AND client_countryfrom='Pakistan' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countPakCanada,
	SUM(CASE WHEN client_country='USA' AND client_countryfrom='Pakistan' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countPakUSA,
	SUM(CASE WHEN client_country='czech republic' AND client_countryfrom='Pakistan' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countPakCzechRepublic,
	SUM(CASE WHEN client_country='IELTS enrollment' AND client_countryfrom='Pakistan' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countPakIELTS,
	SUM(CASE WHEN client_country='austria' AND client_countryfrom='UAE' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countUAEAustria,
	SUM(CASE WHEN client_country='france' AND client_countryfrom='UAE' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countUAEFrance,
	SUM(CASE WHEN client_country='italy' AND client_countryfrom='UAE' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countUAEItaly,
	SUM(CASE WHEN client_country='canada' AND client_countryfrom='UAE' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countUAECanada,
	SUM(CASE WHEN client_country='USA' AND client_countryfrom='UAE' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countUAEUSA,
	SUM(CASE WHEN client_country='czech republic' AND client_countryfrom='UAE' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countUAECzechRepublic,
	SUM(CASE WHEN client_country='IELTS enrollment' AND client_countryfrom='UAE' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countUAEIELTS,
	SUM(CASE WHEN client_pay_confirm_status='1' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countpayConfirm,
	SUM(CASE WHEN client_pay_confirm_status='0' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countpayNotConfirm,
	SUM(CASE WHEN client_pro_confirm_status='1' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countprogramConfirm,
	SUM(CASE WHEN client_pro_confirm_status='0' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countprogramNotConfirm,
	SUM(CASE WHEN ack_confirm_status='1' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countAckConfirm,
	SUM(CASE WHEN ack_confirm_status='0' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countAckNotConfirm,
	SUM(CASE WHEN client_document_status='1' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countDocumentConfirm,
	SUM(CASE WHEN client_document_status='0' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countDocumentNotConfirm,
	SUM(CASE WHEN client_case_status='cash case' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countCashCase,
	SUM(CASE WHEN client_case_status='online case' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countOnlineCase,
	SUM(CASE WHEN client_convert_status='New Client' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countNewClients,
	SUM(CASE WHEN client_convert_status='Old Client' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countOldClients,
	SUM(CASE WHEN client_convert_status='Old Converted Client' AND case_status='0' AND change_status='0' THEN 1 ELSE 0 END) AS countConvertedClients,
	SUM(CASE WHEN case_status='1' AND change_status='0' THEN 1 ELSE 0 END) AS countwithDrawClients,
	SUM(CASE WHEN case_status='2' AND change_status='0' THEN 1 ELSE 0 END) AS countRefundClients,
	SUM(CASE WHEN case_status='3' AND change_status='0' THEN 1 ELSE 0 END) AS countOnHoldClients,
	SUM(CASE WHEN change_status='1' THEN 1 ELSE 0 END) AS countChangeCountryClients
	
	FROM clients".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND admin_status='1' ";
$result =mysqli_query($con, $query);
$row =mysqli_fetch_assoc($result);

$countAustria = $row['countAustria'];
$countFrance = $row['countFrance'];
$countItaly = $row['countItaly'];
$countCanada = $row['countCanada'];
$countUSA = $row['countUSA'];
$countCzechRepublic = $row['countCzechRepublic'];
$countIELTSEnrollment = $row['countIELTSEnrollment'];
$countPakAustria = $row['countPakAustria'];
$countPakFrance = $row['countPakFrance'];
$countPakItaly = $row['countPakItaly'];
$countPakCanada = $row['countPakCanada'];
$countPakUSA = $row['countPakUSA'];
$countPakCzechRepublic = $row['countPakCzechRepublic'];
$countPakIELTS = $row['countPakIELTS'];
$countUAEAustria = $row['countUAEAustria'];
$countUAEFrance = $row['countUAEFrance'];
$countUAEItaly = $row['countUAEItaly'];
$countUAECanada = $row['countUAECanada'];
$countUAEUSA = $row['countUAEUSA'];
$countUAECzechRepublic = $row['countUAECzechRepublic'];
$countUAEIELTS = $row['countUAEIELTS'];
$countpayConfirm = $row['countpayConfirm'];
$countpayNotConfirm = $row['countpayNotConfirm'];
$countprogramConfirm = $row['countprogramConfirm'];
$countprogramNotConfirm = $row['countprogramNotConfirm'];
$countAckConfirm = $row['countAckConfirm'];
$countAckNotConfirm = $row['countAckNotConfirm'];
$countDocumentConfirm = $row['countDocumentConfirm'];
$countDocumentNotConfirm = $row['countDocumentNotConfirm'];
$countCashCase = $row['countCashCase'];
$countOnlineCase = $row['countOnlineCase'];
$countNewClients = $row['countNewClients'];
$countOldClients = $row['countOldClients'];
$countConvertedClients = $row['countConvertedClients'];
$countwithDrawClients = $row['countwithDrawClients'];
$countRefundClients = $row['countRefundClients'];
$countOnHoldClients = $row['countOnHoldClients'];
$countChangeCountryClients = $row['countChangeCountryClients'];

?>