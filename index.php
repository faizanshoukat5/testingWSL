<?php 

if(!isset($_GET['page'])){
  	$_GET['page']= "login";
}
if(file_exists("web_views/". $_GET['page'].".html.php")) {
	
	include_once("models/cookies.php");
	include_once("env/main-config.php");
	include_once("common/header.php");

	include_once("web_views/". $_GET['page'].".html.php");
	include_once("common/footer.php");
	
}else{
	include_once("web_views/404_error_web.html.php");
	die();
}

?>