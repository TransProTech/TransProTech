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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f3f3f3;
      margin: 0;
    }

    header {
      background-color: #ddd;
      padding: 10px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .logo {
      font-size: 24px;
      font-weight: bold;
    }

    nav a {
      margin: 0 10px;
      text-decoration: none;
      font-weight: bold;
      color: #333;
    }

    nav a.active {
      background-color: #ccc;
      padding: 5px 10px;
      border-radius: 5px;
    }

      .user-icon {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  object-fit: contain;
}

    .map-placeholder {
      background: #ccc;
      height: 200px;
      margin: 20px auto;
      width: 90%;
      border: 2px solid #aaa;
      border-radius: 5px;
    }

    .box {
      background: #eaeaea;
      padding: 20px;
      border-radius: 10px;
      width: 100%;
      max-width: 300px;
    }

    .transport-buttons button {
      margin: 5px;
      padding: 10px 20px;
      border: none;
      background: #ccc;
      cursor: pointer;
      border-radius: 5px;
    }

    .alerts div {
      background: #ddd;
      margin: 10px 0;
      padding: 10px;
      border-radius: 5px;
    }

    .timestamp {
      font-size: 12px;
      color: gray;
      margin-top: 10px;
    }

    footer {
      text-align: center;
      margin-top: 50px;
      padding: 20px;
      background-color: #f8f9fa;
    }
  </style>
</head>
<body>

  <header>
    <div class="logo">TransPro</div>
    <nav>
      <a class="active" href="#">Home</a>
      <a href="#">Live Status</a>
      <a href="#">Plan Trip</a>
      <a href="#">Contacts</a>
      <a href="login.php" class="btn btn-sm btn-outline-danger ms-3">Logout</a>
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
        <button type="submit" class="btn btn-primary w-100">Get Directions</button>
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
// 🔁 Force logout after page load (refresh returns to login)
session_unset();
session_destroy();
?>

</body>
</html>
