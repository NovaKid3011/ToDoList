<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign in & Sign up Form</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<main>
    <div class="box">
        <div class="inner-box">
            <div class="forms-wrap">
                <form action="SignIn_SignUp_Process.php" method="POST" autocomplete="off" class="sign-in-form">
                    <div class="logo">
                        <img src="./img/logo.png" alt="easyclass" />
                        <h4>Motivea</h4>
                    </div>
                    <div class="heading">
                        <h2>Welcome Back</h2>
                        <h6>Not registered yet?</h6>
                        <a href="#" class="toggle">Sign up</a>
                    </div>
                    <div class="actual-form">
                        <div class="input-wrap">
                            <input type="email" name="email" class="input-field" autocomplete="off" required/>
                            <label>Email</label>
                        </div>
                        <div class="input-wrap">
                            <input type="password" name="password" minlength="8" class="input-field" autocomplete="off" required/>
                            <label>Password</label>
                        </div>
                        <input type="submit" name="login" value="Sign In" class="sign-btn" />
                        <p class="text">
                            Forgotten your password or your login details?
                            <a href="#">Get help</a> signing in
                        </p>
                    </div>
                </form>
                
                <form action="SignIn_SignUp_Process.php" method="POST" autocomplete="off" class="sign-up-form" enctype="multipart/form-data">
                    <div class="logo">
                        <img src="./img/logo.png" alt="Motivea" />
                        <h4>Motivea</h4>
                    </div>
                    <div class="heading">
                        <h2>Get Started</h2>
                        <h6>Already have an account?</h6>
                        <a href="#" class="toggle">Sign in</a>
                    </div>
                    <div class="actual-form">
                        <div class="input-wrap">
                            <input type="text" name="username" minlength="4" class="input-field" autocomplete="off" required/>
                            <label>Username</label>
                        </div>
                        <div class="input-wrap">
                            <input type="email" name="email" class="input-field" autocomplete="off" required/>
                            <label>Email</label>
                        </div>
                        <div class="input-wrap">
                            <input type="password" name="password" minlength="8" class="input-field" autocomplete="off" required/>
                            <label>Password</label>
                        </div>
                        <div class="input-wrap">
                            <input type="password" name="confirm_password" minlength="8" class="input-field" autocomplete="off" required>
                            <label>Confirm Password</label>
                        </div>
                        <input type="submit" name="signup" value="Sign Up" class="sign-btn" />
                        <p class="text">
                            By signing up, I agree to the
                            <a href="#">Terms of Services</a> and
                            <a href="#">Privacy Policy</a>
                        </p>
                    </div>
                </form>
            </div>
            <div class="carousel">
                <div class="images-wrapper">
                    <img src="./img/image1.png" class="image img-1 show" alt="" />
                    <img src="./img/image2.png" class="image img-2" alt="" />
                    <img src="./img/image3.png" class="image img-3" alt="" />
                </div>
                <div class="text-slider">
                    <div class="text-wrap">
                        <div class="text-group">
                            <h2>Organize Your Tasks!</h2>
                            <h2>Boost Your Productivity!</h2>
                            <h2>Achieve Goals with Motivea!</h2>
                        </div>
                    </div>
                    <div class="bullets">
                        <span class="active" data-value="1"></span>
                        <span data-value="2"></span>
                        <span data-value="3"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
        <script src="SignIn_SignUp.js"></script>
</body>
</html>
