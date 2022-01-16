<?php include('partials/menu.php'); ?>
    <!-- Main Content Section Start -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>
            <br>
            <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM categories WHERE id = '$id'";
                    $res = $con -> query($sql);
                    if($res -> num_rows == 1){
                        $row = $res -> fetch_assoc();
                            $id = $row['id'];
                            $title = $row['title'];
                            $current_image_ = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                    }else{
                        $_SESSION['no-category-found'] = "<div class='error' >Category Not Found.</div>";
                        header('Location: '. SITEURL .'admin_/manage-category.php');
                    }
                }else{
                    header('Location: '. SITEURL .'admin_/manage-category.php');
                }

            ?>
            <br><br>
            <form method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <?php 
                                if($current_image_ != ""){
                                    ?>
                                    <img name="current_name" src = "<?php echo SITEURL; ?>images/categories/<?php echo $current_image_; ?>" width="100px">
                                    <?php
                                }else{
                                    echo "<div class='error' >Image Not Added.</div>";
                                    $current_image_ = "";
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image_name">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" <?php if($featured == 'Yes'){echo "checked";} ?> value="Yes">Yes
                            <input type="radio" name="featured" <?php if($featured == 'No'){echo "checked";} ?> value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" <?php if($active == 'Yes'){echo 'checked';} ?> value="Yes">Yes
                            <input type="radio" name="active" <?php if($active == 'No'){echo 'checked';} ?> value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            <?php
                if(isset($_POST['submit'])){
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $current_image = $current_image_ ;

                    if(isset($_FILES['image_name']['name'])){
                        $image_name = $_FILES['image_name']['name'];
                        if($image_name != ""){
                            $ext = end(explode('.',$image_name));
                            $image_name = "ctgry_image".rand(000,999).'.'.$ext;
                            $src = $_FILES['image_name']['tmp_name'];
                            $dst = "../images/categories/".$image_name;
                            $uploade = move_uploaded_file($src, $dst);
                            if($uploade ==  false){
                                $_SESSION['upload'] = "<div class='error' >Failed to Upload Image.</div>";
                                header('Location: '.SITEURL.'admin_/manage-category.php');
                                die();
                            }
                            if($current_image != ""){ 
                                $remove_path = "../images/categories/".$current_image;
                                $remove = unlink($remove_path);
                                if($remove == false){
                                    $_SESSION['failed-remove'] = "<div class='error' >Failed To Remove Current Image.</div>";
                                    header('Location: '.SITEURL.'admin_/manage-category.php');
                                    die();
                                }
                            }else{
                                $_SESSION['failed-remove-image'] = "<div class='error' >Failed To Remove Current Image."."../images/categories/".$current_image."</div>";
                                header('Location: '.SITEURL.'admin_/manage-category.php');
                            }
                        }else{
                            $image_name = $current_image ;
                        }
                    }else{
                        $image_name = $current_image ;
                    }

                    if(isset($_POST['featured'])){
                        $featured = $_POST['featured'];
                    }else{
                        $featured = 'No';
                    }
                    
                    if(isset($_POST['active'])){
                        $active = $_POST['active'];
                    }else{
                        $active = 'No';
                    }
                    $sql2 = "UPDATE categories SET 
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                    WHERE id = '$id' ";
                    $res2 = $con -> query($sql2);
                    if($res2){
                        $_SESSION['update'] = "<div class='success'>Categories Update Successflly.</div>";
                        header('Location: '.SITEURL.'admin_/manage-category.php');
                    }else{
                        $_SESSION['update'] = "<div class='error'>Filed to Update Categories.</div>";
                        header('Location: '.SITEURL.'admin_/manage-category.php');
                    }
                }

            ?>
        </div>
    </div>
    <!-- Main Content Section End -->
<?php include('partials/footer.php'); ?>
