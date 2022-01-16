<?php include('../config/constant.php'); ?>

<html>
<head>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body> 
    <div class="login">
        <h2 class="text-center">Login</h2>
        <br><br>

        <?php 
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>
        
        <br><br>
        <form method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>
            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
            <b class="text-center">Created By - <a href="www.moath.com">moath</a></b>
        </form>
    </div>
</body>   
</html>

<?php 
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
        $res = $con -> query($sql);
            if(mysqli_num_rows($res) == 1){
                $_SESSION['login'] = "<div class='success'>Login Successflly.</div>";
                $_SESSION['user'] =  $username;               
                
                header('Location: '.SITEURL.'admin_/');
            }else{
                $_SESSION['login'] = "<div class='error text-center'>Username Or Password Did not match.</div>";
                header('Location: '.SITEURL.'admin_/login.php');
            }
        }
?>