<?php include('../config/constant.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Order Website - Home Page</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <!-- Menu Section Start -->
    <div class="menu text-center">
        <div class="wrapper">
        <ul>
            <li><a href="<?php echo SITEURL; ?>admin_/">Home</a></li>
            <li><a href="<?php echo SITEURL; ?>admin_/manage-admin.php">Admin</a></li>
            <li><a href="<?php echo SITEURL; ?>admin_/manage-category.php">Categories</a></li>
            <li><a href="<?php echo SITEURL; ?>admin_/manage-food.php">Foods</a></li>
            <li><a href="<?php echo SITEURL; ?>admin_/manage-order.php">Order</a></li>
            <li><a href="<?php echo SITEURL; ?>admin_/logout.php">Logout</a></li>
        </ul>

        </div>
    </div>
    <!-- Menu Section End -->