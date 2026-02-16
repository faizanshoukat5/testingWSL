<?php 
ob_start();
session_start();
if(!isset($_GET['page'])){
	$_GET['page']= "Admission_dashboard";
}
if(file_exists("controllers/". $_GET['page'].".php")) {
	/* Common Header */
	$head_title = $_GET['page'];
	
	include_once("../env/main-config.php");
	include_once('models/login.php');
	// include_once('models/queries.php');
	include_once('models/selectFunction.php');

	include_once("common/header.php");
	/* include Body */
	// incldue Controller here
	include_once("controllers/". $_GET['page'].".php");
	// incldue view here
	include_once("views/". $_GET['page'].".html.php");
	/* Common Footer */
	include_once("common/footer.php");
}else{
	include_once("../web_views/404_error.html.php");
	die();
}
?>