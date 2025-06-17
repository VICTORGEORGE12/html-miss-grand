<?php require '../includes/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Miss Grand Tanzania - Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(135deg, #302801 0%, #4b3e00 100%);
      min-height: 100vh;
      color: #ffdc34;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .container {
      max-width: 600px;
    }
    h2 {
      font-weight: 700;
      margin-bottom: 2rem;
      text-align: center;
      text-shadow: 0 0 10px #ffdc34;
    }
    .btn-custom {
      background-color: #ffdc34;
      color: #302801;
      font-weight: 600;
      padding: 1rem 2rem;
      border-radius: 30px;
      transition: background-color 0.3s ease, color 0.3s ease;
      box-shadow: 0 5px 15px rgba(255, 220, 52, 0.4);
      width: 100%;
      margin-bottom: 1.25rem;
      font-size: 1.25rem;
    }
    .btn-custom:hover, .btn-custom:focus {
      background-color: #f5cc00;
      color: #1a1600;
      box-shadow: 0 8px 20px rgba(245, 204, 0, 0.7);
      outline: none;
    }
    .logout-btn {
      background-color: #b22222;
      color: #fff;
      font-weight: 600;
      padding: 1rem 2rem;
      border-radius: 30px;
      width: 100%;
      font-size: 1.25rem;
      box-shadow: 0 5px 15px rgba(178, 34, 34, 0.5);
      transition: background-color 0.3s ease;
    }
    .logout-btn:hover, .logout-btn:focus {
      background-color: #800000;
      box-shadow: 0 8px 20px rgba(128, 0, 0, 0.7);
      outline: none;
    }
  </style>
</head>
<body>
  <div class="container py-5">
    <h2>Miss Grand Tanzania Admin Dashboard</h2>
    <a href="contestants.php" class="btn btn-custom">Manage Contestants</a>
    <a href="results.php" class="btn btn-custom">View Results</a>
    <a href="logout.php" class="logout-btn">Logout</a>
  </div>
</body>
</html>
