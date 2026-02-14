<?php
	$countryName = $_POST['checkcountryName'];
	$convertStatus = $_POST['checkconvertStatus'];
	$clientCountry = $_POST['checkclientCountry'];
	$clientCase = $_POST['checkclientCase'];
	$clientDegree = $_POST['checkclientDegree'];
	$startDate = $_POST['checkstartDate'];
	$endDate = $_POST['checkendDate'];
	$clientStatus = $_POST['checkclientStatus'];
	$processStatus = $_POST['checkprocessStatus'];
	$intakeYear = $_POST['checkintakeYear'];

	$degbachMBBS='';
	if ($clientDegree=='master') {
		$degInfo = '["master"]';
	}elseif ($clientDegree=='bachelor') {
		$degInfo = '["bachelor"]';
		$degbachMBBS = '["bachelor","mbbs"]';
	}elseif ($clientDegree=='mbbs') {
		$degInfo = '["mbbs"]';
		$degbachMBBS = '["bachelor","mbbs"]';
	}elseif ($clientDegree=='NonSDS') {
		$degInfo = '["NonSDS"]';
	}elseif ($clientDegree=='SDS') {
		$degInfo = '["SDS"]';
	}elseif ($clientDegree=='Canada Business Visit') {
		$degInfo = '["Canada Business Visit"]';
	}elseif ($clientDegree=='Canada Tourist Vist') {
		$degInfo = '["Canada Tourist Vist"]';
	}elseif ($clientDegree=='USA Study Visa') {
		$degInfo = '["USA Study Visa"]';
	}elseif ($clientDegree=='USA Business Visit') {
		$degInfo = '["USA Business Visit"]';
	}elseif ($clientDegree=='USA Tourist Visit') {
		$degInfo = '["USA Tourist Visit"]';
	}elseif ($clientDegree=='USA Business Visit / Tourist Visit (B1 - B2)') {
		$degInfo = '["USA Business Visit / Tourist Visit (B1 - B2)"]';
	}
	$clientDetails = $_POST['checkclientDetails'];
	$page = $_POST['pageNumber'];
	$limit = $_POST['checkselectPage'];
	$offset = ($page - 1) * $limit;
?>