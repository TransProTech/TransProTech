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


$users  = $conn->query("SELECT userID, username FROM users ORDER BY userID");
$routes = $conn->query("SELECT * FROM routes ORDER BY id");
$alerts = $conn->query("SELECT * FROM alerts ORDER BY dateCreated DESC");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard | TransProTech</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body{font-family:Arial,sans-serif;background:#f0f0f0; background-image: url('img/transprobg.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;margin:0}
    header{background:#0d47a1;padding:10px 20px;display:flex;align-items:center;justify-content:space-between;color:#fff}
    .logo{font-size:26px;font-weight:bold}
    nav a{margin:0 10px;text-decoration:none;font-weight:bold;color:#fff}
    nav a.active{background:#1976d2;padding:5px 10px;border-radius:5px}
    .user-icon{width:40px;height:40px;border-radius:50%;object-fit:cover}
    .box{background:#1976d2;color:#fff;padding:20px;border-radius:15px;width:100%;max-width:400px}
    footer{text-align:center;margin-top:50px;padding:20px;background:#e3f2fd}
    .list-group-item{font-size:14px;background:#64b5f6;color:#fff;margin-bottom:5px;border:none;border-radius:5px}
    h2{color:#FFFFFF;font-weight:bold;text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);}
    h5{color:#e1e5ea;font-weight:bold;text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);}
    .a{text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);}
  </style>
</head>
<body>

<header>
  <div class="logo">TransProTech</div>
  <nav>
    <a class="active" href="#">Dashboard</a>
    <a href="logout.php" class="btn btn-sm btn-outline-danger ms-3">Logout</a>
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
              <?= htmlspecialchars($row['username']) ?> (ID: <?= $row['userID'] ?>)
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
  <small>&copy; TransProTech</small>
</footer>

<?php
$conn->close(); 
?>
</body>
</html>
