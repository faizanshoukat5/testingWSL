<?php 
	$uniName = $_POST['checkuniName'];
	$clientDegree = $_POST['checkclientDegree'];
	$clientStatus = $_POST['checkconvertStatus'];
	$clientCountry = $_POST['checkclientCountry'];
	$admissionDue = $_POST['checkadmissionDue'];
	$assignPrograms = $_POST['checkassignPrograms'];
	$intakeYear = $_POST['checkintakeYear'];
	$deadlineStatus = $_POST['checkdeadlineStatus'];
	$sopStatus = $_POST['checksopStatus'];
	$startStatus = $_POST['checkstartDate'];
	$endStatus = $_POST['checkendDate'];
	$ieltsStatus = $_POST['checkieltsStatus'];
	$assignDate = $_POST['checkassignDate'];
	$cvStatus = $_POST['checkcvStatus'];

	$checkApplication = $_POST['checkapplicationStatus'];
	$visaProcess = $_POST['checkvisaProcess'];
	$preProcess = $_POST['checkpreProcess'];
	$CEnTSProcess = $_POST['checkCEnTSProcess'];
	$assignAgent = $_POST['checkassignAgent'];

	$clientDetails = $_POST['checkclientDetails'];
	$page = $_POST['pageNumber'];
	$limit = $_POST['checkselectPage'];
	$offset = ($page - 1) * $limit;
	$degbachmaster='';
	$degbachMBBS='';
	if ($clientDegree=='master') {
		$degInfo = '["master"]';
		$degbachmaster = '["bachelor","master"]';
	}elseif ($clientDegree=='bachelor') {
		$degInfo = '["bachelor"]';
		$degbachmaster = '["bachelor","master"]';
	}elseif ($clientDegree=='mbbs') {
		$degInfo = '["mbbs"]';
		$degbachmaster = '["master","mbbs"]';
		$degbachMBBS = '["bachelor","mbbs"]';
	}
	elseif ($clientDegree=='phd') {
		$degInfo = '["phd"]';
	}
?>