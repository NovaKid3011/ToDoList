<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Motivea</title>
<link rel="stylesheet" href="HomePage.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
/* Center align text in jumbotron */
.jumbotron {
    text-align: center;
}

</style>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Motivea</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">For Teams</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="SignIn_SignUp.php">Log In</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="SignIn_SignUp.php">Sign Up</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Center -->
<div class="jumbotron">
    <h1 class="display-4">Task, Do, Sort, Win</h1>
    <p class="lead">Unleash Your Potential, Dominate Your Goals!</p>
    <a class="btn btn-primary btn-lg" href="SignIn_SignUp.php" role="button">Get Started!</a>
</div>

<!-- Slider Gallery Inside Website -->
<div class="container-carousel">
    <div class="slider">
        <div class="list">
            <div class="item">
                <img src="carousel/1 (1).png" alt="">
            </div>
            <div class="item">
                <img src="carousel/1 (2).png" alt="">
            </div>
            <div class="item">
                <img src="carousel/1 (3).png" alt="">
            </div>
            <div class="item">
                <img src="carousel/1 (4).png" alt="">
            </div>
            <div class="item">
                <img src="carousel/1 (5).png" alt="">
            </div>
        </div>
        <div class="buttons">
            <button id="prev"><</button>
            <button id="next">></button>
        </div>
        <ul class="dots">
            <li class="active"></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</div>

<!-- Scripts -->
<script src="Homepage-carousel.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
