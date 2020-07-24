<?php
		
		session_start();
		include('../db/authentication.php');
		//include('../db/db_config.php');
		include('../functions/functions.php');

		authenticate();

		$admin_id = $_SESSION['administrator_id'];
		$admin_name = $_SESSION['administrator_name'];


?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

		<h1>Welcome!!!</h1>
		<p>You are now Logged In</p>

		<?php 
			echo "<p>Admin ID: <strong>$admin_id</strong><p>";
			echo "<p>Admin Name: <strong>$admin_name</strong></p>"


		?>

		<hr/>

		<a href="admin_home.php">Home</a>
		<a href="add_customer.php">Add Customer</a>
		<a href="view_customer.php">View Customers</a>
		<a href="logout.php">Click to Logout</a>

</body>
</html>