<?php include('partials/menu.php'); ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
       
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php
        if(isset($_SESSION['insert-order'])){
            echo $_SESSION['insert-order'];
            unset($_SESSION['insert-order']);
        }
    ?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            
            <?php
                $sql2 = "SELECT * FROM categories WHERE featured = 'Yes' AND active = 'Yes'";
                $res2 = $con -> query($sql2);
                if($res2 -> num_rows > 0){
                    while($row2 = $res2 -> fetch_assoc()){
                        $title = $row2['title'];
                        $image_name = $row2['image_name'];
                        ?>
                        <a href="category-foods.php">
                            <div class="box-3 float-container">
                                <img src="<?php echo SITEURL; ?>images/categories/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>
                        <?php
                    }
                } 
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                $sql = "SELECT * FROM tbl_food WHERE featured = 'Yes'";
                $res = $con -> query($sql);
                if($res -> num_rows > 0){
                    while($row = $res -> fetch_assoc()){
                        $id = $row['id']; 
                        $title = $row['title']; 
                        $price = $row['price']; 
                        $description = $row['description']; 
                        $image_name = $row['image_name']; 
                        $featured = $row['featured']; 
                        $active = $row['active']; 

                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    if($image_name != ""){
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    }else{
                                        echo "<div class='error'>Image Not Added</div>";
                                    }
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">$ <?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php
                    }
                }else{
                    echo "<div class='error'>Food Not Available</div>";
                }
            ?>
            <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <a href="foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php include('partials/footer.php'); ?>