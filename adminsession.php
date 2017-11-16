<?php
	session_start();
	
	function logged_in() {
		return isset($_SESSION['adminid']);
	}
	
	function confirm_logged_in() {
		if (!logged_in()) {
			header("Location: admin_login.php");
			exit;
		}
	}
	
	
	
	
?>

