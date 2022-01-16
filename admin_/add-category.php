<?php include('partials/menu.php'); ?>
    <!-- Main Content Section Start -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br>
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
                            <input type="text" name="title" placeholder="Categories Title">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
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
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            <?php
                if(isset($_POST['submit'])){
                    $title = $_POST['title'];
                    
                    if(isset($_POST['featured'])){
                        $featured = $_POST['featured'];
                    }else{
                        $featured = "No";
                    }
                    if(isset($_POST['active'])){
                        $active = $_POST['active'];
                    }else{
                        $active = "No";
                    }


                    if(isset($_FILES['image']['name'])){
                        $image_name = $_FILES['image']['name'];
                        if($image_name != ""){
                            $explode = explode('.',$image_name);
                            $ext = end($explode);
                            $image_name = "category_image".rand(000,999).'.'.$ext;

                            $src = $_FILES['image']['tmp_name'];
                            $des = "../images/categories/".$image_name;
                            $upload = move_uploaded_file($src,$des);
                            if($upload == false){
                                $_SESSION['upload'] = "<div class='error' >Failed to Upload Image.</div>";
                                header('Location: '.SITEURL.'admin/add-categories.php');
                                die();
                            } 
                        }else{
                            $image_name = "Image Not Added";
                        }
                    }else{
                        $image_name = "Image Not Added";
                    }
                    

                    $sql = "INSERT INTO categories(title, image_name, featured, active) VALUES('$title','$image_name','$featured','$active')";
                    $res = $con -> query($sql);
                    if($res){
                        $_SESSION['insert'] = "<div class='success'>Insert Category Successfuly</div>";
                        header('Location: '.SITEURL.'admin_/manage-category.php');
                    }else{
                        $_SESSION['insert'] = "<div class='error'>Error In Insert Category</div>";
                        header('Location: '.SITEURL.'admin_/manage-category.php');
                    }    
                }
            ?>
        </div>
    </div>
    <!-- Main Content Section End -->
<?php include('partials/footer.php'); ?>
