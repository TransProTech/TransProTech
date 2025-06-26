<?php
session_start();
if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit();
}

$tricycleUpdates = [
    "Tricycle routes in Tanauan are temporarily suspended due to flooding.",
    "Most barangay tricycles operational in Lipa City.",
    "Delays in Tanauan City due to local traffic ordinances."
];

$busUpdates = [
    "Bus Route 101 (Calamba–Alabang) running on schedule.",
    "Bus 04 - Few seats left.",
    "Bus 302 delayed near South Luzon Expressway."
];

$jeepneyUpdates = [
    "Jeepney Route 12 delayed due to roadwork near Tanauan City, Batangas.",
    "Jeepney Route 8 operating on time.",
    "Limited trips after 9 PM in Lipa City."
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>TransPro Live Status</title>
  <link rel="icon" href="userlogo.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url('img/transprobg.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      color: white;
      min-height: 100vh;
    }

    header {
      background-color: #0d47a1;
      padding: 10px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .logo {
      font-size: 26px;
      font-weight: bold;
    }

    nav {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    nav a {
      text-decoration: none;
      font-weight: bold;
      color: white;
    }

    nav a.active {
      background-color: #1976d2;
      padding: 5px 10px;
      border-radius: 5px;
    }

    .user-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
    }

    .container {
      padding: 40px 20px;
    }

    .category-title {
      margin-top: 40px;
      margin-bottom: 20px;
      color: #ffffff;
      border-left: 5px solid #90caf9;
      padding-left: 10px;
      font-size: 24px;
    }

    .card {
      background-color: #007bffc7;
      color: white;
      padding: 20px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s;
      height: 100%;
    }

    .card:hover {
      transform: scale(1.05);
      cursor: pointer;
    }

    .footer {
      background: #e3f2fd;
      padding: 15px;
      text-align: center;
      color: #000;
      margin-top: 40px;
    }

    .alert-section {
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <header>
    <div class="logo">TransPro</div>
    <nav>
      <a href="index.php">Home</a>
      <a class="active" href="live_status.php">Live Status</a>
      <a href="plan_trip.php">Plan Trip</a>
      <a href="contacts.php">Contacts</a>
      <a href="login.php" class="btn btn-sm btn-outline-light ms-3">Logout</a>
    </nav>
    <img src="userlogo.png" class="user-icon" alt="User Icon">
  </header>

  <div class="container">
    <h2 class="text-center text-light mb-4">Live Transport Status</h2>

    <div class="alert-section">
      <div class="alert alert-danger" role="alert">
        Tricycle routes in Tanauan are temporarily suspended due to flooding.
      </div>
      <div class="alert alert-info" role="alert">
        Bus Route 101 (Calamba–Alabang) running on schedule.
      </div>
      <div class="alert alert-warning" role="alert">
        Jeepney Route 12 delayed due to roadwork near Tanauan City, Batangas.
      </div>
    </div>

    <div class="category-title">Tricycle Updates</div>
    <div class="row">
      <?php foreach ($tricycleUpdates as $update): ?>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
          <div class="card"><?= htmlspecialchars($update) ?></div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="category-title">Bus Updates</div>
    <div class="row">
      <?php foreach ($busUpdates as $update): ?>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
          <div class="card"><?= htmlspecialchars($update) ?></div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="category-title">Jeepney Updates</div>
    <div class="row">
      <?php foreach ($jeepneyUpdates as $update): ?>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
          <div class="card"><?= htmlspecialchars($update) ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="footer">
    <small>&copy; 2025 TransPro System</small>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
