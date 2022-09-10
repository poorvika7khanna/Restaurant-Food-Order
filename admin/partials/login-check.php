<?php
	// Autorization - Access Control
	
	// Check whether the user is logged in or not
	if(!isset($_SESSION['user']))  // if user session not set
	{
		// User is not logged in
		// Redirect to Login page with message
		$_SESSION['no-login-message']="<div class='error text-center'>Please login to access Admin Panel.</div>";
		header('location:'.SITEURL.'admin/login.php');
	}
?>