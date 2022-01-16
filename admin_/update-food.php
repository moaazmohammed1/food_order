<?php 
ob_start();
include('partials/menu.php'); ?>
    <!-- Main Content Section Start -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1>
            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM tbl_food WHERE id = '$id'";
                    $res = $con -> query($sql);
                    if($res -> num_rows == 1){
                        $row2 = $res -> fetch_assoc();
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $description = $row2['description'];
                        $price = $row2['price'];
                        $current_image = $row2['image_name'];
                        $category = $row2['category_id'];
                        $featured = $row2['featured'];
                        $active = $row2['active'];
                    }
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>
            <br><br>
            <form method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title;?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea cols="30" rows="5" name="description" ><?php echo $description;?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" name="price" value="<?php echo $price;?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <?php
                                if($current_image != ""){
                                    ?>

                                    <img name="current_name" src="<?php echo SITEURL; ?>/images/food/<?php echo $current_image; ?>" width="100px">
                                    <?php
                                }else{
                                    echo "<div class='error'>Image not Added.</div>";
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category">
                                <?php
                                    $sql = "SELECT * FROM categories WHERE active = 'Yes'";
                                    $res = $con -> query($sql);
                                    if($res -> num_rows > 0){
                                            while($row = $res -> fetch_assoc()){
                                                $id = $row['id'];
                                                $title = $row['title'];
                                                ?>
                                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                                <?php
                                            }
                                    }else{
                                        ?>
                                        <option value="0">No Category Food</option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" <?php if($featured == 'Yes'){echo 'checked';} ?>  value="Yes">Yes
                            <input type="radio" name="featured" <?php if($featured == 'No'){echo 'checked';} ?> value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" <?php if($featured == 'Yes'){echo 'checked';} ?> value="Yes">Yes
                            <input type="radio" name="active" <?php if($featured == 'No'){echo 'checked';} ?> value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            <?php  
                if(isset($_POST['submit'])){
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $current_image = $current_image_ ;

                    if(isset($_FILES['image_name']['name'])){
                        $image_name = $_FILES['image_name']['name'];
                        if($image_name != ""){
                            $ext = end(explode('.',$image_name));
                            $image_name = "food_image".rand(000,999).'.'.$ext;
                            $src = $_FILES['image_name']['tmp_name'];
                            $dst = "../images/food/".$image_name;
                            $uploade = move_uploaded_file($src, $dst);
                            if($uploade ==  false){
                                $_SESSION['upload'] = "<div class='error' >Failed to Upload Image.</div>";
                                header('Location: '.SITEURL.'admin_/manage-food.php');
                                die();
                            }
                            if($current_image != ""){ 
                                $remove_path = "../images/food/".$current_image;
                                $remove = unlink($remove_path);
                                if($remove == false){
                                    $_SESSION['failed-remove'] = "<div class='error' >Failed To Remove Current Image.</div>";
                                    header('Location: '.SITEURL.'admin_/manage-food.php');
                                    die();
                                }
                            }else{
                                $_SESSION['failed-remove-image'] = "<div class='error' >Failed To Remove Current Image."."../images/food/".$current_image."</div>";
                                header('Location: '.SITEURL.'admin_/manage-food.php');
                            }
                        }else{
                            $image_name = $current_image ;
                        }
                    }else{
                        $image_name = $current_image ;
                    }

                    $category = $_POST['category'];

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
                    
                    $sql2 = "UPDATE tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = '$price',
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = '$id'
                    ";
                    $res2 = $con -> query($sql2);
                    if($res2){
                        $_SESSION['update'] = "<div class='success'>Food Update Successflly.</div>";
                        header('Location: '.SITEURL.'admin_/manage-food.php');
                        ob_flush();
                    }else{
                        $_SESSION['update'] = "<div class='error' >Failed to Update Food..</div>";
                        header('Location: '.SITEURL.'admin_/manage-food.php');
                    } 
                }

            ?>
        </div>
    </div>
    <!-- Main Content Section End -->
<?php include('partials/footer.php'); ?>