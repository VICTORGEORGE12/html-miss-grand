<?php
session_start();
require_once '../includes/db.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usr = $_POST['username'];
    $pwd = $_POST['password'];
    $stmt = $conn->prepare("SELECT password_hash FROM admins WHERE username=?");
    $stmt->bind_param("s", $usr);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    if ($row && hash('sha256', $pwd) === $row['password_hash']) {
        $_SESSION['admin'] = $usr;
        header("Location: dashboard.php");
        exit;
    } else $error = "Invalid credentials.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Miss Grand Tanzania - Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(135deg, #302801 0%, #4b3e00 100%);
      color: #ffdc34;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
    }
    .login-container {
      background: rgba(48, 40, 1, 0.85);
      padding: 2.5rem 3rem;
      border-radius: 15px;
      box-shadow: 0 8px 24px rgba(255, 220, 52, 0.5);
      max-width: 400px;
      width: 100%;
      text-align: center;
    }
    h2 {
      margin-bottom: 2rem;
      font-weight: 700;
      text-shadow: 0 0 10px #ffdc34;
    }
    .form-control {
      background-color: #4b3e00;
      border: none;
      color: #ffdc34;
      font-weight: 600;
      box-shadow: none;
    }
    .form-control:focus {
      background-color: #5a4a00;
      color: #fff;
      border-color: #ffdc34;
      box-shadow: 0 0 8px #ffdc34;
      outline: none;
    }
    .btn-login {
      background-color: #ffdc34;
      color: #302801;
      font-weight: 700;
      width: 100%;
      padding: 0.75rem;
      border-radius: 30px;
      box-shadow: 0 5px 15px rgba(255, 220, 52, 0.4);
      transition: background-color 0.3s ease;
    }
    .btn-login:hover,
    .btn-login:focus {
      background-color: #f5cc00;
      color: #1a1600;
      box-shadow: 0 8px 20px rgba(245, 204, 0, 0.7);
      outline: none;
    }
    .text-danger {
      font-weight: 600;
      text-shadow: 0 0 3px #ff3333;
    }
  </style>
</head>
<body>
  
  <div class="login-container">
    <h2>Admin Login</h2>
    
    <?php if($error): ?>
      <p class="text-danger"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST" novalidate>
      <input name="username" class="form-control mb-3" placeholder="Username" required autofocus />
      <input name="password" type="password" class="form-control mb-4" placeholder="Password" required />
      <button class="btn btn-login" type="submit">Login</button>
      <a href="../votingForm.php" class="btn-back text-decoration-none text-white border-bottom">Back to vote home page</a>
    </form>
  </div>
</body>
</html>
