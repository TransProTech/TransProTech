<?php
session_start();
if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit();
}

$liveUpdates = [
    "Bus 101 - Arriving in 4 minutes",
    "Moderate Traffic",
    "Jeepney Route 20: Delay due to roadworks",
    "Bus 04 - Few Seats Left",
    "Green Line - Departing 8:00 PM",
    "Light rain expected"
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Live Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-image: url('img/transprobg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
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

        nav {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        nav a {
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

        .container {
            padding: 200px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background-color: #007bffc7;
            color: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
            height: 100px;
        }

        .card:hover {
            transform: scale(1.05);
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">TransPro</div>
        <nav>
            <a href="index.php">Home</a>
            <a class="active" href="live_status.php">Live Status</a>
            <a href="plan_trip.php">Plan Trip</a>
            <a href="contacts.php">Contacts</a>
            <a href="login.php" class="btn btn-sm btn-outline-light ms-3">Logout</a>
        </nav>
        <img src="userlogo.png" class="user-icon" alt="User Icon">
    </header>

    <div class="container d-flex flex-column align-items-center">
        <div class="row justify-content-center">
            <?php foreach ($liveUpdates as $update): ?>
            <div class="col-lg-4 col-md-6 col-sm-12 my-3 py-2">
                <div class="card">
                    <?= htmlspecialchars($update) ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>

</html>
