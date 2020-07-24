<?php
		
		session_start();
		include('../db/db_config.php');
		include('../functions/functions.php');



?>



<!DOCTYPE html>
<html>
<head>
	<title>The Code Center Bank | Customer Login</title>
</head>
<body>

		<h1>TCC Banking Portal</h1>

		<h3>Welcome</h3>
		<p>Please enter your Account Number and Password</p>

			<?php 
				if(isset($_POST['login']))
				{

					$error = array();

					if(empty($_POST['account_number']))
					{
						$error['acc_no'] = "You have not entered your Account Number";
					} else {
						$acc_no = mysqli_real_escape_string($db, $_POST['account_number']);
					} 
					if(empty($_POST['pword']))
					{
						$error['pword'] = "You have not entered your Password";
					} else {
						$pword = mysqli_real_escape_string($db, $_POST['pword']);
					}

					if(empty($error))
					{
				$select = mysqli_query($db, "SELECT * FROM customer
											 WHERE account_number='".$acc_no."' and password = '".$pword."'") or die (mysqli_error($db));
		
				 // echo mysqli_num_rows($select);

						if(mysqli_num_rows($select) ==1)
						{
							$row = mysqli_fetch_array($select);
							$_SESSION['customer_id'] = $row['customer_id'];
							$_SESSION['account_number'] = $row['account_number'];
							$_SESSION['customer_name'] = $row['firstname'].' '.$row['lastname'];

							header("location:home.php");
						} else {
							$msg = "Invalid Account Number and/or Password";
							header("location:index.php?msg=$msg");
						}

					}

				}

				if(isset($_GET['msg']))
			{
				echo "<p>".$_GET['msg']."</p>";
			}
			
			?>

		<form action="" method="post">

			<p><?php create_text('account_number') ?></p>
			<p>Password: <input type="password" name="pword"/></p>

			<input type="submit" name="login" value="Click to Login"/>
			


		</form>

</body>
</html>