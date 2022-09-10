<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Admin</h1>
		<br>

		<?php
			if(isset($_SESSION['add']))
			{
				echo $_SESSION['add'];      //Displaying Session Message
				unset($_SESSION['add']);    // Removing Session Message
			}
		?>
		
		<br><br>

		<form action="" method="POST">

			<table class="tbl-30">

				<tr>
					<td>Full Name:</td>
					<td>
						<input type="text" name="full_name" placeholder="Enter your name">
					</td>
				</tr>

				<tr>
					<td>Username:</td>
					<td>
						<input type="text" name="username" placeholder="Enter your username">
					</td>
				</tr>

				<tr>
					<td>Password:</td>
					<td>
						<input type="password" name="password" placeholder="Enter your password">
					</td>
				</tr>

				<tr>
					<td colspan="2">                <!-- Spanning 2 columns -->
						<input type="submit" name="submit" value="Add Admin" class="btn-secondary">
					</td>
				</tr>

			</table>
			
		</form>

	</div>
</div>

<?php include('partials/footer.php'); ?>

<?php
	// Process the value from Form and save it in Database
	// Check whether the button is clicked or not
	if(isset($_POST['submit']))
	{
		// Button clicked

		// 1. Get the Data from Form
		$full_name=$_POST['full_name'];
		$username=$_POST['username'];
		$password=md5($_POST['password']);
		

		// 2. SQL Query to save the data into Database
		$sql="INSERT INTO tbl_admin SET
		full_name='$full_name',
		username='$username',
		password='$password'
		";

		// 3. Execute Query and save data in Database
		$res=mysqli_query($conn,$sql) or die(mysqli_error());

		// 4. Check whether the(Query is executed) data is inserted or not and display appropriate message
		if($res==true)
		{
			// Data inserted

			// Create a Session variable to display message
			$_SESSION['add']="<div class='success'>Admin Added Successfully.</div>";

			// Redirect page to manage admin
			header("location:".SITEURL.'admin/manage-admin.php');
		}
		else
		{
			// Failed to insert data

			// Create a Session variable to display message
			$_SESSION['add']="<div class='error'>Failed to Add Admin.</div>";

			// Redirect page to manage admin
			header("location:".SITEURL.'admin/add-admin.php');
		}
	}

?>
