<?php

    include('partials-front/menu.php');

    // Check whether id is passed or not
    if(isset($_GET['category_id']))
    {
        // Category id is set and get the id
        $category_id=$_GET['category_id'];

        // Get the category title based on category id
        $sql="SELECT title FROM tbl_category WHERE id=$category_id";

        // Execute the query
        $res=mysqli_query($conn,$sql);

        // Get the value from Database
        $row=mysqli_fetch_assoc($res);

        // Get the title
        $category_title=$row['title'];
    }
    else
    {
        // Category not passed
        // Redirect to Home Page
        header('location:'.SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2 class="text-light-grey">Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- food-menu section starts here -->
    <section class="food-menu">
        <div class="container">

            <h2 class="text-center">Food Menu</h2>

            <?php

                // Create SQL query to get foods based on selected category
                $sql2="SELECT * FROM tbl_food WHERE category_id=$category_id";

                // Execute the query
                $res2=mysqli_query($conn,$sql2);

                // Check whether food is available or not
                $count2=mysqli_num_rows($res2);

                if($count2>0)
                {
                    // Food is available
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
                                        // Image available
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
                    // Food is not available
                    echo "<div class='error'>Food Not Available.<div>";
                }

            ?>

            <div class="clearfix"></div>

        </div>
    </section>
    <!-- food-menu section ends here -->

<?php include('partials-front/footer.php'); ?>