<?php
		
		session_start();
		unset($_SESSION['administrator_id']);
		unset($_SESSION['administrator_name']);
		$_SESSION['administrator_id'] = "";
		$_SESSION['administrator_name'] = "";

		header("location:admin_login.php");

		
?>