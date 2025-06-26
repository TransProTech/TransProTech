<?php
session_start();
if (!isset($_SESSION['userID'])) {
  header("Location: login.php");
  exit();
}
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
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f0f0;
      background-image: url('img/transprobg.jpg');
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
    #map {
      height: 300px;
      width: 90%;
      margin: 20px auto;
      border: 2px dashed #90caf9;
      border-radius: 10px;
    }
    .box {
      background: #1976d2;
      color: white;
      padding: 20px;
      border-radius: 20px;
      width: 200%;
      max-width: 500px;
    }
    .transport div {
      margin: 5px;
      padding: 10px 20px;
      border: none;
      background: #64b5f6;
      color: white;
      cursor: pointer;
      border-radius: 8px;
      font-weight: regular;
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
      color: rgb(255, 255, 255);
      font-weight: bold;
    }
    h2 {
      color:rgb(255, 255, 255);
      font-weight: bold;
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
      <a href="live_status.php">Live Status</a>
      <a href="plan_trip.php">Plan Trip</a>
      <a href="contacts.php">Contacts</a>
      <a href="login.php" class="btn btn-sm btn-outline-light ms-3">Logout</a>
    </nav>
    <img src="userlogo.png" class="user-icon" alt="User Icon">
  </header>

    <h2 class="mt-4 d-flex justify-content-center">Live Map</h2>
    <div id="map"></div>


    <div class="row justify-content-center g-4 mt-4">
      <div class="col-md-4 d-flex justify-content-center">
        <div class="box text-center">
          <h3>Type of Transportation</h3>
          <div class="transport">
            <div>Bus – Your Comfortable Ride Across Provinces
            Buses offer a safe, spacious, and air-conditioned way to travel across cities and provinces. 
            They're perfect for long-distance trips, daily commutes, and hassle-free travel on main roads.</div>
            <div>Jeepney – The Iconic and Affordable Filipino Ride
            Jeepneys are the heart of local transportation — colorful, affordable, and always part of the Filipino experience. 
            They follow fixed routes but let you hop on and off almost anywhere, making them super convenient.</div>
            <div>Tricycle – The Neighborhood Navigator
            Tricycles are ideal for quick, short-distance rides within towns or barangays. 
            Their flexibility and accessibility make them the best choice for last-mile travel.</div>
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

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
    var map = L.map('map').setView([14.1, 121.3], 10);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var lat = position.coords.latitude;
        var lon = position.coords.longitude;

        var inCalabarzon = (lat >= 13.6 && lat <= 14.5) && (lon >= 120.5 && lon <= 122.0);

        if (inCalabarzon) {
          map.setView([lat, lon], 13);
          L.marker([lat, lon]).addTo(map)
            .bindPopup("You are here!").openPopup();
        } else {
          alert("You are outside CALABARZON region.");
        }
      }, function(error) {
        alert("Geolocation failed: " + error.message);
      });
    } else {
      alert("Geolocation is not supported by this browser.");
    }
  </script>
</body>
</html>
