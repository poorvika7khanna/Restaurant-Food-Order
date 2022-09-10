<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <?php

                // Get the Search Keyword
                $search=$_POST['search'];

            ?>
            
            <h2 class="text-light-grey">Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- food-menu section starts here -->
    <section class="food-menu">
        <div class="container">

            <h2 class="text-center">Food Menu</h2>

            <?php

                // SQL Query to get foods based on search keyword
                $sql="SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                // Execute the Query
                $res=mysqli_query($conn,$sql);

                // Check whether food available or not
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
                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    // Food not available
                    echo "<div class='error'>Food Not Available.<div>";
                }

            ?>

            <div class="clearfix"></div>

        </div>
    </section>
    <!-- food-menu section ends here -->

<?php include('partials-front/footer.php'); ?>