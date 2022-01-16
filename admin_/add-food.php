<?php include('partials/menu.php'); ?>
    <!-- Main Content Section Start -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Food</h1>
            <?php 
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
                            <input type="text" name="title" placeholder="Title Of The Food">
                        </td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea cols="30" rows="5" name="description" placeholder="Description Of The Food"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" name="price">
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
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            <?php
                if(isset($_POST['submit'])){
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    
                    
                    if(isset($_FILES['image']['name'])){
                        $image_name = $_FILES['image']['name'];
                        if($image_name != ""){
                            $explode = explode('.',$image_name);
                            $ext = end($explode);
                            $image_name = "food_image".rand(000,999).'.'.$ext;

                            $src = $_FILES['image']['tmp_name'];
                            $des = "../images/food/".$image_name;
                            $upload = move_uploaded_file($src,$des);
                            if($upload == false){
                                $_SESSION['upload'] = "<div class='error' >Failed to Upload Image.</div>";
                                header('Location: '.SITEURL.'admin/add-food.php');
                                die();
                            } 
                        }else{
                            $image_name = "Image Not Added";
                        }
                    }else{
                        $image_name = "Image Not Added X";
                    }
                    
                    $category = $_POST['category'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    $sql2 = "INSERT INTO tbl_food(title,description,price,image_name,category_id,featured,active) VALUES('$title', '$description','$price','$image_name', '$category','$featured','$active')";
                    $res2 = $con -> query($sql2);
                    if($res2){
                        $_SESSION['add'] = "<div class='success'>Food Add Successflly.</div>";
                        header('Location: '.SITEURL.'admin_/manage-food.php');
                    }else{
                        $_SESSION['add'] = "<div class='error' >Failed to Add Food..</div>";
                        header('Location: '.SITEURL.'admin_/manage-food.php');
                    } 
                }
            ?>
        </div>
    </div>
    <!-- Main Content Section End -->
    <?php include('partials/footer.php'); ?>