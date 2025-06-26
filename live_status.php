<?php
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
            height: 100vh;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
            padding: 10px 20px;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .logo-section img {
            width: 50px;
            height: 50px;
            object-fit: contain;
            filter: drop-shadow(0 0 2px #203b80);
            border-radius: 50%;
            background: #dde2ea;
        }

        h1.logo-text {
            font-weight: 900;
            font-size: 1.75rem;
            color: #273449;
            letter-spacing: -0.015em;
            text-shadow: 2px 2px 3px rgb(0 0 0 / 0.25);
        }

        .profile-icon img {
            width: 50px;
            height: 50px;
            object-fit: contain;
            filter: drop-shadow(0 0 2px #203b80);
            border-radius: 50%;
            background: #dde2ea;
        }

        nav {
            background: #203b80;
            justify-content: center;
            display: flex;
            gap: 20px;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #00509e;
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
        <div class="logo-section" aria-label="TransPro logo and name">
            <img src="./img/logo.png" alt="TransPro logo icon" />
            <h1 class="logo-text">TransPro</h1>
        </div>
        <div class="profile-icon" role="img" aria-label="User profile icon">
            <img src="./img/people.png" alt="TransPro user icon" />
        </div>
    </header>
    <nav>
        <a class="active" href="#">Home</a>
        <a href="live_status.php" style="background-color: #00509e;">Live Status</a>
        <a href="#">Plan Trip</a>
        <a href="#">Contacts</a>
        <a href="login.php" class="btn btn-sm btn-outline-danger ms-3">Logout</a>
    </nav>
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