<?php include('partials-front/menu.php'); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center text-white" >Explore Foods</h2>

            <?php
                // Create SQL Query to display all active categories
                $sql="SELECT * FROM tbl_category WHERE active='Yes'";

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
    <!-- Categories Section Ends Here -->


<?php include('partials-front/footer.php'); ?>