<?php include('partials/menu.php'); ?>
    <!-- Main Content Section Start -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Food</h1>
            <br>
            <?php
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['failed-remove'])){
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']);
                }
                if(isset($_SESSION['failed-remove-image'])){
                    echo $_SESSION['failed-remove-image'];
                    unset($_SESSION['failed-remove-image']);
                }
            ?>
             <!-- Button to Add Admin -->
             <br><br><br><a href="<?php echo SITEURL; ?>admin_/add-food.php" class="btn-primary">Add Food</a><br><br>
            <table class="tbl-full">
                <tr>   
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                <?php 
                    $sql = "SELECT * FROM tbl_food";
                    $res = $con -> query($sql);
                    if($res -> num_rows > 0){
                        $count_food = 1;
                        while($row = $res -> fetch_assoc()){
                            $id = $row['id']; 
                            $title = $row['title']; 
                            $price = $row['price']; 
                            $image_name = $row['image_name']; 
                            $featured = $row['featured']; 
                            $active = $row['active']; 

                            ?>
                            <tr>
                                <td><?php echo  $count_food++ ;?>.</td>
                                <td><?php echo  $title;?></td>
                                <td><?php echo  $price;?></td>
                                <td>
                                    <?php 
                                        if($image_name != ""){
                                            ?>
                                            <img src = "<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                            <?php 
                                        }else{
                                            echo "<div class='error' >Image Not Added.</div>";
                                            $image_name = "";
                                        }
                                    ?>   
                                </td>
                                <td><?php echo  $featured;?></td>
                                <td><?php echo  $active;?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin_/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a><br><br>
                                    <a href="<?php echo SITEURL; ?>admin_/delete-food.php?id=<?php echo $id; ?>" class="btn-danger">Delete Food</a>
                                </td>
                            </tr> 
                            <?php
                        }
                    }
                ?>
            </table>
        </div>
    </div>
    <!-- Main Content Section End -->
<?php include('partials/footer.php'); ?>