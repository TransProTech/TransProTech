<?php
session_start();
if (!isset($_SESSION['userID']) || !isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "transpro");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$users = $conn->query("SELECT * FROM users JOIN userInfo ON users.userID = userInfo.userID");
$routes = $conn->query("SELECT * FROM routes ORDER BY routeID");
$alerts = $conn->query("SELECT * FROM alerts ORDER BY dateCreated DESC");
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard | TransPro</title>
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

    .box {
      background: #1976d2;
      color: white;
      padding: 20px;
      border-radius: 15px;
      width: 100%;
      max-width: 400px;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);
    }

    footer {
      text-align: center;
      margin-top: 50px;
      padding: 20px;
      background-color: #e3f2fd;
    }

    .list-group-item {
      font-size: 14px;
      background: #64b5f6;
      color: white;
      margin-bottom: 5px;
      border: none;
      border-radius: 5px;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }

    h2 {
      color: #0d47a1;
      font-weight: bold;
    }

    h5 {
      color:rgb(225, 229, 234);
      font-weight: bold;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);
    }

    .btn-outline-danger {
      border-color: #ff5252;
      color: #ff5252;
    }

    .btn-outline-danger:hover {
      background-color: #ff5252;
      color: white;
    }

     small.text-white {
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }
  </style>
</head>
<body>

<header>
  <div class="logo">TransPro</div>
  <nav>
    <a class="active" href="#">Dashboard</a>
    <a href="login.php" class="btn btn-sm btn-outline-danger ms-3">Logout</a>
  </nav>
  <img src="userlogo.png" class="user-icon" alt="User Icon">
</header>

<div class="container text-center py-4">
  <h2>Admin Dashboard</h2>
  <div class="row justify-content-center g-4 mt-3">

    <div class="col-md-4 d-flex justify-content-center">
      <div class="box text-start">
        <h5>Registered Users</h5>
        <ul class="list-group">
          <?php while ($row = $users->fetch_assoc()): ?>
            <li class="list-group-item">
              <?= htmlspecialchars($row['firstName']) . ' ' . htmlspecialchars($row['lastName']) ?>
              (<?= htmlspecialchars($row['username']) ?>)
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
    </div>

    <div class="col-md-4 d-flex justify-content-center">
      <div class="box text-start">
        <h5>Routes</h5>
        <ul class="list-group">
          <?php while ($route = $routes->fetch_assoc()): ?>
            <li class="list-group-item">
              <?= htmlspecialchars($route['fromLocation']) ?> → <?= htmlspecialchars($route['toLocation']) ?>
              (<?= htmlspecialchars($route['transportType']) ?>)
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
    </div>

    <div class="col-md-4 d-flex justify-content-center">
      <div class="box text-start">
        <h5>Service Alerts</h5>
        <ul class="list-group">
          <?php while ($alert = $alerts->fetch_assoc()): ?>
            <li class="list-group-item">
              <?= htmlspecialchars($alert['message']) ?><br>
              <small class="text-white"><?= htmlspecialchars($alert['dateCreated']) ?></small>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
    </div>

  </div>
</div>

<footer class="text-center mt-5 p-3 bg-light">
  <small>&copy; 2025 TransPro Admin System</small>
</footer>

<?php
session_unset();
session_destroy();
?>

</body>
</html>
