<?php include('partials/menu.php'); ?>
    <!-- Main Content Section Start -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Change Password</h1>
            <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
            ?>
            <br><br>
            <form method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Current Password:</td>
                        <td>
                            <input type="password" name="current_password" placeholder="Current Password">
                        </td>
                    </tr>
                    <tr>
                        <td>New Password:</td>
                        <td>
                            <input type="password" name="new_password" placeholder="New Password">
                        </td>
                    </tr>
                    <tr>
                        <td>Confirm Password</td>
                        <td>
                            <input type="password" name="confirm_password" placeholder="Confirm Password">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
                <?php
                    if(isset($_POST['submit'])){
                        $id = $_POST['id'];
                        $current_password = $_POST['current_password'];
                        $confirm_password = $_POST['confirm_password'];
                        $new_password = $_POST['new_password'];

                        $sql = "SELECT * FROM admin WHERE id = '$id'";
                        $res = $con -> query($sql);
                        if($res -> num_rows == 1){
                            $row = $res -> fetch_assoc();
                            $id = $row['id'];
                            $password_user = $row['password'];
                            if($password_user == $current_password){
                                if($confirm_password == $new_password){
                                    $sql2 = "UPDATE admin SET password = '$new_password' WHERE id = '$id' ";
                                    $res2 = $con -> query($sql2);
                                    if($res2){
                                        $_SESSION['change_password'] = "<div class='success'>Update Password Successfuly</div>";
                                        header('Location: '.SITEURL.'admin_/manage-admin.php');
                                    }else{
                                        $_SESSION['change_password'] = "<div class='error'>Field ".die()."</div>";
                                        header('Location: '.SITEURL.'admin_/manage-admin.php');
                                    }
                                }else{
                                    echo "<br><div class='error'>Field to Confirm Password , Plece Enter Again</div>";
                                }
                            }else{
                                echo "<br><div class='error'>Field to Current Password , Plece Enter Again</div>";
                            }
                        }else{
                            $_SESSION['change_password'] = "<div class='error'>User Not Found</div>";
                            header('Location: '.SITEURL.'admin_/manage-admin.php');
                        }
                    }
                ?>
        </div>
    </div>
    <!-- Main Content Section End -->
<?php include('partials/footer.php'); ?>
