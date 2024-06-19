<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flower Shop - Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Registration</h2>
        <form class="row g-3" method="POST" action="process.php" onsubmit="return validatePassword()">
            <div class="col-12">
                <input type="text" class="form-control" id="inputUsername" name="inputUsername" placeholder=" " autocomplete="off" required>
                <label for="inputUsername">Username</label>
            </div>
            <div class="col-12">
                <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder=" "  aria-describedby="emailHelp" autocomplete="off" required>
                <label for="inputEmail">Email</label>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="col-12">
                <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder=" " aria-describedby="passwordHelpBlock" autocomplete="off" required>
                <label for="inputPassword">Password</label>
                <div id="passwordAlert" class="password-alert" role="alert">
                    Your password must be 8-20 characters long and must contain letters and symbols!
                </div>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">Register</button>
            </div>
        </form>
    </div>
    <!-- Add carousel pictures here -->
    <div class="carousel">
        <!-- Carousel content -->
        <img src="flower.jpg" alt="Beautiful flower">
    </div>
    <script>
        function validatePassword() {
            var password = document.getElementById("inputPassword").value;
            var passwordLength = password.length;
            var regex = /^(?=.*[a-zA-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,20}$/;
            if (!regex.test(password)) {
                document.getElementById("passwordAlert").classList.add("show");
                return false;
            } else {
                document.getElementById("passwordAlert").classList.remove("show");
                return true;
            }
        }
    </script>
</body>
</html>
