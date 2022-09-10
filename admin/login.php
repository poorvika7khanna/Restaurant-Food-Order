<?php include('../config/constants.php'); ?>

<html>
<head>
	<title>Login - Food Order Website</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
	<body class="login-bg">

		<div class="login">
			<h1 class="text-center">Login</h1>

			<br>
			<?php
				if(isset($_SESSION['login']))
				{
					echo $_SESSION['login'];      //Displaying Session Message
					unset($_SESSION['login']);    // Removing Session Message
				}
				
				if(isset($_SESSION['no-login-message']))
				{
					echo $_SESSION['no-login-message'];      //Displaying Session Message
					unset($_SESSION['no-login-message']);    // Removing Session Message
				}
			?>
			<br>

			<!-- Login Form starts here -->
			<form action="" method="POST" class="text-center">
				Username: <br>
				<input type="text" name="username" placeholder="Enter Username"><br><br>
				Password: <br>
				<input type="password" name="password" placeholder="Enter Password"><br><br>

				<input type="submit" name="submit" value="Login" class="btn-primary">
			</form>
			<!-- Login Form ends here -->

			<br><br>
			
			<p class="text-center">Created By - <a href="#">Poorvika Khanna</a></p>
		</div>

	</body>
</html>

<?php
	// Check whether the Submit button is clicked or not
	if(isset($_POST['submit']))
	{
		// Process for login

		// 1. Get the data from the login form
		$username=$_POST['username'];
		$password=md5($_POST['password']);

		// 2. SQL Query to check whether the user with username and password exists or not
		$sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

		// 3. Execute the Query
		$res=mysqli_query($conn,$sql);

		// 4. Check whether the user exists or not
		$count=mysqli_num_rows($res);

		if($count==1)
		{
			// Login Success
			$_SESSION['login']="<div class='success'>Login Successful.</div>";

			$_SESSION['user']=$username; // To check whether the user is logged in or not and logout will unset it

			// Redirect page to HOME page
			header("location:".SITEURL.'admin/');
		}
		else
		{
			// Login Fail
			$_SESSION['login']="<div class='error text-center' >Username or Password did not match.</div>";

			// Redirect page to login page
			header("location:".SITEURL.'admin/login.php');
		}
	}
?>
