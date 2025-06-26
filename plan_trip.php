<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>TransPro - Plan Trip</title>

  <link rel="icon" href="userlogo.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f1f1f1;
      margin: 0;
    }

    header {
      background-color: #0d47a1;
      padding: 10px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      color: white;
    }

    .logo {
      font-size: 26px;
      font-weight: bold;
    }

    nav a {
      margin: 0 10px;
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

  <header>
    <div class="logo">TransPro</div>
    <nav>
      <a href="index.php">Home</a>
      <a href="live_status.php">Live Status</a>
      <a class="active" href="#">Plan Trip</a>
      <a href="contacts.php">Contacts</a>
      <a href="login.php" class="btn btn-sm btn-outline-light ms-3">Logout</a>
    </nav>
    <img src="userlogo.png" class="user-icon" alt="User Icon">
  </header>

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

  <footer class="text-center mt-5 p-3 bg-light">
    <small>&copy; 2025 TransPro System</small>
  </footer>

</body>

</html>
