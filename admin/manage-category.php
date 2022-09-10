<?php include('partials/menu.php'); ?>

		<!-- Main content Section starts -->
		<div class="main-content">
			<div class="wrapper">
				<h1>Manage Category</h1>
				
				<br><br>

				<?php
					if(isset($_SESSION['add']))
					{
						echo $_SESSION['add'];      //Displaying Session Message
						unset($_SESSION['add']);    // Removing Session Message
					}

					if(isset($_SESSION['remove']))
					{
						echo $_SESSION['remove'];      //Displaying Session Message
						unset($_SESSION['remove']);    // Removing Session Message
					}

					if(isset($_SESSION['delete']))
					{
						echo $_SESSION['delete'];      //Displaying Session Message
						unset($_SESSION['delete']);    // Removing Session Message
					}

					if(isset($_SESSION['no-category-found']))
					{
						echo $_SESSION['no-category-found'];      //Displaying Session Message
						unset($_SESSION['no-category-found']);    // Removing Session Message
					}

					if(isset($_SESSION['update']))
					{
						echo $_SESSION['update'];      //Displaying Session Message
						unset($_SESSION['update']);    // Removing Session Message
					}

					if(isset($_SESSION['upload']))
					{
						echo $_SESSION['upload'];      //Displaying Session Message
						unset($_SESSION['upload']);    // Removing Session Message
					}

					if(isset($_SESSION['failed-remove']))
					{
						echo $_SESSION['failed-remove'];      //Displaying Session Message
						unset($_SESSION['failed-remove']);    // Removing Session Message
					}
				?>

				<br><br>

				<!-- Button to add Category -->
				<a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

				<br><br><br>

				<table class="tbl-full">

					<tr>
						<th>S.N.</th>
						<th>Title</th>
						<th>Image</th>
						<th>Featured</th>
						<th>Active</th>
						<th>Actions</th>
					</tr>

					<?php

						// Query to get all Categories from Database
						$sql="SELECT * FROM tbl_category";

						// Execute Query
						$res=mysqli_query($conn,$sql);

						$count=mysqli_num_rows($res);

						$sn=1;

						// Check whether we have date in Database or not
						if($count>0)
						{
							// Get the Data and Display
							while($row=mysqli_fetch_assoc($res))
							{
								$id=$row['id'];
								$title=$row['title'];
								$image_name=$row['image_name'];
								$featured=$row['featured'];
								$active=$row['active'];

								?>

								<tr>
									<td><?php echo $sn++; ?></td>
									<td><?php echo $title; ?></td>

									<td>
										<?php
											// Check whether image name is available or not
											if($image_name!="")
											{
												// Display the Image
												?>
												<img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="150px">
												<?php
											}
											else
											{
												// Display the message
												echo "<div class='error'>Image Not Added</div>";
											}
										?>
									</td>

									<td><?php echo $featured; ?></td>
									<td><?php echo $active; ?></td>
									<td>
										<a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
										<a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
									</td>
								</tr>

								<?php
							}
						}
						else
						{
							// Displaying message in Database
							?>

							<tr>
								<td colspan="6"><div class="error">No Category Added.</div></td>
							</tr>

							<?php
						}

					?>

				</table>
				
			</div>
		</div>
		<!-- Main content Section ends -->

<?php include('partials/footer.php'); ?>