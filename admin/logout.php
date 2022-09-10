<?php
	// 1. Include constants.php
	include('../config/constants.php');

	// 2. Destroy the Session
	session_destroy();

	// 3. Redirect to Login page
	header('location:'.SITEURL.'admin/login.php');
?>