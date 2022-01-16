<?php include('partials/menu.php'); ?>
    <!-- Main Content Section Start -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1>
            <br><br>
            <form method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td>
                            <input type="text" name="full_name" placeholder="Enter Your Name">
                        </td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td>
                            <input type="text" name="username" placeholder="Enter Your Username">
                        </td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td>
                            <input type="password" name="password" placeholder="Enter Your Password">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            <?php 
                if(isset($_POST['submit'])){
                    $full_name = $_POST['full_name'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    
                    $sql = "INSERT INTO admin(full_name, username, password) VALUES('$full_name', '$username', '$password')";
                    $res = $con -> query($sql);
                    if($res){
                        $_SESSION['insert'] = "<div class='success'>Insert Admin Successfuly</div>";
                        header('Location: '.SITEURL.'admin_/manage-admin.php');
                    }else{
                        $_SESSION['insert'] = "<div class='error'>Error In Insert Admin</div>";
                        header('Location: '.SITEURL.'admin_/manage-admin.php');
                    }
                }
            ?>
        </div>
    </div>
    <!-- Main Content Section End -->
<?php include('partials/footer.php'); ?>
