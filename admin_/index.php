<?php include('partials/menu.php'); ?>
<!-- Main Content Section Start -->
<div class="main-content">
        <div class="wrapper">
            <h1>DASHBOARD</h1>
             
            <?php 
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                }else{
                    header('Location: '.SITEURL.'admin_/login.php');
                }
            ?>
            <br><br>
            <div class="col-4 text-center">
                <?php
                    $sql1 = "SELECT * FROM categories";
                    $res1 = $con -> query($sql1);
                     
                ?>
                <h1><?php echo $res1 -> num_rows; ?></h1>
                <br>
                Categories
            </div>
            <div class="col-4 text-center">
                <?php
                    $sql2 = "SELECT * FROM tbl_food";
                    $res2 = $con -> query($sql2);
                     
                ?>
                <h1><?php echo $res2 -> num_rows; ?></h1>
                <br>
                Foods
            </div>
            <div class="col-4 text-center">
                <?php
                    $sql3 = "SELECT * FROM tbl_order";
                    $res3 = $con -> query($sql3);
                     
                ?>
                <h1><?php echo $res3 -> num_rows; ?></h1>
                <br>
                Total Orders
            </div>
            <div class="col-4 text-center">
                <?php
                    $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
                    $res4 = $con -> query($sql4);
                    $row4 = $res4 -> fetch_assoc();
                    $total_remove = $row4['Total']; 
                ?>
                <h1>$ <?php echo $total_remove; ?></h1>
                <br>
                Revenue Generated
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Main Content Section End -->
<?php include('partials/footer.php'); ?>