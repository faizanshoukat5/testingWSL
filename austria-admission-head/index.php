<?php 
session_start();
ob_start();
if(!isset($_GET['page'])){
	$_GET['page']= "dashboard";
}
if(file_exists("controllers/". $_GET['page'].".php")) {
	/* Common Header */
	$head_title = $_GET['page'];
	include_once("../env/main-config.php");
	include_once('models/login.php');
	// include_once('models/queries.php');
	include_once('models/selectFunction.php');
	include_once("common/header.php");
	// incldue Controllers here
	include_once("controllers/". $_GET['page'].".php");
	// incldue views here
	include_once("views/". $_GET['page'].".html.php");
	/* Common Footer */
	include_once("common/footer.php");
}else{
	include_once("../web_views/404_error.html.php");
	die();
}
?>
