<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!-- Important to make website responsive -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Restaurant Website</title>
	<!-- Linking our css file -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<!-- Navbar section starts here -->
	<section class="navbar">
		<div class="container">
			<div class="logo">
				<img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
			</div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>

			<div class="clearfix"></div>
		</div>
	</section>
	<!-- Navbar section ends here -->