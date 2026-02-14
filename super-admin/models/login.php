<?php 
	if($_SESSION['user_type'] != "admin" || $_SESSION['uname'] == " "){
		header("Location: ../login");
	}
?>