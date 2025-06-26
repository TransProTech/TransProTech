<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>TransPro - Contact Us</title>

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

    .contact-container {
      background-color: #ffffff;
      margin: 30px auto;
      padding: 30px;
      width: 90%;
      max-width: 900px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .contact-info {
      margin-bottom: 30px;
    }

    .form-control, textarea {
      border-radius: 10px;
    }

    .btn-primary {
      background-color: #0d47a1;
      border: none;
      font-weight: bold;
    }

    .btn-primary:hover {
      background-color: #1565c0;
    }

    footer {
      text-align: center;
      margin-top: 50px;
      padding: 20px;
      background-color: #e3f2fd;
    }
  </style>
</head>

<body>
    
  <header>
    <div class="logo">TransPro</div>
    <nav>
      <a href="index.php">Home</a>
      <a href="live_status.php">Live Status</a>
      <a href="plan_trip.php">Plan Trip</a>
      <a class="active" href="#">Contacts</a>
      <a href="login.php" class="btn btn-sm btn-outline-light ms-3">Logout</a>
    </nav>
    <img src="userlogo.png" class="user-icon" alt="User Icon">
  </header>

  <div class="contact-container">
    <h2 class="mb-4 fw-semibold text-center text-primary">Contact Us</h2>

    <div class="row">
      <div class="col-md-5 contact-info">
        <h5>Head Office</h5>
        <p>TransPro Inc.<br>Tanauan City, Batangas, Philippines</p>

        <h5>Email</h5>
        <p><a href="mailto:support@transpro.com">support@transpro.com</a></p>

        <h5>Phone</h5>
        <p>+63 912 345 6789</p>

        <h5>Working Hours</h5>
        <p>Monday - Friday<br>8:00 AM - 6:00 PM</p>
      </div>

      <div class="col-md-7">
        <form action="#" method="POST">
          <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Name</label>
            <input type="text" class="form-control" id="name" name="name" required />
          </div>
          <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input type="email" class="form-control" id="email" name="email" required />
          </div>
          <div class="mb-3">
            <label for="message" class="form-label fw-semibold">Message</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary w-100">Send Message</button>
        </form>
      </div>
    </div>
  </div>

  <footer>
    <small>&copy; 2025 TransPro System. All rights reserved.</small>
  </footer>

</body>

</html>
