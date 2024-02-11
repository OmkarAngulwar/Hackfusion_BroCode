<!DOCTYPE html>

<!-- PHP code -->
<?php
        include 'connect.php';
        if(isset($_POST['login_btn'])){
            $email=$_POST['email'];
            $pass=md5($_POST['password']);
            $select="SELECT * FROM registration1 WHERE email='$email' && password='$pass'";
            $query=mysqli_query($con,$select);
            $row=mysqli_num_rows($query);
            $fetch=mysqli_fetch_array($query);
            if ($row==1){
                $username=$fetch['username'];
                session_start();
                $_SESSION['username']=$username;
                header('location:index.php');
            }
            else{
                $error="Invalid Email/Password";
            }
        }
    ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/log.css">
</head>
<body>
    <div class="container1">
        <div class="left">
            <img src="img/login1.jpg" alt="login_image">
        </div>
        <div class="right">
            <h1>Login</h1>
            <div class="tbox">
                <p style="color:red; font-weight:bold; font-size:1.3rem;">
                    <?php
                        if(isset($error)){
                            echo $error;
                        }
                    ?>
                </p>
            </div>
            <form action="" method="POST">
                <div class="tbox">
                    <label>Email : </label><br>
                    <input type="email" name="email" placeholder="Enter Email" required>
                </div>
                <br><br>
                <div class="tbox">
                    <label>Password : </label><br>
                    <input type="password" name="password" placeholder="Enter Password" required>
                </div>
                <br><br>
                <div class="tbox">
                    <input type="submit" class="btn" name="login_btn" value="Login">
                </div>
                <div class="tbox text">
                    <p>Don't have an account?<a href="Reg/reg.html">Register Here!</a></p>
                    <p>Are you admin?<a href="LogIn/loginAdmin.html">Sign Up</a></p>
                </div>
            </form>
        </div>
    </div>

    
</body>
</html>