<?php
		
		session_start();
		include('../db/db_config.php');
		include('../functions/functions.php');

		$customer_id = $_SESSION['customer_id'];
		$customer_account_number = $_SESSION['account_number'];
		$customer_name = $_SESSION['customer_name'];

		$select = mysqli_query($db, "SELECT * FROM transaction
									WHERE customer_id = '".$customer_id."'")
				or die(mysqli_error($db));

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
			echo "<hr/>";

		?>

		<hr/>
		<a href="home.php">Home</a>
		<a href="transactions.php">Funds Transfer</a>
		<a href="view_statement.php">View Statement of Account</a>
		<a href="change_password.php">Change Password</a>
		<a href="logout.php">Click to Logout</a>
		<hr/>

		<table border="1">

			<tr>
				<th>Transaction Date</th>
				<th>Transaction Type</th>
				<th>Sender</th>
				<th>Receiver</th>
				<th>Previous Balance</th>
				<th>Transaction Amount</th>
				<th>New Balance</th>
			</tr>
			<tr>

			<?php while($result = mysqli_fetch_array($select)) { ?>

			<td><?php echo $result[1] ?></td>
			<td><?php echo $result[2] ?></td>
			<td><?php echo $result[3] ?></td>
			<td><?php echo $result[4] ?></td>
			<td><?php echo $result[5] ?></td>
			<td><?php echo $result[6] ?></td>
			<td><?php echo $result[7] ?></td>
			</tr>
			<?php } ?> 

		</table>

<?php echo "<p>Number of Transactions: <strong>".mysqli_num_rows($select)."</strong></p>" ?>





</body>
</html>