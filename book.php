<?php
session_start();
include "config.php";
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit(); }

$bus_id = intval($_GET['bus_id'] ?? 0);
$date   = $_GET['date'] ?? '';

// Fetch bus details
$stmt = $conn->prepare("SELECT * FROM buses WHERE id = ?");
$stmt->bind_param("i", $bus_id);
$stmt->execute();
$bus = $stmt->get_result()->fetch_assoc();

if (!$bus || !$date) { header("Location: search.php"); exit(); }

// Handle booking confirmation
if (isset($_POST['confirm'])) {
    $seats       = intval($_POST['seats']);
    $total_price = $seats * $bus['price'];
    $user_id     = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO bookings (user_id, bus_id, travel_date, seats_booked, total_price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisii", $user_id, $bus_id, $date, $seats, $total_price);

    if ($stmt->execute()) {
        $success = true;
        $booking_id = $conn->insert_id;
    } else {
        $error = "Booking failed! Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "partials/head.php"; ?>
    <title>Book Ticket – GoGlide</title>
    <style>
        body { background: #f4f6fb; }
        .book-card { background: #fff; border-radius: 14px; padding: 32px; box-shadow: 0 4px 18px rgba(0,0,0,0.07); max-width: 560px; margin: 40px auto; }
        .bus-info { background: #f8f9fa; border-radius: 10px; padding: 16px; margin-bottom: 24px; }
        .price { color: #c0392b; font-weight: 700; font-size: 1.3rem; }
        .btn-confirm { width: 100%; padding: 12px; background: #dc3545; color: #fff; border: none; border-radius: 8px; font-size: 1rem; cursor: pointer; transition: background 0.2s; }
        .btn-confirm:hover { background: #bb2d3b; }
        .success-box { text-align: center; padding: 20px 0; }
        .success-box .icon { font-size: 4rem; }
    </style>
</head>
<body>
<?php include "partials/navbar.php"; ?>

<div class="container">
    <div class="book-card">

        <?php if (isset($success)): ?>
            <!-- Success Screen -->
            <div class="success-box">
                <div class="icon">🎉</div>
                <h3 class="mt-3">Booking Confirmed!</h3>
                <p class="text-muted">Your ticket has been booked successfully.</p>
                <p><strong>Booking ID:</strong> #<?= $booking_id ?></p>
                <p><strong>Route:</strong> <?= $bus['from_city'] ?> → <?= $bus['to_city'] ?></p>
                <p><strong>Date:</strong> <?= date('d M Y', strtotime($date)) ?></p>
                <p><strong>Departure:</strong> <?= $bus['departure'] ?></p>
                <hr>
                <a href="history.php" class="btn btn-danger me-2">📋 View My Bookings</a>
                <a href="index.php" class="btn btn-outline-secondary">🏠 Home</a>
            </div>

        <?php else: ?>
            <!-- Booking Form -->
            <h4 class="fw-bold mb-4">🎟️ Confirm Your Booking</h4>

            <!-- Bus Summary -->
            <div class="bus-info">
                <h6 class="fw-bold"><?= htmlspecialchars($bus['name']) ?></h6>
                <p class="mb-1 text-muted"><?= $bus['from_city'] ?> → <?= $bus['to_city'] ?></p>
                <div class="d-flex gap-3 flex-wrap">
                    <small>⏰ <?= $bus['departure'] ?></small>
                    <small>🏁 <?= $bus['arrival'] ?></small>
                    <small>📅 <?= date('d M Y', strtotime($date)) ?></small>
                    <small>💺 <?= $bus['seats'] ?> seats available</small>
                </div>
            </div>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST" id="bookForm">
                <label class="form-label fw-semibold">Passenger Name</label>
                <input type="text" class="form-control mb-3" value="<?= htmlspecialchars($_SESSION['user']) ?>" readonly>

                <label class="form-label fw-semibold">Number of Seats</label>
                <input type="number" name="seats" id="seats" class="form-control mb-3"
                       min="1" max="<?= $bus['seats'] ?>" value="1" required>

                <label class="form-label fw-semibold">Price per Seat</label>
                <input type="text" class="form-control mb-3" value="Rs. <?= $bus['price'] ?>" readonly>

                <label class="form-label fw-semibold">Total Price</label>
                <input type="text" class="form-control mb-4" id="totalPrice" value="Rs. <?= $bus['price'] ?>" readonly>

                <button type="submit" name="confirm" class="btn-confirm">✅ Confirm Booking</button>
            </form>

            <script>
                // Update total price dynamically when seats change
                document.getElementById('seats').addEventListener('input', function() {
                    const seats = parseInt(this.value) || 1;
                    const price = <?= $bus['price'] ?>;
                    document.getElementById('totalPrice').value = 'Rs. ' + (seats * price).toLocaleString();
                });
            </script>
        <?php endif; ?>

    </div>
</div>

<?php include "partials/footer.php"; ?>
</body>
</html>