<?php

		
		session_start();
		include('../db/db_config.php');
		include('../functions/functions.php'); //TO DUPLICATE FILE CONTENT IN THIS FILE
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
</head>
<body>


	<h1>The Code Center Bank</h1>
	<h3>Welcome!!!</h3>
	<p>Please enter your Admin Name and Password</p>

		<?php 

			if(array_key_exists('login', $_POST))
			{
				$error = array();

				if(empty($_POST['username']))
				{
					$error['uname'] = "Please enter your Username";
				} else {
					$uname = mysqli_real_escape_string($db, $_POST['username']);
				}


				if(empty($_POST['pword']))
				{
					$error['pword'] = "Please enter your password";
				} else {
					$password = md5(mysqli_real_escape_string($db, $_POST['pword']));
				}
				if(empty($error))
				{
			$query = mysqli_query($db, "SELECT * FROM admin
					 WHERE admin_name='".$uname."' AND secured_password='".$password."'") or
					 die(mysqli_error($db));

					 //echo mysqli_num_rows($query);

					 if(mysqli_num_rows($query) == 1) { //WHICH IS WHAT'S IDEAL
					 $result = mysqli_fetch_array($query);

			//BELOW WE ESTABLISH SESSION FOR THE ADMIN LOGGING IN
				$_SESSION['administrator_id'] = $result['admin_id'];
				$_SESSION['administrator_name'] = $result['admin_name'];

				//BELOW WE NOW REDIRECT THE ADMIN INTO THE HOMEPAGE
				header("location:admin_home.php");

					} else {
						$msg = "Invalid Admin Name and or Password";
						header("location:admin_login.php?msg=$msg");
					}


				}
			}

			if(isset($_GET['msg'])) //to make the msg show
			{
				echo "<p>".$_GET['msg']."</p>";
			}

		?>

	<form action="" method="post">
	<p><?php create_text('username') ?></p>

	<p>Password: <input type="password" name="pword"></p>
	<input type="submit" name="login" value="Click to Login"/>
		

	</form>

</body>
</html>