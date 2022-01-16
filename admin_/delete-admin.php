<?php include('../config/constant.php'); ?>
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        
        $sql = "DELETE FROM admin WHERE id = '$id'";
        $res = $con -> query($sql);
        if($res == false){
            die();
        }else{
            $_SESSION['delete'] = "<div class='success'>Delete Admin Successfuly</div>";
            header('Location: '.SITEURL.'admin_/manage-admin.php');
        }
    }else{
        $_SESSION['delete'] = "<div class='error'>Field ".die()."</div>";
        header('Location: '.SITEURL.'admin_/manage-admin.php');
    }

?>