<?php
	include '../config/constants.php';

	if(isset($_GET['id']) && isset($_GET['image_name']))
	{
		// Process to Delete

		// 1. Get id and image_name
		$id=$_GET['id'];
		$image_name=$_GET['image_name'];

		// 2. Remove the image if available
		// Check whether the image is available or not and delete only if available
		if($image_name!="")
		{
			// Get the image path
			$path="../images/food/".$image_name;

			// Remove image file from folder
			$remove=unlink($path);

			// Check whether the image is removed or not
			if($remove==false)
			{
				// Failed to remove image
				$_SESSION['upload']="<div class='error'>Failed to Remove Image File.</div>";

				// Redirect to Manage Food
				header('location:'.SITEURL.'admin/manage-food.php');

				// Stop the Process
				die();
			}
		}

		// 3. Delete food from database
		$sql="DELETE FROM tbl_food WHERE id=$id";

		// Executing the Query
		$res=mysqli_query($conn,$sql);

		// Check whether the query executed or not and set the session message accordingly
		// 4. Redirect to Manage Food with Session message
		if($res==true)
		{
			// Food deleted
			$_SESSION['delete']="<div class='success'>Food Deleted Successfully.</div>";
			header('location:'.SITEURL.'admin/manage-food.php');
		}
		else
		{
			// Failed to delete food
			$_SESSION['delete']="<div class='error'>Failed to Delete Food.</div>";
			header('location:'.SITEURL.'admin/manage-food.php');
		}

	}
	else
	{
		// Redirect to Manage Food page
		$_SESSION['unauthorize']="<div class='error'>Unauthorized Access.</div>";
		header('location:'.SITEURL.'admin/manage-food.php');
	}
?>