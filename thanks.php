<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Thanks for Voting - Miss Grand Tanzania</title>
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
      text-align: center;
    }
    .thank-container {
      background: rgba(48, 40, 1, 0.85);
      padding: 3rem 2.5rem;
      border-radius: 15px;
      box-shadow: 0 8px 24px rgba(255, 220, 52, 0.5);
      max-width: 480px;
      width: 100%;
    }
    h2 {
      font-weight: 700;
      text-shadow: 0 0 10px #ffdc34;
      margin-bottom: 2rem;
      color: #c6f27e;
    }
    .btn-back {
      background-color: #ffdc34;
      color: #302801;
      font-weight: 700;
      padding: 0.75rem 2rem;
      border-radius: 30px;
      box-shadow: 0 5px 15px rgba(255, 220, 52, 0.4);
      transition: background-color 0.3s ease;
      text-decoration: none;
      display: inline-block;
    }
    .btn-back:hover,
    .btn-back:focus {
      background-color: #f5cc00;
      color: #1a1600;
      box-shadow: 0 8px 20px rgba(245, 204, 0, 0.7);
      outline: none;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="thank-container">
    <h2>Thank you for your vote!</h2>
    <a href="votingForm.php" class="btn-back">Back to voting</a>
  </div>
</body>
</html>
