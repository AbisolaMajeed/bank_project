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
	<title>Add Customer</title>
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

		<hr/>

		<h3>Customer Registration Form</h3>
		<p>Please fill the form fields below</p>


				<?php
					if(array_key_exists('add', $_POST))
					{
						$error = array();

						if(empty($_POST['firstname']))
						{
							$error['fname'] = "Enter Customer Firstname";
						} else {
					$fn = mysqli_real_escape_string($db, $_POST['firstname']);
						}
						if(empty($_POST['lastname']))
						{
							$error['lname'] = "Enter Customer Lastname";
						} else {
					$ln = mysqli_real_escape_string($db, $_POST['lastname']);
						}
						if(empty($_POST['email']))
						{
							$error['email'] =  "Enter Customer Email";
						} else {
					$email = mysqli_real_escape_string($db, $_POST['email']);
						}
						if(empty($_POST['sex']))
						{
							$error['sex'] = "Select Customer Gender";
						} else {
					$sex =  mysqli_real_escape_string($db, $_POST['sex']);
						}
						if(empty($_POST['account_type']))
						{
							$error['account_type'] = "Select Account Type";
						} else {
					$account_type = mysqli_real_escape_string($db, $_POST['account_type']);
						}
						if(empty($_POST['opening_balance']))
						{
							$error['o_bal'] = "Enter Opening Balance";
						} elseif(!is_numeric($_POST['opening_balance']))
						{
						$error['o_bal'] = "Value entered for opening balance not acceptable";
						} else {
					$o_balance = mysqli_real_escape_string($db, $_POST['opening_balance']);
						}

						if(empty($_POST['password']))
						{
							$error['pword'] = "Enter Customer Password";
						} else {
					$password = mysqli_real_escape_string($db, $_POST['password']);
						}

				if(empty($error))
				{
					$default = 202;
					$rnd = rand(1111111, 9999999);
					$acc_no = $default.$rnd;

				$insert = mysqli_query($db, "INSERT INTO customer
											 VALUES(NULL,
											 		'".$fn."',
											 		'".$ln."',
											 		'".$email."',
											 		'".$sex."',
											 		'".$account_type."',
											 		'".$o_balance."',
											 		'".$o_balance."',
											 		'".$acc_no."',
											 		'".$password."',
											 		'".$admin_id."'
											)") or die(mysqli_error($db));
						echo "<h3>Customer Succesfully Added</h3>";
						}

					}

				?>


		<form action="" method="post">
			<p><?php create_text('firstname') ?></p>
			<p><?php create_text('lastname') ?></p>
			<p><?php create_text('email') ?></p>
			<p>Gender: <?php
						create_radio('sex', 'male');
						create_radio('sex', 'female');

						?>

			<p>

			<?php $acc_type = array("Savings", "Current", "Fixed", "Domicilliary") ?>
			<p><?php create_select('account type', 'account_type', $acc_type) ?></p>

			<p><?php create_text('opening_balance') ?></p>

			<p><?php create_text('password') ?></p>

			<input type="submit" name="add" value="Click to Add"/>


		</form>



</body>
</html>