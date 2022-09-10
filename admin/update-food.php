<?php include('partials/menu.php'); ?>

<?php
	// Check whether id is set or not
	if(isset($_GET['id']))
	{
		// Get all the details
		$id=$_GET['id'];

		// SQL Query to get the selected food
		$sql2="SELECT * FROM tbl_food WHERE id=$id";

		// Executing the query
		$res2=mysqli_query($conn,$sql2);

		// Get the value based on query executed
		$row2=mysqli_fetch_assoc($res2);

		// Get the individual values of selected food
		$title=$row2['title'];
		$description=$row2['description'];
		$price=$row2['price'];
		$current_image=$row2['image_name'];
		$current_category=$row2['category_id'];
		$featured=$row2['featured'];
		$active=$row2['active'];
	}
	else
	{
		// Redirect to Manage Food
		header("location:".SITEURL."admin/manage-food.php");
	}
?>

<div class="main-content">
	<div class="wrapper">
		<h1>Update Food</h1>

		<br><br>

		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">

				<tr>
					<td>Title: </td>
					<td>
						<input type="text" name="title" value="<?php echo $title; ?>">
					</td>
				</tr>

				<tr>
					<td>Description: </td>
					<td>
						<textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
					</td>
				</tr>

				<tr>
					<td>Price: </td>
					<td>
						<input type="number" name="price" value="<?php echo $price; ?>">
					</td>
				</tr>

				<tr>
					<td>Current Image: </td>
					<td>
						<?php
							if($current_image=="")
							{
								// Image not Available
								echo "<div class='error'>Image Not Available.</div>";
							}
							else
							{
								// Image Available
								?>
								<img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width='180px'>
								<?php
							}
						?>
					</td>
				</tr>

				<tr>
					<td>Select New Image: </td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>				

				<tr>
					<td>Category: </td>
					<td>
						<select name="category">

							<?php
								// Query to get active categories
								$sql="SELECT * FROM tbl_category WHERE active='Yes'";

								// Executing the query
								$res=mysqli_query($conn,$sql);

								$count=mysqli_num_rows($res);

								// Check whether category available or not
								if($count>0)
								{
									// Category available
									while($row=mysqli_fetch_assoc($res))
									{
										// Get the details of Categories
										$category_id=$row['id'];
										$category_title=$row['title'];
										?>

										<option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

										<?php
									}
								}
								else
								{
									// Category not available
									echo "<option value='0'>Category Not Available</option>";
								}
							?>

						</select>
					</td>
				</tr>

				<tr>
					<td>Featured: </td>
					<td>
						<input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
						<input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
					</td>
				</tr>

				<tr>
					<td>Active: </td>
					<td>
						<input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
						<input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="submit" name="submit" value="Update Food" class="btn-secondary">
					</td>
				</tr>

			</table>
		</form>

		<?php
			if(isset($_POST['submit']))
			{
				// 1. Get all details from the form
				$id=$_POST['id'];
				$title=$_POST['title'];
				$description=$_POST['description'];
				$price=$_POST['price'];
				$current_image=$_POST['current_image'];
				$category=$_POST['category'];
				$featured=$_POST['featured'];
				$active=$_POST['active'];

				// 2. Upload the image if selected
				// Check whether the upoad button is clicked or not
				if(isset($_FILES['image']['name']))
				{
					$image_name=$_FILES['image']['name'];  // New image name

					// Check whether the file is available or not
					if($image_name!="")
					{
						// Image is available
						// Rename the image
						$ext=end(explode('.', $image_name));

						// Create new name for image
						$image_name="Food-Name-".rand(0000,9999).".".$ext;

						// A. Upload new image
						// Get the source path and destination path

						// source path is the current location of the image
						$src=$_FILES['image']['tmp_name'];

						// Destination path for the image to be uploaded
						$dst="../images/food/".$image_name;

						// Finally upload the food image
						$upload=move_uploaded_file($src, $dst);

						// Check whether image uploaded or not
						if($upload==false)
						{
							// Failed to upload the image
							// Redirect to Manage Food page with error message
							$_SESSION['upload']="<div class='error'>Failed to Upload New Image.</div>";
							header("location:".SITEURL."admin/manage-food.php");

							// Stop the process
							die();
						}

						// 3. Remove the image if new image is uploaded and current image exists
						// B. Remove current image if available
						if($current_image!="")
						{
							// Current image is available
							// Remove the image
							$remove_path="../images/food/".$current_image;

							$remove=unlink($remove_path);

							// Check whether the image is removed or not
							if($remove==false)
							{
								// Failed to remove current image
								$_SESSION['failed-remove']="<div class='error'>Failed to Remove Current Image</div>";

								// Redirect to Manage Food page
								header("location:".SITEURL."admin/manage-food.php");

								// Stop the process
								die();
							}
						}
					}
					else
					{
						$image_name=$current_image; // Default image when image is not selected
					}
				}
				else
				{
					$image_name=$current_image; // Default image when button is not clicked
				}

				// 4. Update the food in database
				$sql3="UPDATE tbl_food SET 
					title='$title',
					description='$description',
					price=$price,
					image_name='$image_name',
					category_id='$category',
					featured='$featured',
					active='$active'
					WHERE id=$id
				";

				// Execute the Query
				$res3=mysqli_query($conn,$sql3);

				// Check whether the query executed or not
				// Redirect to Manage Food with session message
				if($res3==true)
				{
					$_SESSION['update']="<div class='success'>Food Updated Successfully.</div>";
					header("location:".SITEURL."admin/manage-food.php");
				}
				else
				{
					$_SESSION['update']="<div class='error'>Failed to Update Food.</div>";
					header("location:".SITEURL."admin/manage-food.php");
				}

			}
		?>

	</div>
</div>
<?php include('partials/footer.php'); ?>