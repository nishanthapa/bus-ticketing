<?php
session_start();
include "config.php";
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit(); }

$from  = trim($_GET['from'] ?? '');
$to    = trim($_GET['to'] ?? '');
$date  = $_GET['date'] ?? '';
$buses = [];

if ($from && $to && $date) {
    $stmt = $conn->prepare("SELECT * FROM buses WHERE from_city LIKE ? AND to_city LIKE ?");
    $f = "%$from%"; $t = "%$to%";
    $stmt->bind_param("ss", $f, $t);
    $stmt->execute();
    $buses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "partials/head.php"; ?>
    <title>Search Buses – GoGlide</title>
    <style>
        body { background: #f4f6fb; }
        .bus-card { background: #fff; border-radius: 14px; padding: 24px; box-shadow: 0 4px 18px rgba(0,0,0,0.07); margin-bottom: 16px; }
        .tag { padding: 3px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
        .tag.ac { background: #d4edda; color: #155724; }
        .tag.non-ac { background: #fff3cd; color: #856404; }
        .price { color: #c0392b; font-weight: 700; font-size: 1.4rem; }
        .search-bar { background: #fff; border-radius: 14px; padding: 24px; box-shadow: 0 4px 18px rgba(0,0,0,0.07); margin-bottom: 24px; }
    </style>
</head>
<body>
<?php include "partials/navbar.php"; ?>

<div class="container py-4">
    <!-- Search Form -->
    <div class="search-bar">
        <h5 class="mb-3">🔍 Search Buses</h5>
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label">From</label>
                <input type="text" name="from" class="form-control" placeholder="e.g. Kathmandu" value="<?= htmlspecialchars($from) ?>" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">To</label>
                <input type="text" name="to" class="form-control" placeholder="e.g. Pokhara" value="<?= htmlspecialchars($to) ?>" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Travel Date</label>
                <input type="date" name="date" class="form-control" value="<?= htmlspecialchars($date) ?>" min="<?= date('Y-m-d') ?>" required>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-danger w-100">🔍 Search</button>
            </div>
        </form>
    </div>

    <!-- Results -->
    <?php if ($from && $to && $date): ?>
        <h5 class="mb-3">
            <?= count($buses) ?> bus<?= count($buses) != 1 ? 'es' : '' ?> found
            from <strong><?= htmlspecialchars($from) ?></strong>
            to <strong><?= htmlspecialchars($to) ?></strong>
            on <strong><?= date('d M Y', strtotime($date)) ?></strong>
        </h5>

        <?php if (empty($buses)): ?>
            <div class="alert alert-warning">No buses found for this route. Try a different route or date.</div>
        <?php else: ?>
            <?php foreach ($buses as $bus): ?>
            <div class="bus-card d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h5 class="fw-bold mb-1"><?= htmlspecialchars($bus['name']) ?></h5>
                    <p class="text-muted mb-2"><?= $bus['from_city'] ?> → <?= $bus['to_city'] ?></p>
                    <div class="d-flex flex-wrap gap-2 mb-2">
                        <span class="badge bg-secondary">⏰ <?= $bus['departure'] ?></span>
                        <span class="badge bg-secondary">🏁 <?= $bus['arrival'] ?></span>
                        <span class="badge bg-secondary">💺 <?= $bus['seats'] ?> seats</span>
                    </div>
                    <span class="tag <?= $bus['type'] == 'AC' ? 'ac' : 'non-ac' ?>"><?= $bus['type'] ?></span>
                </div>
                <div class="text-end">
                    <div class="price">Rs. <?= $bus['price'] ?></div>
                    <small class="text-muted">per seat</small><br>
                    <a href="book.php?bus_id=<?= $bus['id'] ?>&date=<?= $date ?>"
                       class="btn btn-danger mt-2">Book Now</a>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php include "partials/footer.php"; ?>
</body>
</html>