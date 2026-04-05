<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'partials/head.php'; ?>
</head>
<body>

<?php include 'partials/navbar.php'; ?>

<!-- HERO SECTION WITH SLIDER -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/bus1.jpg" class="d-block w-100" alt="Bus 1">
      <div class="carousel-caption d-none d-md-block">
        <h2>Travel Comfortable</h2>
        <p>Book your journey in just a few clicks</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="images/bus2.jpg" class="d-block w-100" alt="Bus 2">
      <div class="carousel-caption d-none d-md-block">
        <h2>Safe & Fast</h2>
        <p>Experience smooth journeys every time</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="images/bus3.jpg" class="d-block w-100" alt="Bus 3">
      <div class="carousel-caption d-none d-md-block">
        <h2>Plan Your Trip</h2>
        <p>Find buses and book tickets instantly</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

<!-- SEARCH SECTION — now submits to search.php -->
<section class="bus-search-section py-5">
    <div class="container">
        <div class="hero-text text-center mb-4">
            <p class="small-text">Nepal, at your fingertips.</p>
            <h1>Effortless Planning. Exceptional Journeys</h1>
            <p class="lead">Escape the valley. Discover the peaks. Seamless bookings to every corner of Nepal.</p>
        </div>
        <div class="card bus-search-card shadow-sm p-4 mx-auto">
            <h5 class="mb-3"><span>🔍</span> Your Journey Awaits</h5>
            <form action="search.php" method="GET" class="row g-3 align-items-center">
                <div class="col-md-3">
                    <label class="form-label">From</label>
                    <input type="text" name="from" class="form-control" placeholder="e.g. Kathmandu" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">To</label>
                    <input type="text" name="to" class="form-control" placeholder="e.g. Pokhara" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Travel Date</label>
                    <input type="date" name="date" class="form-control" min="<?= date('Y-m-d') ?>" required>
                </div>
                <div class="col-md-3 d-grid">
                    <button type="submit" class="btn btn-danger btn-block mt-4">🔍 Search</button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- AVAILABLE BUSES SECTION — Book Now buttons linked to book.php -->
