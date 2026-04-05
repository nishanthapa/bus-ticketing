<!DOCTYPE html>
<html>
<head>
    <?php include 'partials/head.php'; ?>
</head>

<body>

<?php include 'partials/navbar.php'; ?>



<!-- HERO SECTION WITH SLIDER -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">

  <!-- INDICATORS -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
  </div>

  <!-- SLIDES -->
  <div class="carousel-inner">
    
    <!-- Slide 1 -->
    <div class="carousel-item active">
      <img src="images/bus1.jpg" class="d-block w-100" alt="Bus 1">
      <div class="carousel-caption d-none d-md-block">
        <h2>Travel Comfortable</h2>
        <p>Book your journey in just a few clicks</p>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="carousel-item">
      <img src="images/bus2.jpg" class="d-block w-100" alt="Bus 2">
      <div class="carousel-caption d-none d-md-block">
        <h2>Safe & Fast</h2>
        <p>Experience smooth journeys every time</p>
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="carousel-item">
      <img src="images/bus3.jpg" class="d-block w-100" alt="Bus 3">
      <div class="carousel-caption d-none d-md-block">
        <h2>Plan Your Trip</h2>
        <p>Find buses and book tickets instantly</p>
      </div>
    </div>

  </div>

  <!-- CONTROLS -->
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>

</div>

<!-- Bus Search Section -->
<section class="bus-search-section py-5">
    <div class="container">
        <div class="hero-text text-center mb-4">
            <p class="small-text" >Nepal, at your fingertips. </p>
            <h1>Effortless Planning. Exceptional Journeys</h1>
            <p class="lead">Escape the valley. Discover the peaks. Seamless bookings to every corner of Nepal.</p>
        </div>

        
        <div class="card bus-search-card shadow-sm p-4 mx-auto">
            <h5 class="mb-3"><span> 🔍 </span> Your Journey Awaits </h5>
            <form class="row g-3 align-items-center">
                <div class="col-md-3">
                    <label for="from" class="form-label">From</label>
                    <input type="text" class="form-control" id="from" placeholder="e.g. Kathmandu">
                </div>
                <div class="col-md-3">
                    <label for="to" class="form-label">To</label>
                    <input type="text" class="form-control" id="to" placeholder="e.g. Pokhara">
                </div>
                <div class="col-md-3">
                    <label for="date" class="form-label">Travel Date</label>
                    <input type="date" class="form-control" id="date">
                </div>
                <div class="col-md-3 d-grid">
                    <button type="submit" class="btn btn-danger btn-block mt-4">🔍 Search</button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- SAMPLE CONTENT -->
<div class="container mt-5">
    <h2 class="text-center">Welcome to GoGlide</h2>
    <h6 class="text-center mb-4">Popular routes</h4>

    <div class="row mt-4">

        <div class="col-md-4">
            <div class="card p-3 shadow">
                <h5>Deluxe Bus</h5>
                <p>Kathmandu → Pokhara</p>
                <button class="btn btn-primary">Book</button>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow">
                <h5>Tourist Bus</h5>
                <p>Kathmandu → Chitwan</p>
                <button class="btn btn-primary">Book</button>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow">
                <h5>Night Bus</h5>
                <p>Kathmandu → Butwal</p>
                <button class="btn btn-primary">Book</button>
            </div>
        </div>

    </div>
</div>

