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
	<title>View Customer</title>
</head>
<body>

		<?php 

			echo "<p>Current Admin: <strong>$admin_name</strong></p>";
		?>

		<hr/>

		<a href="admin_home.php">Home</a>
		<a href="add_customer.php">Add Customers</a>
		<a href="view_customer.php">View Customers</a>
		<a href="logout.php">Click to Logout</a>
		<hr/>

		<?php $select = mysqli_query($db, "SELECT * FROM customer") or die (mysqli_error($db)) ?>

		<table border="1">

			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Gender</th>
				<th>Account Type</th>
				<th>Opening Balance</th>
				<th>Current Balance</th>
				<th>Account Number</th>
				<th>Password</th>
			</tr>

			<tr>
				<?php while($result = mysqli_fetch_array($select)) {?>

				<td><?php echo $result[1].' '.$result[2] ?></td>
				<td><?php echo $result[3] ?></td>
				<td><?php echo $result[4] ?></td>
				<td><?php echo $result[5] ?></td>
				<td><?php echo $result[6] ?></td>
				<td><?php echo $result[7] ?></td>
				<td><?php echo $result[8] ?></td>
				<td><?php echo $result[9] ?></td>


			</tr>
		   <?php }?>

		</table>

		<?php echo "<p>Number of Rows: <strong>".mysqli_num_rows($select)."</strong></p>" ?>


</body>
</html>