<div class="container mt-5">
    <h2 class="text-center fw-bold">Available Buses Today</h2>
    <p class="text-center text-muted mb-4">Browse our fleet of comfortable buses</p>

    <!-- Bus 1 — bus_id=1 -->
    <div class="bus-card d-flex justify-content-between align-items-center p-4 mb-3">
        <div>
            <h5 class="fw-bold">Himalayan Express</h5>
            <p class="mb-2 text-muted">Kathmandu → Pokhara</p>
            <div class="d-flex flex-wrap gap-2 mb-2">
                <span class="badge">⏰ 06:00 AM</span>
                <span class="badge">🏁 12:00 PM</span>
                <span class="badge">💺 40 seats</span>
            </div>
            <span class="tag ac">AC</span>
        </div>
        <div class="text-end">
            <h3 class="price">Rs.800</h3>
            <small>per seat</small><br>
            <a href="book.php?bus_id=1&date=<?= date('Y-m-d') ?>" class="btn btn-danger mt-2">Book Now</a>
        </div>
    </div>

    <!-- Bus 2 — bus_id=2 -->
    <div class="bus-card d-flex justify-content-between align-items-center p-4 mb-3">
        <div>
            <h5 class="fw-bold">Mountain Star</h5>
            <p class="mb-2 text-muted">Kathmandu → Pokhara</p>
            <div class="d-flex flex-wrap gap-2 mb-2">
                <span class="badge">⏰ 08:30 AM</span>
                <span class="badge">🏁 02:30 PM</span>
                <span class="badge">💺 40 seats</span>
            </div>
            <span class="tag non-ac">Non-AC</span>
        </div>
        <div class="text-end">
            <h3 class="price">Rs.700</h3>
            <small>per seat</small><br>
            <a href="book.php?bus_id=2&date=<?= date('Y-m-d') ?>" class="btn btn-danger mt-2">Book Now</a>
        </div>
    </div>

    <!-- Bus 3 — bus_id=3 -->
    <div class="bus-card d-flex justify-content-between align-items-center p-4 mb-3">
        <div>
            <h5 class="fw-bold">Everest Deluxe</h5>
            <p class="mb-2 text-muted">Kathmandu → Biratnagar</p>
            <div class="d-flex flex-wrap gap-2 mb-2">
                <span class="badge">⏰ 05:00 PM</span>
                <span class="badge">🏁 05:00 AM</span>
                <span class="badge">💺 35 seats</span>
            </div>
            <span class="tag ac">AC</span>
        </div>
        <div class="text-end">
            <h3 class="price">Rs.1500</h3>
            <small>per seat</small><br>
            <a href="book.php?bus_id=3&date=<?= date('Y-m-d') ?>" class="btn btn-danger mt-2">Book Now</a>
        </div>
    </div>

    <!-- Bus 4 — bus_id=4 -->
    <div class="bus-card d-flex justify-content-between align-items-center p-4 mb-3">
        <div>
            <h5 class="fw-bold">Eastern Travel</h5>
            <p class="mb-2 text-muted">Kathmandu → Ilam</p>
            <div class="d-flex flex-wrap gap-2 mb-2">
                <span class="badge">⏰ 04:00 PM</span>
                <span class="badge">🏁 06:00 AM</span>
                <span class="badge">💺 32 seats</span>
            </div>
            <span class="tag non-ac">Non-AC</span>
        </div>
        <div class="text-end">
            <h3 class="price">Rs.1400</h3>
            <small>per seat</small><br>
            <a href="book.php?bus_id=4&date=<?= date('Y-m-d') ?>" class="btn btn-danger mt-2">Book Now</a>
        </div>
    </div>

    <!-- Bus 5 — bus_id=5 -->
    <div class="bus-card d-flex justify-content-between align-items-center p-4 mb-3">
        <div>
            <h5 class="fw-bold">Lumbini Night Bus</h5>
            <p class="mb-2 text-muted">Kathmandu → Butwal</p>
            <div class="d-flex flex-wrap gap-2 mb-2">
                <span class="badge">⏰ 07:00 PM</span>
                <span class="badge">🏁 05:00 AM</span>
                <span class="badge">💺 38 seats</span>
            </div>
            <span class="tag ac">AC</span>
        </div>
        <div class="text-end">
            <h3 class="price">Rs.1100</h3>
            <small>per seat</small><br>
            <a href="book.php?bus_id=5&date=<?= date('Y-m-d') ?>" class="btn btn-danger mt-2">Book Now</a>
        </div>
    </div>

    <!-- Bus 6 — bus_id=6 -->
    <div class="bus-card d-flex justify-content-between align-items-center p-4 mb-3">
        <div>
            <h5 class="fw-bold">Safari Tourist</h5>
            <p class="mb-2 text-muted">Kathmandu → Chitwan</p>
            <div class="d-flex flex-wrap gap-2 mb-2">
                <span class="badge">⏰ 09:00 AM</span>
                <span class="badge">🏁 02:00 PM</span>
                <span class="badge">💺 30 seats</span>
            </div>
            <span class="tag ac">AC</span>
        </div>
        <div class="text-end">
            <h3 class="price">Rs.900</h3>
            <small>per seat</small><br>
            <a href="book.php?bus_id=6&date=<?= date('Y-m-d') ?>" class="btn btn-danger mt-2">Book Now</a>
        </div>
    </div>
</div>

<!-- WHY CHOOSE SECTION -->
<section id="why-choose" class="py-5 bg-light mt-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">Why Choose GoGlide?</h2>
        <p class="text-muted mb-5">We make your journey smooth from booking to destination</p>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <div class="col">
                <span style="font-size:2.5rem;">🔒</span>
                <h5 class="fw-bold mt-2">Secure Booking</h5>
                <p class="text-muted">Your data and payments are fully protected with industry-standard security.</p>
            </div>
            <div class="col">
                <span style="font-size:2.5rem;">🎫</span>
                <h5 class="fw-bold mt-2">Easy Ticketing</h5>
                <p class="text-muted">Book tickets in under 2 minutes — no complicated steps, no hidden fees.</p>
            </div>
            <div class="col">
                <span style="font-size:2.5rem;">🚌</span>
                <h5 class="fw-bold mt-2">Wide Network</h5>
                <p class="text-muted">Routes covering all major cities and towns across Nepal.</p>
            </div>
            <div class="col">
                <span style="font-size:2.5rem;">💬</span>
                <h5 class="fw-bold mt-2">24/7 Support</h5>
                <p class="text-muted">Our support team is available around the clock to help you.</p>
            </div>
        </div>
    </div>
</section>

<?php include 'partials/footer.php'; ?>
</body>
</html>