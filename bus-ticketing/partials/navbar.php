
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark px-3 soft-navbar">

    
    <a class="navbar-brand d-flex align-items-center me-3" href="index.php">
        <img src="images/logo.png" alt="BusSystem Logo" class="logo">
       
    </a>

    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
    </button>

    
    <div class="collapse navbar-collapse justify-content-center" id="navMenu">
        <ul class="navbar-nav mb-2 mb-lg-0 text-center">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="history.php">My Bookings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="book.php">Tickets</a>
            </li>
        </ul>
    </div>

    
    <div class="d-flex ms-auto gap-2 align-items-center">
        <a href="login.php" class="btn btn-light btn-sm">Login</a>
        <a href="signup.php" class="btn btn-warning btn-sm">Signup</a>
        <button onclick="toggleTheme()" class="btn btn-secondary btn-sm" id="themeBtn">🌙</button>
    </div>

</nav>