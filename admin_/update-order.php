<?php  ob_start(); ?>
<?php include('partials/menu.php'); ?>
    <!-- Main Content Section Start -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Order</h1>
            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM tbl_order WHERE id = '$id'";
                    $res = $con -> query($sql);
                    if($res -> num_rows == 1){
                        $row = $res -> fetch_assoc();
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                    
                    }else{
                        $_SESSION['no-food-found'] = "<div class='error' >Food Not Found.</div>";
                        header('Location: '. SITEURL .'admin_/manage-order.php');
                    }
                }else{
                header('Location: '. SITEURL .'admin_/manage-order.php');
                }

                
            ?>
            <br><br><br>
             <!-- Button to Add Admin -->
            <form method="POST" enctype="multipart/form-data">
                <table class="tbl-full">
                    <tr>
                        <td>Food Name</td>
                        <td>
                            <h2>
                                <?php echo $food; ?>
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>
                            <h2>
                                $ <?php echo $price; ?>
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td>Qty:</td>
                        <td>
                            <input type='text' name='qty' value='<?php echo $qty; ?>'>
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <select name='status'>
                                <option <?php if($status == 'Ordered'){echo 'selected';} ?> value='Ordered'>Ordered</option>
                                <option <?php if($status == 'On Delivery'){echo 'selected';} ?> value='On Delivery'>On Delivery</option>
                                <option <?php if($status == 'Delivered'){echo 'selected';} ?> value='Delivered'>Delivered</option>
                                <option <?php if($status == 'Cancelled'){echo 'selected';} ?> value='Cancelled'>Cancelled</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Customer Name</td>
                        <td>
                            <input type='text' name='customer_name' value='<?php echo $customer_name; ?>'>
                        </td>
                    </tr>
                    <tr>
                        <td>Customer Contact</td>
                        <td>
                            <input type='text' name='customer_contact' value='<?php echo $customer_contact; ?>'>
                        </td>
                    </tr>
                    <tr>
                        <td>Customer Email</td>
                        <td>
                            <input type='text' name='customer_email' value='<?php echo $customer_email; ?>'>
                        </td>
                    </tr>
                    <tr>
                        <td>Customer Address</td>
                        <td>
                            <input type='text' name='customer_address' value='<?php echo $customer_address; ?>'>
                        </td>
                    </tr>     
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                        </td>
                    </tr> 
                </table>
            </form>
            <?php 
                if(isset($_POST['submit'])){
                    $id = $_POST['id'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;
                    $status = $_POST['status'];
                    $customer_name = $_POST['customer_name'];
                    $customer_contact = $_POST['customer_contact'];
                    $customer_email = $_POST['customer_email'];
                    $customer_address = $_POST['customer_address'];

                    $sql1 = "UPDATE tbl_order SET
                        qty = '$qty',
                        total = '$total',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address' 
                        WHERE id = '$id'";
                    $res1 = $con -> query($sql1);
                    if($res1){
                        $_SESSION['update'] = "<div class='success'>Update Order Successfully</div>";
                        header('Location: '.SITEURL.'admin_/manage-order.php');
                        ob_flush(); 
                    }else{
                        $_SESSION['update'] = "<div class='error'>Fiald in Update Order</div>";
                        header('Location: '.SITEURL.'admin_/manage-order.php');
                    }
                }
            ?>
        </div>
    </div>
    <!-- Main Content Section End -->
<?php include('partials/footer.php'); ?>