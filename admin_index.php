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


    .box {
      background: #eaeaea;
      padding: 20px;
      border-radius: 10px;
      width: 100%;
      max-width: 400px;
    }

    footer {
      text-align: center;
      margin-top: 50px;
      padding: 20px;
      background-color: #f8f9fa;
    }

    .list-group-item {
      font-size: 14px;
    }

    h5 {
      margin-bottom: 15px;
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
              <small class="text-muted"><?= htmlspecialchars($alert['dateCreated']) ?></small>
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
// 🔁 Force logout on refresh
session_unset();
session_destroy();
?>

</body>
</html>
