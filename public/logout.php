<?php

		session_start();
		unset($_SESSION['customer_id']);
		unset($_SESSION['customer_account_number']);
		unset($_SESSION['customer_name']);
		unset($_SESSION['account_number']);
		$_SESSION['customer_id'] = "";
		$_SESSION['customer_account_number'] = "";
		$_SESSION['customer_name'] ="";
		$_SESSION['account_number'] = "";

		header("location:index.php");


?>