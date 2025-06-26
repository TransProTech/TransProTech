<?php
require_once __DIR__ . '/db.php';

$locations = [];
$fromRes = $conn->query("SELECT DISTINCT fromLocation FROM routes");
$toRes   = $conn->query("SELECT DISTINCT toLocation FROM routes");
while ($row = $fromRes->fetch_assoc()) { $locations[] = $row['fromLocation']; }
while ($row = $toRes->fetch_assoc()) {
    if (!in_array($row['toLocation'], $locations)) $locations[] = $row['toLocation'];
}

$fareRates = [];
$rateRes = $conn->query("SELECT transportType, pesoPerKm FROM fare_rates");
if ($rateRes) {
    while ($r = $rateRes->fetch_assoc()) {
        $fareRates[strtolower($r['transportType'])] = (float)$r['pesoPerKm'];
    }
}

function calcFare(float $distance, string $mode, array $rates): string {
    if ($distance <= 0 || !isset($rates[$mode])) return '—';
    return number_format($distance * $rates[$mode], 2);
}

$submitted = false;
$startLocation = $endLocation = $transportMode = $plannedRoute = null;
$currentDate = $currentTime = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    date_default_timezone_set('Asia/Manila');

    $startLocation  = $conn->real_escape_string($_POST['start']);
    $endLocation    = $conn->real_escape_string($_POST['destination']);
    $transportMode  = strtolower($conn->real_escape_string($_POST['mode'] ?? 'bus'));

    $currentDate = date('Y-m-d');
    $currentTime = date('H:i:s');

    // Get route info (any available route between the two points)
    $stmt = $conn->prepare("SELECT * FROM routes WHERE fromLocation=? AND toLocation=? LIMIT 1");
    $stmt->bind_param('ss', $startLocation, $endLocation);
    $stmt->execute();
    $plannedRoute = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    $submitted = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TransProTech – Plan Trip</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
html, body {
  height: 100%;
  overflow-x: hidden;
  margin: 0;
}
body {
  font-family: Arial, sans-serif;
  background: #f1f1f1;
  background-image: url('img/transprobg.jpg');
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  display: flex;
  flex-direction: column;
}
header {
  background: #0d47a1;
  padding: 10px 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  color: #fff;
}
.logo {
  font-size: 26px;
  font-weight: bold;
}
nav a {
  margin: 0 10px;
  text-decoration: none;
  font-weight: bold;
  color: #fff;
}
nav a.active {
  background: #1976d2;
  padding: 5px 10px;
  border-radius: 5px;
}
.user-icon {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  object-fit: cover;
}
.custom-container {
  background: #2e83f5;
  margin: 30px auto;
  padding: 30px;
  width: 90%;
  max-width: 900px;
  color: #fff;
  border-radius: 10px;
  flex: 1 0 auto;
  box-sizing: border-box;
}
.route-box {
  background: #1c5fd5;
  padding: 15px;
  border-radius: 10px;
  color: #fff;
  width: 100%;
  box-sizing: border-box;
}
button {
  background: #fff;
  color: #2e83f5;
  font-weight: 600;
}
button:hover {
  background: #dce6ff;
}
.rounded-form {
  background: #1c5fd5;
  padding: 20px;
  border-radius: 15px;
}
.rounded-form .form-control {
  border-radius: 10px;
}
  </style>
</head>
<body>
<header>
  <div class="logo">TransProTech</div>
  <nav>
    <a href="home.php">Home</a>
    <a href="live_status.php">Live Status</a>
    <a class="active" href="#">Plan Trip</a>
    <a href="contacts.php">Contacts</a>
    <a href="login.php" class="btn btn-sm btn-outline-light ms-3">Logout</a>
  </nav>
  <img src="userlogo.png" class="user-icon" alt="User Icon">
</header>

<div class="custom-container">
  <h2 class="mb-4 fw-semibold">Plan Your Trip</h2>

  <form class="rounded-form" method="POST" id="tripForm">
    <div class="row">
      <div class="col-md-6 mb-3">
        <select name="start" class="form-control" required>
          <option value="">Select starting point</option>
          <?php foreach ($locations as $loc): ?>
            <option value="<?= htmlspecialchars($loc) ?>"><?= $loc ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-6 mb-3">
        <select name="destination" class="form-control" required>
          <option value="">Select destination</option>
          <?php foreach ($locations as $loc): ?>
            <option value="<?= htmlspecialchars($loc) ?>"><?= $loc ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="mb-3">
      <?php foreach (['bus'=>'Bus','jeepney'=>'Jeepney','tricycle'=>'Tricycle'] as $val=>$label): ?>
        <label class="form-label me-3">
          <input type="radio" name="mode" value="<?= $val ?>" class="form-check-input me-1" required> <?= $label ?>
        </label>
      <?php endforeach; ?>
    </div>

    <button type="submit" class="btn btn-light text-primary fw-bold">Submit</button>
  </form>

  <?php if ($submitted): ?>
    <div class="route-box mt-4">
      <strong>Your Planned Trip Summary</strong><br>
      From: <?= htmlspecialchars($startLocation) ?><br>
      To: <?= htmlspecialchars($endLocation) ?><br>
      Mode: <?= ucfirst($transportMode) ?><br>
      Date: <?= $currentDate ?><br>
      Time: <?= $currentTime ?><br>
      <hr>
      <?php if ($plannedRoute): ?>
        Distance: <?= $plannedRoute['distance_km'] ?> km<br>
        Fare (<?= ucfirst($transportMode) ?>): ₱<?= calcFare((float)$plannedRoute['distance_km'], $transportMode, $fareRates) ?>
      <?php else: ?>
        <strong>No available route found between selected locations.</strong>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#tripForm').on('submit', function(e){
  let start = $('select[name="start"]').val();
  let end = $('select[name="destination"]').val();
  let mode = $('input[name="mode"]:checked').val();

  if (!start || !end || !mode) {
    alert("Please select start, destination, and transport mode.");
    e.preventDefault();
  }
});
</script>
</body>
</html>
