<?php

		session_start();
		include('../db/db_config.php');
		include('../functions/functions.php');

		$customer_id = $_SESSION['customer_id'];
		$customer_account_number = $_SESSION['account_number'];
		$customer_name = $_SESSION['customer_name'];

		$select = mysqli_query($db, "SELECT account_number FROM customer
									WHERE customer_id = '".$customer_id."'")
				or die(mysqli_error($db));

?>

<!DOCTYPE html>
<html>
<head>
	<title>Code Center Portal | Change Password</title>
</head>
<body>

		<h3>Change Password</h3>

		<?php
			echo "<p>Customer Name: <strong>$customer_name</strong></p>";
			echo "<p>Customer Account Number: <strong>".$customer_account_number."</strong></p>";
			echo "<hr/>";

		?>


		<?php

		if(isset($_POST['submit']))
		{
				$error = array();
		
				if(empty($_POST['pword']))
				{
					$error['pword'] = "Please enter current password";
				} else{
					$pword = mysqli_real_escape_string($db, $_POST['pword']);
				}
				if(empty($_POST['newPassword']))
				{
					$error['newPassword'] = "Please enter new password";
				} else {
					$newPassword = mysqli_real_escape_string($db, $_POST['newPassword']);
				}
				if(empty($_POST['confirmPassword']))
				{
					$error['confirmPassword'] = "Please confirm Password";
				} else {
					$confirmPassword = mysqli_real_escape_string($db, $_POST['confirmPassword']);
				}

				if(empty($error)){	
									$select = mysqli_query($db, "SELECT * FROM customer
									WHERE customer_id = '".$customer_id."'")
									or die(mysqli_error($db));

								 
					if(mysqli_num_rows($select) ==1){
			 		$row = mysqli_fetch_array($select);

					if ($pword == $row['password'] && $newPassword == $confirmPassword) {
			 		mysqli_query($db, "UPDATE customer SET password = '" .$newPassword."'
			 						   WHERE customer_id = '".$customer_id."'")
									   or die(mysqli_error($db));
									   				}

					 $message = "Password Changed Successfully";
					 } else {
					 	$message = "Password is not correct";
					 }
			
		}
	}
			?>
			<p><?php if(isset($message)) { echo $message;} ?></p>


		<form action="" method="post">

			<p>Current Password: <input type="password" name="pword"/><p>
			<p>New Password: <input type="password" name="newPassword"/></p>
			<p>Confirm Password: <input type="password" name="confirmPassword"/></p>

			<input type="submit" name="submit" value="Change Password"/></p>
			

		</form>


</body>
</html>