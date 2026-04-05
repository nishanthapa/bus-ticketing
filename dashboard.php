<?php
session_start();
include __DIR__ . "/config.php";

// Redirect to login if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$userName = htmlspecialchars($_SESSION['user']);
$userId = $_SESSION['user_id'];

// Fetch booking count if bookings table exists
$bookingCount = 0;
$upcomingCount = 0;
$result = $conn->query("SHOW TABLES LIKE 'bookings'");
if ($result && $result->num_rows > 0) {
    $r = $conn->query("SELECT COUNT(*) as total FROM bookings WHERE user_id = $userId");
    if ($r) $bookingCount = $r->fetch_assoc()['total'];

    $r2 = $conn->query("SELECT COUNT(*) as total FROM bookings WHERE user_id = $userId AND travel_date >= CURDATE()");
    if ($r2) $upcomingCount = $r2->fetch_assoc()['total'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . "/partials/head.php"; ?>
    <title>Dashboard – GoGlide</title>
    <style>
        body { background: #f4f6fb; }

        .dashboard-hero {
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            color: white;
            padding: 40px 30px;
            border-radius: 16px;
            margin-bottom: 30px;
        }
        .dashboard-hero h2 { font-size: 1.9rem; font-weight: 700; }
        .dashboard-hero p { opacity: 0.88; margin: 0 0 24px; }

        /* Search form inside hero */
        .hero-search-card {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(6px);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 14px;
            padding: 24px 24px 20px;
            margin-top: 10px;
        }
        .hero-search-card h6 {
            color: white;
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 16px;
        }
        .hero-search-card label {
            color: rgba(255,255,255,0.85);
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 4px;
        }
        .hero-search-card .form-control {
            border-radius: 8px;
            border: none;
            padding: 10px 14px;
            font-size: 0.95rem;
            background: #fff;
        }
        .hero-search-card .form-control:focus {
            box-shadow: 0 0 0 3px rgba(255,255,255,0.4);
        }
        .btn-search {
            background: #fff;
            color: #c0392b;
            font-weight: 700;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            width: 100%;
            transition: background 0.2s, transform 0.15s;
        }
        .btn-search:hover { background: #f8d7da; transform: translateY(-2px); }

        .stat-card {
            background: #fff;
            border-radius: 14px;
            padding: 24px 20px;
            text-align: center;
            box-shadow: 0 4px 18px rgba(0,0,0,0.07);
            transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-4px); }
        .stat-card .stat-icon { font-size: 2.4rem; margin-bottom: 10px; }
        .stat-card h3 { font-size: 2rem; font-weight: 700; color: #c0392b; margin: 0; }
        .stat-card p { color: #777; margin: 4px 0 0; font-size: 0.9rem; }

        .quick-card {
            background: #fff;
            border-radius: 14px;
            padding: 28px 24px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.07);
            text-decoration: none;
            color: inherit;
            display: block;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .quick-card:hover { transform: translateY(-4px); box-shadow: 0 8px 28px rgba(0,0,0,0.12); color: inherit; }
        .quick-card .qicon { font-size: 2.2rem; margin-bottom: 12px; }
        .quick-card h5 { font-weight: 700; margin-bottom: 6px; }
        .quick-card p { color: #777; font-size: 0.88rem; margin: 0; }

        .section-title { font-weight: 700; font-size: 1.1rem; margin-bottom: 18px; color: #333; }

        .logout-btn {
            background: transparent;
            border: 2px solid rgba(255,255,255,0.7);
            color: white;
            border-radius: 8px;
            padding: 6px 18px;
            font-size: 0.9rem;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
        }
        .logout-btn:hover { background: rgba(255,255,255,0.2); color: white; }
    </style>
</head>
<body>

<?php include __DIR__ . "/partials/navbar.php"; ?>

<div class="container py-4">

    <!-- Hero greeting + Search -->
    <div class="dashboard-hero">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-1">
            <div>
                <h2>👋 Welcome back, <?= $userName ?>!</h2>
                <p>Ready for your next journey? Search a bus or check your trips below.</p>
            </div>
            <a href="logout.php" class="logout-btn">🚪 Logout</a>
        </div>

        <!-- Search Form -->
        <div class="hero-search-card">
            <h6>🔍 Your Journey Awaits</h6>
            <form action="search.php" method="GET" class="row g-3 align-items-end">
                <div class="col-md-3 col-sm-6">
                    <label>From</label>
                    <input type="text" name="from" class="form-control" placeholder="e.g. Kathmandu" required>
                </div>
                <div class="col-md-3 col-sm-6">
                    <label>To</label>
                    <input type="text" name="to" class="form-control" placeholder="e.g. Pokhara" required>
                </div>
                <div class="col-md-3 col-sm-6">
                    <label>Travel Date</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="col-md-3 col-sm-6">
                    <button type="submit" class="btn-search">🔍 Search</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Stats -->
    <p class="section-title">Your Stats</p>
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon">🎫</div>
                <h3><?= $bookingCount ?></h3>
                <p>Total Bookings</p>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon">🗓️</div>
                <h3><?= $upcomingCount ?></h3>
                <p>Upcoming Trips</p>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon">🌄</div>
                <h3>6</h3>
                <p>Routes Available</p>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon">⭐</div>
                <h3>4.8</h3>
                <p>Avg. Rating</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <p class="section-title">Quick Actions</p>
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <a href="index.php" class="quick-card">
                <div class="qicon">🔍</div>
                <h5>Search Buses</h5>
                <p>Find buses for your route</p>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="book.php" class="quick-card">
                <div class="qicon">🎟️</div>
                <h5>Book a Ticket</h5>
                <p>Reserve your seat now</p>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="history.php" class="quick-card">
                <div class="qicon">📋</div>
                <h5>My Bookings</h5>
                <p>View your booking history</p>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="index.php#why-choose" class="quick-card">
                <div class="qicon">💬</div>
                <h5>Support</h5>
                <p>Get help anytime</p>
            </a>
        </div>
    </div>

    <!-- Popular Routes -->
    <p class="section-title">Popular Routes</p>
    <div class="row g-3">
        <?php
        $routes = [
            ["Kathmandu → Pokhara",    "06:00 AM", "Rs. 800",  "🏔️"],
            ["Kathmandu → Chitwan",    "09:00 AM", "Rs. 900",  "🐘"],
            ["Kathmandu → Butwal",     "07:00 PM", "Rs. 1100", "🌙"],
            ["Kathmandu → Biratnagar", "05:00 PM", "Rs. 1500", "✈️"],
        ];
        foreach ($routes as $r): ?>
        <div class="col-sm-6 col-md-3">
            <div class="stat-card text-start">
                <div style="font-size:1.6rem; margin-bottom:8px;"><?= $r[3] ?></div>
                <h6 class="fw-bold mb-1"><?= $r[0] ?></h6>
                <small class="text-muted">Departs <?= $r[1] ?></small>
                <div class="mt-2 d-flex justify-content-between align-items-center">
                    <span class="fw-bold text-danger"><?= $r[2] ?></span>
                    <a href="book.php" class="btn btn-danger btn-sm">Book</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</div>

<?php include __DIR__ . "/partials/footer.php"; ?>
</body>
</html>