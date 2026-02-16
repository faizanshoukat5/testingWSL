<?php 
	if($_SESSION['user_type'] != "italy admission head" || $_SESSION['uname'] == " "){
		header("Location: ../login");
	}
?>