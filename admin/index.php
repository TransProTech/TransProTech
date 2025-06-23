
<?php include '../inc/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - TransPro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f4f4;
    }
    .sidebar {
      height: 100vh;
      background-color: #ddd;
      padding-top: 20px;
    }
    .sidebar a {
      display: block;
      padding: 15px 20px;
      color: #333;
      text-decoration: none;
      border-bottom: 1px solid #ccc;
    }
    .sidebar a:hover {
      background-color: #ccc;
    }
    .admin-panel {
      padding: 30px;
    }
    .quick-btn {
      background-color: #e0e0e0;
      border: none;
      padding: 12px 18px;
      border-radius: 8px;
      margin: 10px;
      box-shadow: 1px 1px 3px rgba(0,0,0,0.1);
    }
    .panel {
      background: #fff;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-2 sidebar">
      <h5 class="text-center mb-4"><strong>TransPro</strong></h5>
      <a href="#">Dashboard</a>
      <a href="#">Manage Routes</a>
      <a href="#">User Reports</a>
      <a href="#">Map Data</a>
      <a href="#">Settings</a>
      <div class="text-center mt-5"><small>Admin</small></div>
    </div>

    <div class="col-md-10 admin-panel">
      <div class="mb-4">
        <h5>Quick Links</h5>
        <button class="quick-btn">Add Route</button>
        <button class="quick-btn">Edit Transit Data</button>
        <button class="quick-btn">Review Reports</button>
        <button class="quick-btn">System Logs</button>
      </div>

      <div class="panel">
        <h6>System Overview</h6>
        <p>Real-time data health, status of updates, and recent activity logs.</p>
      </div>

      <div class="panel">
        <h6>Pending Reports</h6>
        <p>5 new reports submitted by users in the last 24 hours.</p>
      </div>

      <div class="panel">
        <h6>Transit Schedule Updates</h6>
        <p>Bus Route 12 schedule updated successfully. Jeepney Route 3 pending approval.</p>
      </div>

      <div class="panel">
        <h6>Fare Rule Configuration</h6>
        <p>Define or update fare calculation rules for different transit modes.</p>
      </div>
    </div>
  </div>
</div>

</body>
</html>