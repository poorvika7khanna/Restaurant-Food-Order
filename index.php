<?php include('partials-front/menu.php'); ?>

	<!-- food-search section starts here -->
	<section class="food-search text-center">
		<div class="container">
			<form action="<?php echo SITEURL; ?>food-search.php" method="POST">
				<input type="search" name="search" placeholder="Search for Food...">
				<input type="submit" name="submit" value="Search" class="btn btn-primary">
			</form>
		</div>
	</section>
	<!-- food-search section ends here -->

	<?php

		if(isset($_SESSION['order']))
		{
			echo $_SESSION['order'];
			unset($_SESSION['order']);
		}
	?>

	<!-- Categories section starts here -->
	<section class="categories">
		<div class="container">
			<h2 class="text-center text-white">Explore Foods</h2>

			<?php
				// Create SQL Query to display categories
				$sql="SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";

				// Execute the Query
				$res=mysqli_query($conn,$sql);

				// Check whether categories are available or not
				$count=mysqli_num_rows($res);

				if($count>0)
				{
					// Categories availables
					while($row=mysqli_fetch_assoc($res))
					{
						// Get the details
						$id=$row['id'];
						$title=$row['title'];
						$image_name=$row['image_name'];
						?>

						<a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
							<div class="box3 float-container">
								<?php
									// Check whether the image is available or not
									if($image_name=="")
									{
										// Display Message
										echo "<div class='error'>Image Not Available.<div>";
									}
									else
									{
										?>
										<img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" class="img-responsive img-curve">
										<?php
									}
								?>
								
								<h3 class="float-text text-white"><?php echo $title; ?></h3>
							</div>
						</a>

						<?
					}
				}
				else
				{
					// Categories not Available
					echo "<div class='error'>Category Not Added.</div>";
				}
			?>
			<div class="clearfix"></div>
		</div>
	</section>
	<!-- Categories section ends here -->
	<!-- food-menu section starts here -->
	<div class="clearfix"></div>
	<section class="food-menu">
		<div class="container">

			<h2 class="text-center">Food Menu</h2>

			<?php

				// Getting foods from database
				// SQL Query
				$sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

				// Execute the Query
				$res2=mysqli_query($conn,$sql2);

				// Check whether food is available or not
				$count2=mysqli_num_rows($res2);

				if($count2>0)
				{
					// Food Available
					while($row2=mysqli_fetch_assoc($res2))
					{
						$id=$row2['id'];
						$title=$row2['title'];
						$price=$row2['price'];
						$description=$row2['description'];
						$image_name=$row2['image_name'];
						?>

						<div class="food-menu-box">
							<div class="food-menu-img">
								<?php
									// Check whether image available or not
									if($image_name=="")
									{
										// Image not available
										echo "<div class='error'>Image Not Available.<div>";
									}
									else
									{
										?>
										<img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
										<?php
									}

								?>
							</div>
							<div class="food-menu-desc">
								<h4><?php echo $title; ?></h4>
								<p class="food-price">$<?php echo $price; ?></p>
								<p class="food-detail">
									<?php echo $description; ?>
								</p>
								<br>
								<a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
							</div>
							
							<div class="clearfix"></div>
						</div>

						<?php
					}
				}
				else
				{
					// Food Not Available
					echo "<div class='error'>Food Not Added.</div>";
				}

			?>

			<div class="clearfix"></div>

		</div>
	</section>
	<!-- food-menu section ends here -->

<?php include('partials-front/footer.php'); ?>