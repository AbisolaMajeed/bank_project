<?php
		
		session_start();
		include('../db/db_config.php');
		include('../functions/functions.php');

		$customer_id = $_SESSION['customer_id'];
		$customer_account_number = $_SESSION['account_number'];
		$customer_name = $_SESSION['customer_name'];

		$select = mysqli_query($db, "SELECT account_balance FROM customer
									 WHERE account_number = '".$customer_account_number."'")

				or die (mysqli_error($db));

?>

<!DOCTYPE html>
<html>
<head>
	<title>Code Center Portal</title>
</head>
<body>

		<h3>Welcome to The Code Center Portal</h3>

		<?php
			echo "<p>Customer Name: <strong>$customer_name</strong></p>";
			echo "<p>Customer Account Number: <strong>".$customer_account_number."</strong></p>";
			echo "<hr/>";

			while($row = mysqli_fetch_array($select))
			{
				echo "<h3>Account Balance: ".$row[0]."</h3>";
			}
		?>

		<hr/>
		<a href="home.php">Home</a>
		<a href="transactions.php">Funds Transfer</a>
		<a href="view_statement.php">View Statement of Account</a>
		<a href="change_password.php">Change Password</a>
		<a href="logout.php">Click to Logout</a>




</body>
</html>