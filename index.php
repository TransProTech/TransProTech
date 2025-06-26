<?php
session_start();
if (!isset($_SESSION['userID'])) {
  header("Location: login.php");
  exit();
}
?>
<?php
$conn = new mysqli("localhost", "root", "", "transpro");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$cities = [];
$sql = "SELECT DISTINCT fromLocation AS city FROM routes UNION SELECT DISTINCT toLocation AS city FROM routes";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cities[] = $row['city'];
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>TransPro</title>
  <link rel="icon" href="userlogo.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f0f0;
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

    .map-placeholder {
      background: #e3f2fd;
      height: 200px;
      margin: 20px auto;
      width: 90%;
      border: 2px dashed #90caf9;
      border-radius: 10px;
    }

    .box {
      background: #1976d2;
      color: white;
      padding: 20px;
      border-radius: 20px;
      width: 100%;
      max-width: 300px;
    }

    .transport-buttons button {
      margin: 5px;
      padding: 10px 20px;
      border: none;
      background: #90caf9;
      color: black;
      cursor: pointer;
      border-radius: 5px;
      font-weight: bold;
    }

    .alerts div {
      background: #64b5f6;
      color: white;
      margin: 10px 0;
      padding: 10px;
      border-radius: 8px;
    }

    .timestamp {
      font-size: 12px;
      color: white;
      margin-top: 10px;
    }

    footer {
      text-align: center;
      margin-top: 50px;
      padding: 20px;
      background-color: #e3f2fd;
    }

     h3 {
      color:rgb(255, 255, 255);
      font-weight: bold;
    }

    h2 {
     color: #0d47a1;
      font-weight: bold; 47a1
    }
 
    select, button {
      font-weight: bold;
    }
  </style>
</head>
<body>

  <header>
    <div class="logo">TransPro</div>
    <nav>
      <a class="active" href="#">Home</a>
      <a href="#">Live Status</a>
      <a href="plan_trip.php">Plan Trip</a>
      <a href="#">Contacts</a>
      <a href="login.php" class="btn btn-sm btn-outline-light ms-3">Logout</a>
    </nav>
    <img src="userlogo.png" class="user-icon" alt="User Icon">
  </header>

  <div class="container text-center py-4">
    <h2>Plan Your Route</h2>
    <form class="row justify-content-center g-2 my-3" method="get">
      <div class="col-md-3">
        <select name="from" class="form-select" required>
          <option value="" disabled selected>From</option>
          <?php foreach ($cities as $city): ?>
            <option value="<?= htmlspecialchars($city) ?>"><?= htmlspecialchars($city) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-3">
        <select name="to" class="form-select" required>
          <option value="" disabled selected>To</option>
          <?php foreach ($cities as $city): ?>
            <option value="<?= htmlspecialchars($city) ?>"><?= htmlspecialchars($city) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-success w-100">Get Directions</button>
      </div>
    </form>

    <h2 class="mt-4">Live Map</h2>
    <div class="map-placeholder"></div>

    <div class="row justify-content-center g-4 mt-4">
      <div class="col-md-4 d-flex justify-content-center">
        <div class="box text-center">
          <h3>Type of Transportation</h3>
          <div class="transport-buttons">
            <button>Bus</button>
            <button>Jeepney</button><br/>
            <button>Train</button>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-flex justify-content-center">
        <div class="box text-start">
          <h3>Traffic & Service Alerts</h3>
          <div class="alerts">
            <div>LRT Line 1: Service temporarily suspended between Baclaran and EDSA.</div>
            <div>Jeepney Route 12 delayed due to traffic congestion in España.</div>
            <div>MRT Line 3 running on time.</div>
          </div>
          <div class="timestamp">Updated 5mins ago</div>
        </div>
      </div>
    </div> 
  </div>

  <footer class="text-center mt-5 p-3 bg-light">
    <small>&copy; 2025 TransPro System</small>
  </footer>

<?php
session_unset();
session_destroy();
?>

</body>
</html>
