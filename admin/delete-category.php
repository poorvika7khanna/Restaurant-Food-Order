<?php
	include("../config/constants.php");

	// Check whether id ad image_name value is set or not
	if(isset($_GET['id']) AND isset($_GET['image_name']))
	{
		// Get the value and Delete
		$id = $_GET['id'];
		$image_name = $_GET['image_name'];

		// Remove the physical image file
		if($image_name!="")
		{
			// Image is Available, so remove it
			$path='../images/category/'.$image_name;

			// Remove the image
			$remove=unlink($path);

			// If failed to remove the image, add an error message and stop the process
			if($remove==false)
			{
				// Set the Session Message
				$_SESSION['remove']="<div class='error'>Failed to Delete Category Image</div>";

				// Redirect to Manage Category page
				header('location:'.SITEURL.'admin/manage-category.php');

				// Stop the process
				die();
			}
		}

		// Delete Data from Database

		// SQL Query to Delete Data from Database
		$sql="DELETE FROM tbl_category WHERE id=$id";

		// Execute the SQL Query
		$res=mysqli_query($conn,$sql);

		// Check whether the Data is Deleted from Database or not
		if($res==true)
		{
			// Set Success Message and Redirect
			$_SESSION['delete']="<div class='success'>Category Deleted Successfully.</div>";

			// Redirect to Manage Category page
			header('location:'.SITEURL.'admin/manage-category.php');
		}
		else
		{
			// Set Failed Message and Redirect
			$_SESSION['delete']="<div class='error'>Failed to Delete Category.</div>";

			// Redirect to Manage Category page
			header('location:'.SITEURL.'admin/manage-category.php');
		}
	}
	else
	{
		// Redirect to Manage Category page
		header('location:'.SITEURL.'admin/manage-category.php');
	}
?>