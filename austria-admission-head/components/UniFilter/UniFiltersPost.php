<?php 
	$uniName = $_POST['checkuniName'];
	$clientDegree = $_POST['checkclientDegree'];
	$clientStatus = $_POST['checkconvertStatus'];
	$clientCountry = $_POST['checkclientCountry'];
	$intakeYear = $_POST['checkintakeYear'];
	$assignPrograms = $_POST['checkassignPrograms'];
	$deadlineStatus = $_POST['checkdeadlineStatus'];
	$sopStatus = $_POST['checksopStatus'];
	$startStatus = $_POST['checkstartDate'];
	$endStatus = $_POST['checkendDate'];
	$admissionDue = $_POST['checkadmissionDue'];
	$assignDate = $_POST['checkassignDate'];
	$cvStatus = $_POST['checkcvStatus'];

	$checkApplication = $_POST['checkapplicationStatus'];
	$assignTo = $_POST['checkassignTo'];

	$clientDetails = $_POST['checkclientDetails'];
	$page = $_POST['pageNumber'];
	$limit = $_POST['checkselectPage'];
	$offset = ($page - 1) * $limit;
	$degbachMBBS='';
	if ($clientDegree=='master') {
		$degInfo = '["master"]';
		$degbachMBBS = '["bachelor","master"]';
	}elseif ($clientDegree=='bachelor') {
		$degInfo = '["bachelor"]';
		$degbachMBBS = '["bachelor","master"]';
	}elseif ($clientDegree=='phd') {
		$degInfo = '["phd"]';
	}
?>