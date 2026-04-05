<?php
session_start();
include "config.php";
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit(); }

$user_id = $_SESSION['user_id'];

// Handle cancellation
if (isset($_POST['cancel_id'])) {
    $cancel_id = intval($_POST['cancel_id']);
    $conn->query("UPDATE bookings SET status='Cancelled' WHERE id=$cancel_id AND user_id=$user_id");
}

// Fetch all bookings for this user
$result = $conn->query("
    SELECT b.*, bs.name AS bus_name, bs.from_city, bs.to_city, bs.departure, bs.arrival, bs.type
    FROM bookings b
    JOIN buses bs ON b.bus_id = bs.id
    WHERE b.user_id = $user_id
    ORDER BY b.booked_at DESC
");
$bookings = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "partials/head.php"; ?>
    <title>My Bookings – GoGlide</title>
    <style>
        body { background: #f4f6fb; }
        .booking-card { background: #fff; border-radius: 14px; padding: 24px; box-shadow: 0 4px 18px rgba(0,0,0,0.07); margin-bottom: 16px; }
        .status-confirmed { background: #d4edda; color: #155724; padding: 3px 12px; border-radius: 20px; font-size: 0.82rem; font-weight: 600; }
        .status-cancelled { background: #f8d7da; color: #721c24; padding: 3px 12px; border-radius: 20px; font-size: 0.82rem; font-weight: 600; }
        .price { color: #c0392b; font-weight: 700; font-size: 1.2rem; }
    </style>
</head>
<body>
<?php include "partials/navbar.php"; ?>

<div class="container py-4">
    <h4 class="fw-bold mb-4">📋 My Bookings</h4>

    <?php if (empty($bookings)): ?>
        <div class="text-center py-5">
            <div style="font-size:4rem;">🎫</div>
            <h5 class="mt-3">No bookings yet!</h5>
            <p class="text-muted">Search for buses and book your first trip.</p>
            <a href="search.php" class="btn btn-danger">🔍 Search Buses</a>
        </div>

    <?php else: ?>
        <?php foreach ($bookings as $b): ?>
        <div class="booking-card">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <h6 class="fw-bold mb-0"><?= htmlspecialchars($b['bus_name']) ?></h6>
                        <span class="status-<?= strtolower($b['status']) ?>"><?= $b['status'] ?></span>
                    </div>
                    <p class="text-muted mb-2"><?= $b['from_city'] ?> → <?= $b['to_city'] ?></p>
                    <div class="d-flex flex-wrap gap-3">
                        <small>📅 <?= date('d M Y', strtotime($b['travel_date'])) ?></small>
                        <small>⏰ <?= $b['departure'] ?></small>
                        <small>🏁 <?= $b['arrival'] ?></small>
                        <small>💺 <?= $b['seats_booked'] ?> seat(s)</small>
                        <small>🎟️ Booking #<?= $b['id'] ?></small>
                    </div>
                </div>
                <div class="text-end">
                    <div class="price">Rs. <?= number_format($b['total_price']) ?></div>
                    <small class="text-muted d-block mb-2">Booked on <?= date('d M Y', strtotime($b['booked_at'])) ?></small>
                    <?php if ($b['status'] === 'Confirmed' && strtotime($b['travel_date']) >= strtotime('today')): ?>
                        <form method="POST" onsubmit="return confirm('Cancel this booking?')">
                            <input type="hidden" name="cancel_id" value="<?= $b['id'] ?>">
                            <button type="submit" class="btn btn-outline-danger btn-sm">❌ Cancel</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php include "partials/footer.php"; ?>
</body>
</html>