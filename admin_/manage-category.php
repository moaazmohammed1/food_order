<?php include('partials/menu.php'); ?>
    <!-- Main Content Section Start -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Categories</h1>
            <br>
            <?php
                if(isset($_SESSION['insert'])){
                    echo $_SESSION['insert'];
                    unset($_SESSION['insert']);
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['no-category-found'])){
                    echo $_SESSION['no-category-found'];
                    unset($_SESSION['no-category-found']);
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                if(isset($_SESSION['failed-remove'])){
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']);
                }
                if(isset($_SESSION['failed-remove-image'])){
                    echo $_SESSION['failed-remove-image'];
                    unset($_SESSION['failed-remove-image']);
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
            <!-- Button to Add Admin -->
            <br><br><br>
            <a href="<?php echo SITEURL; ?>admin_/add-category.php" class="btn-primary">Add Category</a>
            <br><br>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM categories";
                    $res = $con -> query($sql);
                    if($res -> num_rows > 0){
                        $count_category = 1;
                        while($row = $res -> fetch_assoc()){
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>
                                <tr>
                                    <td><?php echo $count_category++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        <?php 
                                            if($image_name != ""){
                                                ?>
                                                <img src = "<?php echo SITEURL; ?>images/categories/<?php echo $image_name; ?>" width="100px">
                                                <?php 
                                            }else{
                                                echo "<div class='error' >Image Not Added.</div>";
                                                $image_name = "";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin_/update_category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a><br><br>
                                        <a href="<?php echo SITEURL; ?>admin_/delete_category.php?id=<?php echo $id; ?>" class="btn-danger">Delete Category</a>
                                    </td>
                                </tr> 
                            <?php
                        }
                    }else{
                        echo "category Not Available";
                    }
                ?>
            </table>
        </div>
    </div>
    <!-- Main Content Section End -->
<?php include('partials/footer.php'); ?>