<?php
		
		session_start();
		include('../db/db_config.php');
		include('../functions/functions.php');

		$customer_id = $_SESSION['customer_id'];
		$customer_account_number = $_SESSION['account_number'];
		$customer_name = $_SESSION['customer_name'];

		

?>

<!DOCTYPE html>
<html>
<head>
	<title>Code Center Portal</title>
</head>
<body>

		<h3>Welcome to The Code Center Portal</h3>

		<?php
			echo "<p>Customer ID: <strong>".$customer_id."</strong></p>";
			echo "<p>Customer Name: <strong>$customer_name</strong></p>";
			echo "<p>Customer Account Number: <strong>".$customer_account_number."</strong></p>";
			echo "<hr/>";
	
		?>

		<hr/>
		<a href="home.php">Home</a>
		<a href="transactions.php">Funds Transfer</a>
		<a href="view_statement.php">View Statement of Account</a>
		<a href="change_password.php">Change Password</a>
		<a href="logout.php">Click to Logout</a>
		<hr/>

<?php 
		$select = mysqli_query($db, "SELECT account_balance FROM customer
									 WHERE account_number = '".$customer_account_number."'")

				or die (mysqli_error($db));

			$result = mysqli_fetch_array($select);

			$sender_acc_balance = $result['account_balance'];



 ?>

		<h3>Funds Transfer</h3>

		<?php echo "<h3>Account Balance: ".$sender_acc_balance."</h3>" ?>

		<?php

			if(array_key_exists('transfer', $_POST)){

				if(empty($_POST['rec_acc_num']) || empty($_POST['amount']) ) {
					$msg = "Some fields are missing";
					header("Location:transactions.php?msg=$msg");
				} elseif(!is_numeric($_POST['amount'])) { //IF THE AMOUNT IS NOT NUMERIC
					$msg = "Please enter a correct value for amount";
					header("Location:transactions.php?msg=$msg");
				} elseif($_POST['rec_acc_num'] == $customer_account_number) {
					$msg = "Ogbeni, be careful ooo";
					header("Location:transaction_amount.php?msg=$msg");
				} else {

			$recipent_acc_num = mysqli_real_escape_string($db, $_POST['rec_acc_num']);
			$transfer_amount = mysqli_real_escape_string($db, $_POST['amount']);

			//HERE, WE SELECT RECIPENT'S DETAILS FROM THE CUSTOMER TABLE

			$query = mysqli_query($db, "SELECT customer_id, firstName, lastName, account_balance
										FROM customer WHERE account_number = '".$recipent_acc_num."'")
										or die(mysqli_error($db));

			if(mysqli_num_rows($query) == 1){

			$recipent = mysqli_fetch_array($query);

			$recipent_customer_id = $recipent['customer_id'];
			$recipent_name = $recipent['firstName'].' '.$recipent['lastName'];
			$recipent_current_balance = $recipent['account_balance'];

			//HERE WE PERFORM THE MATHEMATICAL TRANSACTION

					if($sender_acc_balance < $transfer_amount) {

						$msg = "Insufficient Funds. Operations Failed";
						header("Location:transactions.php?msg=$msg");
					} else {
						$sender_new_balance = ($sender_acc_balance - $transfer_amount);
						$recipent_new_balance = ($transfer_amount + $recipent_current_balance);

			//WE UPDATE THE SENDER'S ACCOUNT BALANCE

			$sender_update = mysqli_query($db, "UPDATE  customer SET
												account_balance = '".$sender_new_balance."'
												WHERE account_number = '".$customer_account_number."'")
								or die (mysqli_error($db));

			//WE UPDATE THE RECEIVER'S ACCOUNT BALANCE

			$recipent_update = mysqli_query($db, "UPDATE customer SET
										account_balance = '".$recipent_new_balance."'
										WHERE account_number = '".$recipent_acc_num."'")
									or die (mysqli_error($db));

			//WE INSERT FOR SENDER

			$sender_insert = mysqli_query($db, "INSERT INTO transaction
												VALUES(NULL,
												NOW(),
												'debit',
												'self',
												'".$recipent_name."',
												'".$sender_acc_balance."',
												'".$transfer_amount."',
												'".$sender_new_balance."',
											'".$customer_id."')") or die (mysqli_error($db));

			$recipent_insert = mysqli_query($db, "INSERT INTO transaction
												  VALUES(NULL, 
												  NOW(),
												  'credit',
												  '".$customer_name."',
												  'self',
												  '".$recipent_current_balance."',
												  '".$transfer_amount."',
												  '".$recipent_new_balance."',
												  '".$recipent_customer_id."')")
								or die(mysqli_error($db));

					$success = "Transaction Successful";
					header("Location:transactions.php?success=$success");
				}

				} else { //IF IT IS NOT EQUAL TO 1

						$msg = "Operations Failed. Please Try again";
						header("Location:transactions.php?msg=$msg");

				}
			}
			} //END OF MAIN IF

			if(isset($_GET['msg'])){
			echo '<p>'.$_GET['msg'].'</p>';
			}

			if(isset($_GET['success'])){
			echo '<h3><em>'.$_GET['success'].'</em></h3>';
			}

		?>

		<form action="" method="post">
			<p>Enter Recipent Account Number: <input type="text" name="rec_acc_num"/></p>
			<p>Enter Amount to be transfered: <input type="text" name="amount"/></p>

			<input type="submit" name="transfer" value="Click to Transfer"/>
			


		</form>


</body>
</html>