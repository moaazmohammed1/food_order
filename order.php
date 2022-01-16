<?php include('partials/menu.php'); ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

                <?php
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM tbl_food WHERE id = '$id'";
                        $res = $con -> query($sql);
                        if($res -> num_rows == 1){
                            $row = $res -> fetch_assoc();
                            $id = $row['id']; 
                            $title = $row['title']; 
                            $price = $row['price']; 
                            $description = $row['description']; 
                            $image_name = $row['image_name']; 
                            $featured = $row['featured']; 
                            $active = $row['active']; 
                        }
                    }else{
                        echo "id not available";
                    }
                ?>
            <form method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

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
                        <h3>
                            <?php echo $title; ?>
                        </h3>
                        <input type="hidden" name="title" value="<?php echo $title; ?>" >
                        <p class="food-price">
                            $ <?php echo $price; ?>
                        </p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>" >

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                    </div>

                </fieldset>
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. moath mohamed" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. moath@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>
            </form>
            <?php
                if(isset($_POST['submit'])){
                    $food = $_POST['title']; 
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $qty * $price;
                    $order_date = date("Y-m-d h:i:sa");
                    $status = "Ordered";
                    $full_name = $_POST['full-name'];
                    $contact = $_POST['contact'];
                    $email = $_POST['email'];
                    $address = $_POST['address'];
                    
                    $sql2 = "INSERT INTO tbl_order(food, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address) 
                    VALUES('$food','$price','$qty','$total','$order_date','$status','$full_name','$contact','$email','$address')";
                    
                    $res2 = $con -> query($sql2);
                    if($res2){
                        $_SESSION['insert-order'] = "<div class='success text-center'>Insert Order Successfully</div>";
                        header('Location: '.SITEURL.'index.php');
                    }else{
                        $_SESSION['insert-order'] = "<div class='error text-center'>Fiald in Insert Order</div>";
                        header('Location: '.SITEURL.'index.php');
                        die();
                    }
                }
            ?>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
<?php include('partials/footer.php'); ?>