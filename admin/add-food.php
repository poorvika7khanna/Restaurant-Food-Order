<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Food</h1>

		<br><br>

		<?php
			if(isset($_SESSION['upload']))
			{
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}
		?>

		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>Title: </td>
					<td>
						<input type="text" name="title" placeholder="Title of the Food">
					</td>
				</tr>

				<tr>
					<td>Description: </td>
					<td>
						<textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea>
					</td>
				</tr>

				<tr>
					<td>Price: </td>
					<td>
						<input type="number" name="price" placeholder="Title of the Food">
					</td>
				</tr>

				<tr>
					<td>Select Image: </td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>

				<tr>
					<td>Category: </td>
					<td>
						<select name="category">

							<?php
								// PHP Code to Display Categories from the Database
								// 1. Create SQL to get all Active categories from Database
								$sql="SELECT * FROM tbl_category WHERE active='Yes'";

								// Executing Query
								$res=mysqli_query($conn, $sql);

								// Checking whether we have Categories or not
								$count=mysqli_num_rows($res);

								if($count>0)
								{
									// We have Categories
									while($row=mysqli_fetch_assoc($res))
									{
										// Get the details of Categories
										$id=$row['id'];
										$title=$row['title'];
										?>

										// 2. Display on Dropdown
										<option value="<?php echo $id; ?>"><?php echo $title; ?></option>
										<?php
									}
								}
								else
								{
									// We do not have any category
									?>
									<option value="0">No Category Found</option>
									<?php
								}

							?>

						</select>
					</td>
				</tr>

				<tr>
					<td>Featured: </td>
					<td>
						<input type="radio" name="featured" value="Yes"> Yes
						<input type="radio" name="featured" value="No"> No
					</td>
				</tr>

				<tr>
					<td>Active: </td>
					<td>
						<input type="radio" name="active" value="Yes"> Yes
						<input type="radio" name="active" value="No"> No
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>

		<?php
			// Check whether the button is clicked or not
			if(isset($_POST['submit']))
			{
				// 1. Get the Data from the form
				$title=$_POST['title'];
				$description=$_POST['description'];
				$price=$_POST['price'];
				$category=$_POST['category'];

				// Check whether the radio button for featured and active are checked or not
				if(isset($_POST['featured']))
				{
					$featured=$_POST['featured'];
				}
				else
				{
					$featured="No";
				}

				if(isset($_POST['active']))
				{
					$active=$_POST['active'];
				}
				else
				{
					$active="No";
				}

				// 2. Upload the Image if selected
				// Check whether the select image is clicked or not and upload the image only if the image is selected
				if(isset($_FILES['image']['name']))
				{
					// Get the details of the selected image
					$image_name=$_FILES['image']['name'];

					// Check whether the image is selected or not and upload image only if selected
					if($image_name!="")
					{
						// Image is selected
						// A. Rename the image
						// Get the extension of the selected image(jpg, png, gif, etc)
						$ext=end(explode('.', $image_name));

						// Create new name for image
						$image_name="Food-Name-".rand(0000,9999).".".$ext;

						// B. Upload the image
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
							// Redirect to Add Food page with error message
							$_SESSION['upload']="<div class='error'>Failed to Upload Image.</div>";
							header("location:".SITEURL."admin/add-food.php");

							// Stop the process
							die();
						}
					}
				}
				else
				{
					$image_name=""; // Setting default value as blank
				}

				// 3. Insert into Database
				// Create SQL Query to add food
				$sql2="INSERT INTO tbl_food SET 
					title='$title',
					description='$description',
					price=$price,
					image_name='$image_name',
					category_id=$category,
					featured='$featured',
					active='$active'
				";

				// Execute the Query
				$res2=mysqli_query($conn,$sql2);

				// Check whether data inserted or not
				// 4. Redirect to Manage Food page with Message
				if($res2==true)
				{
					// Data inserted Successfully
					$_SESSION['add']="<div class='success'>Food Added Successfully.</div>";
					header("location:".SITEURL."admin/manage-food.php");
				}
				else
				{
					// Failed to insert data
					$_SESSION['add']="<div class='error'>Failed to Add Food.</div>";
					header("location:".SITEURL."admin/manage-food.php");
				}
			}
		?>

	</div>
</div>

<?php include('partials/footer.php'); ?>