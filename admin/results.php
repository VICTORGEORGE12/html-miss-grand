<?php
require '../includes/auth.php';
require '../includes/db.php';

$res = $conn->query("
  SELECT c.name, COUNT(v.id) AS votes
  FROM contestants c
  LEFT JOIN votes v ON c.id = v.contestant_id
  GROUP BY c.id
  ORDER BY votes DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Miss Grand Tanzania - Voting Results</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(135deg, #302801 0%, #4b3e00 100%);
      min-height: 100vh;
      color: #ffdc34;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .container {
      max-width: 700px;
    }
    h2 {
      font-weight: 700;
      margin-bottom: 2rem;
      text-align: center;
      text-shadow: 0 0 10px #ffdc34;
    }
    .back-link {
      display: inline-block;
      margin-bottom: 1.5rem;
      color: #ffdc34;
      font-weight: 600;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    .back-link:hover {
      color: #f5cc00;
      text-decoration: underline;
    }
    table {
      background: rgba(255, 220, 52, 0.1);
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(255, 220, 52, 0.3);
    }
    thead tr {
      background-color: #ffdc34;
      color: #302801;
      font-weight: 700;
      border-radius: 12px 12px 0 0;
    }
    tbody tr:hover {
      background-color: rgba(255, 220, 52, 0.2);
      color: #fff;
    }
    td, th {
      vertical-align: middle !important;
      padding: 1rem 1.5rem;
      border: none !important;
    }
  </style>
</head>
<body>
  <div class="container py-5">
    <h2>Voting Results</h2>
    <a href="dashboard.php" class="back-link">« Back to Dashboard</a>
    <table class="table table-hover text-center rounded shadow-lg">
      <thead>
        <tr>
          <th>Contestant</th>
          <th>Votes</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($r = $res->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($r['name']) ?></td>
            <td><?= $r['votes'] ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
