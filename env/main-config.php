<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'testing_wsl';
$tables = '*';

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if ($con == false) {
	echo "Connection Not Established";
} else {
	$company_sql = "SELECT * FROM company_info WHERE status = '1' AND close = '1' ";
	$company_sql_ex = mysqli_query($con, $company_sql);
	foreach ($company_sql_ex as $key) {
		$_SESSION['com_name'] = $key['com_name'];
		$_SESSION['com_phone'] = $key['com_phone'];
		$_SESSION['com_email'] = $key['com_email'];
		$_SESSION['com_logo'] = $key['com_logo'];
		$_SESSION['com_address'] = $key['com_address'];
	}
}

// Ensure session db number is always an integer when available
if (isset($_SESSION['dbNo'])) {
	$_SESSION['dbNo'] = (int) $_SESSION['dbNo'];
} else {
	// default to 0 (useful to avoid accidental string injection in table names)
	$_SESSION['dbNo'] = 0;
}

// expose a local variable for convenience
$dbNo = $_SESSION['dbNo'];