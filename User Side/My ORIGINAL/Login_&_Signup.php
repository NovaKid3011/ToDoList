<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="Login_&_Signup.css"> <!-- Include the CSS file for sliding signup and login design -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Flower Shop</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('flower.jpg'); /* Background image URL */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        .container .form-container {
            background-color: rgba(255, 255, 255, 0.7); /* Transparent white background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3); /* Box shadow for glassmorphism effect */
            max-width: 400px; /* Limit the maximum width of the form */
            width: 100%; /* Make the form container responsive */
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="container" id="container">
            <div class="form-container sign-up">
                <form method="POST" action="process.php" onsubmit="return validatePassword()">
                    <h2>Create Account</h2>
                    <div class="social-icons">
                        <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                        <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                        <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                    <span>or use your email for registration</span>
                    <input type="text" placeholder="Username" name="inputUsername">
                    <input type="email" placeholder="Email" name="inputEmail">
                    <input type="password" placeholder="Password" id="inputPassword" name="inputPassword">
                    <input type="password" placeholder="Confirm Password">
                    <button type="submit">Sign Up</button>
                </form>
            </div>
            <div class="form-container sign-in">
                <form method="POST" action="process.php">
                    <h2>Sign In</h2>
                    <div class="social-icons">
                        <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                        <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                        <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                    <span>or use your email and password</span>
                    <input type="email" placeholder="Email">
                    <input type="password" placeholder="Password">
                    <a href="#">Forget Your Password?</a>
                    <button type="submit">Sign In</button>
                </form>
            </div>
            <div class="toggle-container">
                <div class="toggle">
                    <div class="toggle-panel toggle-left">
                        <h2>Welcome Back!</h2>
                        <p>Enter your personal details to use all site features</p>
                        <button class="hidden" id="login">Sign In</button>
                    </div>
                    <div class="toggle-panel toggle-right">
                        <h2>Hello, Friend!</h2>
                        <p>Register with your personal details to use all site features</p>
                        <button class="hidden" id="register">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');

        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });

        function validatePassword() {
            var password = document.getElementById("inputPassword").value;
            var passwordLength = password.length;
            var regex = /^(?=.*[a-zA-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,20}$/;
            if (!regex.test(password)) {
                document.getElementById("passwordAlert").style.display = "block";
                return false;
            } else {
                document.getElementById("passwordAlert").style.display = "none";
                return true;
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
