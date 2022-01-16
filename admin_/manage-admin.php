<?php include('partials/menu.php'); ?>
    <!-- Main Content Section Start -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin</h1>
            <br>
            <?php 
                if(isset($_SESSION['insert'])){
                    echo $_SESSION['insert'];
                    unset($_SESSION['insert']);
                }
                if(isset($_SESSION['change_password'] )){
                    echo $_SESSION['change_password'];
                    unset($_SESSION['change_password']);
                }
                if(isset($_SESSION['delete'] )){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['update'] )){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>   
            <!-- Button to Add Admin -->
             <br><br><br>
            <a href="<?php echo SITEURL; ?>admin_/add-admin.php" class="btn-primary">Add Admin</a><br><br>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>User Name</th>
                    <th>Actions</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM admin";
                    $res = $con -> query($sql);
                    if($res -> num_rows > 0){
                        $count_manage_admin = 1;
                        while($row = $res -> fetch_assoc()){
                            $id = $row['id'];
                            $full_name = $row['full_name'];
                            $username = $row['username'];
                            $password = $row['password'];
                            ?>
                            <tr>
                                <td><?php echo $count_manage_admin++ . '.'; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin_/change-password.php?id=<?php echo $id; ?>" class="btn-danger">Change Password</a>
                                    <a href="<?php echo SITEURL; ?>admin_/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a><br><br>
                                    <a href="<?php echo SITEURL; ?>admin_/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                </td>
                            </tr> 
                            <?php
                        }
                    }else{
                        echo "Not Admin Available";
                    }
                ?>
            </table>
        </div>
    </div>
    <!-- Main Content Section End -->
<?php include('partials/footer.php'); ?>