<!-- AVAILABLE BUSES SECTION -->

   <div class="container mt-5">
    <h2 class="text-center fw-bold">Available Buses Today</h2>
    <p class="text-center text-muted mb-4">Browse our fleet of comfortable buses</p>

    <!-- Bus 1 -->
    <div class="bus-card d-flex justify-content-between align-items-center p-4 mb-3">
        <div>
            <h5 class="fw-bold">Himalayan Express</h5>
            <p class="mb-2 text-muted">Kathmandu → Pokhara</p>

            <div class="d-flex flex-wrap gap-2 mb-2">
                <span class="badge">⏰ 06:00 AM</span>
                <span class="badge">🏁 12:00 PM</span>
                <span class="badge">💺 40 seats</span>
                <span class="badge">🚌 KTM-PKR-001</span>
            </div>

            <span class="tag ac">AC</span>
        </div>

        <div class="text-end">
            <h3 class="price">Rs.800</h3>
            <small>per seat</small><br>
            <button class="btn btn-danger mt-2">Book Now</button>
        </div>
    </div>

    <!-- Bus 2 -->
    <div class="bus-card d-flex justify-content-between align-items-center p-4 mb-3">
        <div>
            <h5 class="fw-bold">Mountain Star</h5>
            <p class="mb-2 text-muted">Kathmandu → Pokhara</p>

            <div class="d-flex flex-wrap gap-2 mb-2">
                <span class="badge">⏰ 08:30 AM</span>
                <span class="badge">🏁 02:30 PM</span>
                <span class="badge">💺 40 seats</span>
                <span class="badge">🚌 KTM-PKR-002</span>
            </div>

            <span class="tag non-ac">Non-AC</span>
        </div>

        <div class="text-end">
            <h3 class="price">Rs.700</h3>
            <small>per seat</small><br>
            <button class="btn btn-danger mt-2">Book Now</button>
        </div>
    </div>

    <!-- Bus 3 -->
    <div class="bus-card d-flex justify-content-between align-items-center p-4 mb-3">
        <div>
            <h5 class="fw-bold">Everest Deluxe</h5>
            <p class="mb-2 text-muted">Kathmandu → Biratnagar</p>

            <div class="d-flex flex-wrap gap-2 mb-2">
                <span class="badge">⏰ 05:00 PM</span>
                <span class="badge">🏁 05:00 AM</span>
                <span class="badge">💺 35 seats</span>
                <span class="badge">🚌 KTM-BRT-003</span>
            </div>

            <span class="tag ac">AC</span>
        </div>

        <div class="text-end">
            <h3 class="price">Rs.1500</h3>
            <small>per seat</small><br>
            <button class="btn btn-danger mt-2">Book Now</button>
        </div>
    </div>

    <!-- Bus 4 -->
    <div class="bus-card d-flex justify-content-between align-items-center p-4 mb-3">
        <div>
            <h5 class="fw-bold">Eastern Travel</h5>
            <p class="mb-2 text-muted">Kathmandu → Ilam</p>

            <div class="d-flex flex-wrap gap-2 mb-2">
                <span class="badge">⏰ 04:00 PM</span>
                <span class="badge">🏁 06:00 AM</span>
                <span class="badge">💺 32 seats</span>
                <span class="badge">🚌 KTM-ILM-004</span>
            </div>

            <span class="tag non-ac">Non-AC</span>
        </div>

        <div class="text-end">
            <h3 class="price">Rs.1400</h3>
            <small>per seat</small><br>
            <button class="btn btn-danger mt-2">Book Now</button>
        </div>
    </div>

    <!-- Bus 5 -->
    <div class="bus-card d-flex justify-content-between align-items-center p-4 mb-3">
        <div>
            <h5 class="fw-bold">Lumbini Night Bus</h5>
            <p class="mb-2 text-muted">Kathmandu → Butwal</p>

            <div class="d-flex flex-wrap gap-2 mb-2">
                <span class="badge">⏰ 07:00 PM</span>
                <span class="badge">🏁 05:00 AM</span>
                <span class="badge">💺 38 seats</span>
                <span class="badge">🚌 KTM-BTW-005</span>
            </div>

            <span class="tag ac">AC</span>
        </div>

        <div class="text-end">
            <h3 class="price">Rs.1100</h3>
            <small>per seat</small><br>
            <button class="btn btn-danger mt-2">Book Now</button>
        </div>
    </div>

    <!-- Bus 6 -->
    <div class="bus-card d-flex justify-content-between align-items-center p-4">
        <div>
            <h5 class="fw-bold">Safari Tourist</h5>
            <p class="mb-2 text-muted">Kathmandu → Chitwan</p>

            <div class="d-flex flex-wrap gap-2 mb-2">
                <span class="badge">⏰ 09:00 AM</span>
                <span class="badge">🏁 02:00 PM</span>
                <span class="badge">💺 30 seats</span>
                <span class="badge">🚌 KTM-CTN-006</span>
            </div>

            <span class="tag ac">AC</span>
        </div>

        <div class="text-end">
            <h3 class="price">Rs.900</h3>
            <small>per seat</small><br>
            <button class="btn btn-danger mt-2">Book Now</button>
        </div>
    </div>

</div>


<!-- Why Choose BusTravel Section -->
<section id="why-choose" style="margin-bottom: 50px;">
  <!-- Your content here -->
</section>

<!-- Sample Container Section -->
<section id="sample-container">
  <!-- Your content here -->
</section>

<!-- Why Choose BusTravel Section -->
<section class="py-5 bg-light">
    <div class="container text-center">
        <!-- Section Header -->
        <h2 class="fw-bold mb-3">Why Choose GoGlide?</h2>
        <p class="text-muted mb-5">We make your journey smooth from booking to destination</p>
        
        <!-- Features Row -->
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <!-- Secure Booking -->
            <div class="col">
                <div class="feature-icon mb-3">
                    <span style="font-size: 2.5rem;">🔒</span>
                </div>
                <h5 class="fw-bold">Secure Booking</h5>
                <p class="text-muted">Your data and payments are fully protected with industry-standard security.</p>
            </div>
           
            <div class="col">
                <div class="feature-icon mb-3">
                    <span style="font-size: 2.5rem;">🎫</span>
                </div>
                <h5 class="fw-bold">Easy Ticketing</h5>
                <p class="text-muted">Book tickets in under 2 minutes — no complicated steps, no hidden fees.</p>
            </div>
            
            <div class="col">
                <div class="feature-icon mb-3">
                    <span style="font-size: 2.5rem;">🚌</span>
                </div>
                <h5 class="fw-bold">Wide Network</h5>
                <p class="text-muted">Routes covering all major cities and towns across Nepal.</p>
            </div>
            
            <div class="col">
                <div class="feature-icon mb-3">
                    <span style="font-size: 2.5rem;">💬</span>
                </div>
                <h5 class="fw-bold">24/7 Support</h5>
                <p class="text-muted">Our support team is available around the clock to help you.</p>
            </div>
        </div>
    </div>
</section>
<?php include 'partials/footer.php'; ?>
</body>
</html>