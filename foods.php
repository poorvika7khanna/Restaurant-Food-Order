<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <<form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



     <!-- food-menu section starts here -->
    <section class="food-menu">
        <div class="container">

            <h2 class="text-center">Food Menu</h2>

            <?php

                // Getting foods from database
                // SQL Query
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

                // Execute the Query
                $res=mysqli_query($conn,$sql);

                // Check whether food is available or not
                $count=mysqli_num_rows($res);

                if($count>0)
                {
                    // Food Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $description=$row['description'];
                        $image_name=$row['image_name'];
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