<?php include('../config/constant.php'); ?>
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        // $image_name = $_GET['image_name'];
        
        // if($image_name != ""){
        //     $path = "../images/food/".$image_name;
        //     $remove = unlink($path);
        //     if($remove == false){
        //         $_SESSION['remove'] = "<div class='error' >Failed to Remove Image File.</div>";
        //         header('Location: '.SITEURL.'admin/manage-food.php');
        //         die();
        //     }
        // }

        $sql = "DELETE FROM tbl_food WHERE id = '$id'";
        $res = $con -> query($sql);
        if($res == false){
            die();
        }else{
            $_SESSION['delete'] = "<div class='success'>Delete Food Successfuly</div>";
            header('Location: '.SITEURL.'admin_/manage-food.php');
        }
    }else{
        $_SESSION['delete'] = "<div class='error'>Field ".die()."</div>";
        header('Location: '.SITEURL.'admin_/manage-food.php');
    }

?>