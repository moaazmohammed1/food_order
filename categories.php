<?php include('partials/menu.php'); ?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            
            <?php
                $sql2 = "SELECT * FROM categories WHERE featured = 'Yes'";
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
<?php include('partials/footer.php'); ?>