<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $conn = new mysqli("localhost", "root", "", "transpro");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $_SESSION['userID'] = $user['userID'];
    $_SESSION['username'] = $user['username'];

    if ($username === 'adminako') {
      $_SESSION['isAdmin'] = true;
      header("Location: admin_index.php");
    } else {
      $_SESSION['isAdmin'] = false;
      header("Location: home.php");
    }
    exit();
  } else {
    $error = "Invalid credentials.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | TransProTech </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f0f0f0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: Arial, sans-serif;
       background-image: url('img/transprobg.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }

    .login-container {
      background-color: #ddd;
      padding: 40px 30px;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 350px;
    }

    .logo {
      text-align: center;
      margin-bottom: 20px;
    }

    .logo img {
      width: 50px;
    }

    .logo h3 {
      margin-top: 10px;
      font-weight: bold;
      color: #333;
    }

    .login-container h4 {
      text-align: center;
      margin-bottom: 20px;
      font-weight: bold;
      color: #333;
    }

    .form-control {
      border-radius: 8px;
    }

    .btn-primary {
      border-radius: 8px;
    }

    .form-text-link {
      text-align: center;
      margin-top: 10px;
      font-size: 0.9em;
    }

    .form-text-link a {
      text-decoration: none;
      color: #333;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <div class="logo">
      <img src="userlogo.png" alt="Logo"> 
      <h3>TransProTech</h3>
    </div>

    <h4>Log In</h4>
    
    <?php if (isset($error)): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
      <div class="mb-3">
        <label for="username" class="form-label">Email</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="**********" required>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Log In</button>
      </div>
    </form>

    <div class="form-text-link">
      <a href="#">Forgot Password?</a>
    </div>
  </div>

</body>
</html>
