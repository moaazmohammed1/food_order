<?php include('partials/menu.php'); ?>
    <!-- Main Content Section Start -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>
            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM admin WHERE id = '$id'";
                    $res = $con -> query($sql);
                    if($res -> num_rows == 1){
                        $row = $res -> fetch_assoc();
                        $id = $row['id'];
                        $full_name = $row['full_name'];
                        $username = $row['username'];
                    }
                }
            ?>
            <br><br>
            <form method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td>
                            <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td>
                            <input type="text" name="username" value="<?php echo $username; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            <?php 
                if(isset($_POST['submit'])){
                    $id = $_POST['id'];
                    $full_name = $_POST['full_name'];
                    $username = $_POST['username'];
                    
                    $sql = "UPDATE admin SET full_name = '$full_name', username ='$username' WHERE id = '$id'";
                    $res = $con -> query($sql);
                    if($res){
                        $_SESSION['update'] = "<div class='success' >Admin Updated Successflly</div>";
                        header('Location: '.SITEURL.'admin_/manage-admin.php');
                    }else{
                        $_SESSION['update'] = "<div class='error' >Failed to Updated Admin. Try Again Later</div>";
                        header('Location: '.SITEURL.'admin_/manage-admin.php');
                    }
                }
            ?>
        </div>
    </div>
    <!-- Main Content Section End -->
<?php include('partials/footer.php'); ?>
