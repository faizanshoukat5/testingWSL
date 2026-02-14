<?php 
	if($_SESSION['user_type'] != "austria admission head" || $_SESSION['uname'] == " "){
		header("Location: ../login");
	}
?>