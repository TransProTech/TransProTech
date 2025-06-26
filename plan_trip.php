<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>TransPro - Plan Trip</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f1f1f1;
      margin: 0;
    }

    .navbar {
      background-color: #1c2b63;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 40px;
    }

    .navbar a {
      color: white;
      margin: 0 15px;
      text-decoration: none;
    }

    .active {
      background-color: #6a7896;
      padding: 5px 10px;
      border-radius: 5px;
    }

    .custom-container {
      background-color: #2e83f5;
      margin: 30px auto;
      padding: 30px;
      width: 80%;
      max-width: 800px;
      color: white;
      border-radius: 10px;
    }

    .route-box {
      background-color: #1c5fd5;
      padding: 15px;
      border-radius: 10px;
      color: white;
      min-height: 100%;
    }

    button {
      background-color: #fff;
      color: #2e83f5;
      font-weight: 600;
    }

    button:hover {
      background-color: #dce6ff;
    }

    .header {
      padding: 20px;
    }

    .rounded-form {
      background-color: #1c5fd5;
      padding: 20px;
      border-radius: 15px;
    }

    .rounded-form .form-control {
      border-radius: 10px;
    }
  </style>
</head>

<body>

  <div class="header bg-light border-top border-primary shadow-sm py-2 px-3">
    <div class="d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center">
        <img src="img/logo.png" alt="TransPro Logo" class="rounded-circle me-2" style="width: 40px; height: 40px;">
        <span class="fw-bold fs-5 text-dark">TransPro</span>
      </div>
      <div>
        <img src="img/adminlogo.png" alt="Admin Icon" class="rounded-circle" style="width: 40px; height: 40px;">
      </div>
    </div>
  </div>

  <div class="navbar">
    <a href="#">Home</a>
    <a href="#">Live Status</a>
    <a class="active" href="#">Plan Trip</a>
    <a href="#">Contacts</a>
  </div>

  <div class="custom-container">
    <h2 class="mb-4 fw-semibold">Plan Your Trip</h2>

    <form class="rounded-form" action="#" method="POST">
      <div class="row">
        <div class="col-md-6 mb-3">
          <input type="text" name="start" class="form-control" placeholder="Enter starting point" required>
        </div>
        <div class="col-md-6 mb-3">
          <input type="text" name="destination" class="form-control" placeholder="Enter destination" required>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label me-3">
          <input type="radio" name="mode" value="bus" class="form-check-input me-1"> Bus
        </label>
        <label class="form-label me-3">
          <input type="radio" name="mode" value="jeepney" class="form-check-input me-1"> Jeepney
        </label>
        <label class="form-label">
          <input type="radio" name="mode" value="train" class="form-check-input me-1"> Train
        </label>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <input type="date" name="date" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
          <input type="time" name="time" class="form-control" required>
        </div>
      </div>

      <button type="submit" class="btn btn-success">Submit</button>
    </form>

    <div class="row mt-4 g-3">
      <div class="col-md-4">
        <div class="route-box h-100 d-flex flex-column">
          <strong>Fastest Route</strong><br>
          Jeepney 20 → MRT Line 2 → Walk<br>
          ETA: 38 mins • Fare: ₱45 • 1 Transfer
        </div>
      </div>
      <div class="col-md-4">
        <div class="route-box h-100 d-flex flex-column">
          <strong>Cheapest Route</strong><br>
          Bus 101 → Jeepney 5<br>
          ETA: 55 mins • Fare: ₱30 • 2 Transfers
        </div>
      </div>
      <div class="col-md-4">
        <div class="route-box h-100 d-flex flex-column">
          <strong>Least Transfer</strong><br>
          Train<br>
          ETA: 30 mins • Fare: ₱50 • 1 Transfer
        </div>
      </div>
    </div>
  </div>

</body>

</html>
