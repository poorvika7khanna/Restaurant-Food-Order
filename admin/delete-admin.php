<?php

	include('../config/constants.php');

	// 1. Get the id of Admin to be deleted
	$id=$_GET['id'];

	// 2. Create SQL Query to Delete the Admin
	$sql="DELETE FROM tbl_admin WHERE id=$id";

	// Execute the Query
	$res=mysqli_query($conn,$sql);

	// Check whether the query executed successfully or not
	if($res==true)       // Successfully deleted
	{
		// Create a session variable to display message
		$_SESSION['delete']="<div class='success'>Admin Deleted Successfully.</div>";

		// Redirect to Manage Admin page
		header('location:'.SITEURL.'admin/manage-admin.php');
	}
	else             //Failed to delete
	{
		// Create a session variable to display message
		$_SESSION['delete']="<div class='error'>Failed to Delete Admin. Try again later.</div>";

		// Redirect to Manage Admin page
		header('location:'.SITEURL.'admin/manage-admin.php');
	}

	// 3. Redirect to Manage Admin page with message(success/error)

?>