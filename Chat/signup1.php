<!DOCTYPE html>
<?php
    include 'connect.php';
    if (isset($_POST['signup_btn'])){
        $username=mysqli_real_escape_string($con,$_POST['username']);
        $email=mysqli_real_escape_string($con,$_POST['email']);
        $password=mysqli_real_escape_string($con,$_POST['password']);
        $con_password=mysqli_real_escape_string($con,$_POST['con_password']);

        if(empty($username)){
            $error="Username field is required";
        }
        elseif(empty($email)){
            $error="Email field is required";
        }
        elseif(empty($password)){
            $error="Password field is required";
        }
        elseif($password!=$con_password){
            $error="Password do not match with confirm password";
        }
        elseif(strlen($username)<4 || strlen($username)>20){
            $error="Useranme must be between 4 to 20 charcters";
        }
        elseif(strlen($password)<6){
            $error="Password must be atleast 6 charcters";
        }
        else{
            $check_username="SELECT * FROM  registration1 WHERE username='$username'";
            $data=mysqli_query($con,$check_username);
            $result=mysqli_fetch_array($data);
            if ($result>0){
                $error="Username already exist";
            }else{
                $check_email="SELECT * FROM  registration1 WHERE email='$email'";
                $data=mysqli_query($con,$check_email);
                $result=mysqli_fetch_array($data);
                if ($result>0){
                    $error="Email already exist";
                }else{
                    $pass=md5($password);
                    $check_password="SELECT * FROM  registration1 WHERE password='$pass'";
                    $data=mysqli_query($con,$check_password);
                    $result=mysqli_fetch_array($data);
                    if ($result>0){
                        $error="Password already exist";
                    }else{
                        $pass=md5($password);
                        $cpass=md5($con_password);
                        $insert="INSERT INTO registration1 (username,email,password,con_password) Values ('$username','$email','$pass','$cpass')";
                        $q=mysqli_query($con,$insert);
                        if($q){
                            $success="Your account has been created successfully";
                        }
                    
                    }
                }
            }
        }
    }

?>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="css/reg.css">
</head>
<body>
    <div class="container">
        <div class="left">
            <img src="img/signup1.jpg" alt="signup_image">
        </div>
        <div class="right">
            <h1>Sign Up</h1>
            <div class="tbox">
                <p style="color:red; font-weight:bold; font-size:1.3rem;">
                    <?php
                        if(isset($error)){
                            echo $error;
                        }
                    ?>
                </p>
                <p style="color:green; font-weight:bold; font-size:1.3rem;">
                    <?php
                        if(isset($success)){
                            echo $success;
                        }   
                    ?>
                </p>
            </div>
            <form action="" method="POST">
                <div class="tbox">
                    <label>Username : </label><br>
                    <input type="text" name="username" placeholder="Enter Username" value="<?php if(isset($error)){echo $username;} ?>">
                </div>
                <br><br>
                <div class="tbox">
                    <label>Email : </label><br>
                    <input type="email" name="email" placeholder="Enter Email" value="<?php if(isset($error)){echo $email;} ?>">
                </div>
                <br><br>
                <div class="tbox">
                    <label>Password : </label><br>
                    <input type="password" name="password" placeholder="Enter Password">
                </div>
                <br><br>
                <div class="tbox">
                    <label>Confirm Password : </label><br>
                    <input type="password" name="con_password" placeholder="Enter Confirm Password">
                </div>
                <br><br>
                <div class="tbox">
                    <input type="submit" class="btn" name="signup_btn" value="SignUp">
                </div>
                <div class="tbox text">
                    <p>Already have an account?<a href="login1.php">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>