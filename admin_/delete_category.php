<?php 
    include('../config/constant.php'); 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM categories WHERE id = '$id'";
        $res = $con -> query($sql);
        if($res){
            $_SESSION['delete'] = "<div class='success'>Delete Category Successfuly</div>";
            header('Location: '.SITEURL.'admin_/manage-category.php');
        }else{
            $_SESSION['delete'] = "<div class='error'>Error In Delete Category</div>";
            header('Location: '.SITEURL.'admin_/manage-category.php');
        } 
    }
?>